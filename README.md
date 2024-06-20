# Mobile Food Facility Permit

This work is based on Mobile_Food_Facility_Permit.csv file for parsing, converting, data gathering and seeding the database. 

## Basic requirements

 Perl

 PHP and Laravel framework ( https://laravel.com/docs/11.x/installation )

 MySQL

## Scripts / Files used

csvtojson.pl - Perl script to convert the CSV file to JSON.

import.pl    - Perl script to import the CSV to the database.

main.pl      - Perl script to parse and return filtered lines using command line and arguments.

example-app  - PHP Laravel single page using datatables gathering data from MySQL and displaying to the user. (http://localhost/example)

Mobile_Food_Facility_Permit.csv - Source CSV with the dataset

permit.sql   - Database dump for convenience.
