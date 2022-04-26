# BackBone Challenge

The project is writered in the Lumen micro framework, you can see the oficial documentation down, is espetially for rest api applications. <br /><br />
I'm used mysql for database, I was download the zip codes from Mexico in txt format, in the folder seeders/ZipCodesNoSqlSeeder.php you can get the code for save in the database.<br /><br />
Because the requeriments explain the time is important, I made a table in the database ZIPS, the table have 2 columns, one is ID and the other one is DATA.<br /><br />
On the ZipCodesNoSqlSeeder I was pass the TXT to JSON, and after that I save the fields with a chunk array to limited 1000 register per time.<br /><br />
So, the method for getData is very simple, because the data is formated before, I think is a good solution, because the data need saved in the format will be used.<br /><br />
Off course, that minds duplication of data, but in nosql formats that is normal. Time is most important.<br /><br /><br />


I need say thanks for the oportunity in this challenge, I'm hope can get the oportunity for know your company.<br /><br />

# Tech Documentation
For this project I was Install, on a Digital Ocean Server.<br /><br />
PHP 7.4.29 (cli) (built: Apr 12 2022 10:55:38) ( NTS )<br />
mysql  Ver 15.1 Distrib 10.5.15-MariaDB, for Linux (x86_64) using readline 5.1<br />
flipbox/lumen-generator: ^9.1<br />
laravel/lumen-framewor": ^8.3.1<br />


## Official Documentation
[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

