# CRUD OOP with PDO Package

This project implements a CRUD (Create, Read, Update, Delete) operations package using Object-Oriented Programming (OOP) with PDO in PHP. It includes classes for database configuration, database connection, and operations on a "country" entity example.
## Contrubition
[Hashaam Zahid] (https://www.linkedin.com/in/hashaam-zahid)

## Install Setup
composer require hashaam-zahid/crud-pdo-operation

## Folder Structure

/configuration <br>
            configuration.php <br>
/dbconnect <br>
         db_connect.php <br>
/classes <br>
   country.php <br>

Main directory <br>

country_process.php <br>


## Usage
The primary goal of this project is to offer a maintainable and easily understandable solution for performing CRUD operations on a database. 
It focuses on clean code practices to enhance readability, Reusability and ease of use for developers working with database entities.
### `configuration/configuration.php`
Contains a class with constants defining database connection details.

### `dbconnect/db_connect.php`
Implements a class responsible for CRUD operations using PDO. It establishes a database connection and provides methods for insertion, selection, deletion, and updating records.

### `classes/country.php`
Defines a class for handling "country" entities. It contains methods to perform operations like fetching all countries, retrieving cities by country ID, inserting, updating, and deleting country records.

### `country_process.php`
An example usage file where the `country` class methods are instantiated and demonstrated. It showcases how to retrieve countries, cities, insert, update, and delete country records.

## Project Structure

- `configuration/configuration.php`: Defines database configuration constants.
- `dbconnect/db_connect.php`: Handles database connections and CRUD operations.
- `classes/country.php`: Manages operations related to the "country" entity.
- `country_process.php`: Demonstrates the usage of the `country` class methods.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
Ensure that you have a LICENSE file in your project root directory, which includes the MIT License details. You can use the following MIT License text:


MIT License

Copyright (c) [2023]

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
Replace [2023] with the current year or range of years the project has been developed.

This README.md file structure provides an overview of your project, its directory layout, usage, and licensing information. Adjust it as needed to match your project's specific details and requirements.
