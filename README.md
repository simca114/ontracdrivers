Ontrac Driver Website
=====================

This is a website i wrote from scratch in order to learn and practice HTML, CSS and PHP.  

Current Features
----------------

* User Sessions (Currently unsecured)
* Form to add information to a MySQL server (add stops)
* Form to retrieve data from a MySQL server (show invoice)

Planned Features
----------------
* Secure User Sessions
* Hashed passwords for storing and authentication
* Change Password Page
* Printer-Friendly version of Invoices

Setting up Server
=================

This server only needs a basic LAMP stack to work.  

Make sure you have the following installed:
```
* apache2
* php5
* libapache2-mod-php5
* mysql-server (remember root password you set)
* php5-mysql
```
Enable the php mod for apache
```
$ sudo a2enmod php5
```
Have the vhost in /etc/apache2/sites-enabled point the DocumentRoot to the location of this repository.

Setting up MySQL
----------------
This website logs into a MySQL server and looks for a database ``ontrac_db`` and 2 tables in it. Create these as follows:
```
#run these as root
$ mysql -p   #connect to the mysql server

CREATE DATABASE ontrac_db;
USE ontrac_db;

CREATE TABLE drivers ( driver_num SMALLINT, driver_fname VARCHAR(40), driver_lname VARCHAR(40), driver_pass(60) );
CREATE TABLE stops ( driver_num SMALLINT, date DATE, nums_stops SMALLINT DEFAULT 0, sun_stops SMALLINT DEFAULT 0, hw_stops SMALLINT DEFAULT 0, pu_stops SMALLINT DEFAULT 0);

INSERT INTO drivers(driver_num,driver_fname,driver_lname,driver_pass) VALUES(234,'John','Doe','password'); #random user to log into the website with

exit
```



