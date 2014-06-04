Unofficial Ontrac Driver Website
================================

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
This website logs into a MySQL server and looks for a database ``ontrac_db`` and 2 tables in it. Use the tables in "mysql_tables":
```
#run these as root (be sure to include the "-h <mysqlserver host>" if not on the same machine)
$ mysql -p   #connect to the mysql server

mysql> CREATE DATABASE ontrac_db;
mysql> USE ontrac_db;

#create the tables from the table source files
mysql> SOURCE <path_to_file>/drivers.sql
mysql> SOURCE <path_to_file>/stops.sql

exit
```

NOTE: In ${$REPODIR}/default/var_names.php be sure to add a variable $root_pass and set it to the mysqlserver root password.  
      This is not a good place to put it, but for testing it will suffice.

