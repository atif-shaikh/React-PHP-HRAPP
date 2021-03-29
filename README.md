This is an integrated React-PHP HR Application

## APACHE VHOST SETUP

<VirtualHost \*:8080>
ServerName hrapp.local
DocumentRoot "src/public/"
ErrorLog "error.log"
</VirtualHost>

<VirtualHost \*:9090>
ServerName hrapp.frontend
DocumentRoot "frontend/"
ErrorLog "frontend-error.log"
</VirtualHost>

## Do a composer Install

Make Sure you have composer installed on your machine.
composer install

## Execute Scripts in the Script Folder:

Create Database hrapp;

Run the following two scripts

1. hrapp_departments.sql
2. hrapp_employees.sql

## URLS:

Frontend : hrapp.frontend:9090
Backend: hrapp.local:8080
