Lore Commander
====================
This is a test project for Zermelo/DURC and to host some data experiments with MTG Card data.

This is Fred Trotter's fork of the original project at CareSet. 


Setting up the server
------------------------
TODO instantiate this as a docker-compose.yml file

* Install Ubuntu 20.04. This has the right version of php 7.4 
* php.ini post_max_size of 8000M 
* php.ini upload_max_filesize 5000M 
* php.ini upload_max_files 1000
* php.ini memory_limit 2G
* configurage apache to serve /var/www/html/LoreCommander/ with this directory as content
* apache config allowoverride all
* apache config require all granted
* Zermelo must be installed in /var/www/html/Zermelo/
* DURC must be installed in /var/www/html/DURC/
* for all three projects the github root is https://github.com/ftrotter/
* you must use LoreCommander/use_local_careset_libraries.php to ensure that the local copies are used for Zermelo and DURC
* 

Running the Data download
-----------------

To install the dist release versions of Zermelo/DURC from packagist run:

`php lore.php --install`

To install the dev-master versions (latest source code from github) run:

`php lore.php --install --dev`

Also look at the commands in "init.php" for the rest of the instructions to setup the server. 
Once these commands are run (they are somewhat standard for Laravel, and then a few additional commands for Zermelo and DURC) you should have a working instance. 

Then, to populate the interface run the artisan command to sync with scryfall: 

```php
./artisan scry:sync
```