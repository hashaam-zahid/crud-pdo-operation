<?php
class db_connect
{
	private $sServerName;
	private $sDbUserName;
	private $sDbPassword;
	private $sDbName;
	private $dbConnect;

	function __construct()
	{
		require_once('../configuration.php');
		
		$this->sServerName = configuration::sDbServerName;
		$this->sDbUserName = configuration::sDbUserName;
		$this->sDbPassword = configuration::sDbPassword;
		$this->sDbName = configuration::sDbName;

		try {
			$this->dbConnect = new PDO("mysql:host=$this->sServerName;dbname=$this->sDbName", $this->sDbUserName, $this->sDbPassword);
			$this->dbConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo "Connection failed: " . $e->getMessage();
			exit;
		}
	}

	function InsertRecord($pStrTableName, $pArrField, $pArrValue)
	{
		$fieldString = implode(',', $pArrField);
		$valuePlaceholder = implode(',', array_fill(0, count($pArrValue), '?'));

		$strSql = "INSERT INTO $pStrTableName ($fieldString) VALUES ($valuePlaceholder)";

		try {
			$stmt = $this->dbConnect->prepare($strSql);
			$stmt->execute($pArrValue);

			return $this->dbConnect->lastInsertId();
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}

	function SelectRecord($pArrayField, $pStrTableName, $pStrCondition = "")
	{
		$fieldString = implode(',', $pArrayField);
		$strSql = "SELECT $fieldString FROM $pStrTableName $pStrCondition";
		

		try {
			$stmt = $this->dbConnect->prepare($strSql);
			$stmt->execute();

			return $stmt;
		} catch (PDOException $e) {
			return $e->getMessage();
		}
	}

	function DeleteRecord($pStrTableName, $pStrCondition)
	{
		$strSql = "DELETE FROM $pStrTableName $pStrCondition";

		try {
			$stmt = $this->dbConnect->prepare($strSql);
			$stmt->execute();

			return true;
		} catch (PDOException $e) {
			return false;
		}
	}

	function UpdateRecord($pStrTable, $pArrField, $pArrValue, $pStrCondition)
	{
		$setValues = array();
		foreach ($pArrField as $field) {
			$setValues[] = "$field=?";
		}
		$setString = implode(',', $setValues);

		$strSql = "UPDATE $pStrTable SET $setString $pStrCondition";

		try {
			$stmt = $this->dbConnect->prepare($strSql);
			$stmt->execute($pArrValue);

			return true;
		} catch (PDOException $e) {
			return false;
		}
	}
}
?>
