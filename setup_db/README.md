# Lore Setup Data

The purpose of the Lore Project is to test Zermelo and DURC, so setting up a lore server necessarily means also adding lots of test data.

## Automatic Database Loading

When the Docker Compose instance starts, the `setup_databases.sh` script automatically checks if any of the databases defined in this directory are missing or empty. If they are, the script will:

1. Create the database if it doesn't exist
2. Grant appropriate permissions to the application user
3. Load the SQL dump file into the database

This happens during container startup, before the Laravel migrations run. The script reads the database name from each SQL file's header (the `-- Host: localhost    Database: <name>` line) to determine which database to create.

## SQL Files

These include:

* `DURC_aaa.sql` - random stuff that does not fit elsewhere
* `DURC_irs.sql` - a lengthy dataset of IRS 990 data
* `DURC_northwind_data.sql` - a MySQL fork of the Microsoft Northwind database, the main repeating data parts
* `DURC_northwind_model.sql` - a MySQL fork of the Microsoft Northwind database, the meta-data and model parts
* `lore.sql` - a version of the lore database that does not include the card data, etc so that it will fit into github
* `_zermelo_config.sql` - Zermelo configuration database
* `wallpaper.sql` - wallpaper database
* `wallpaper_url.sql` - wallpaper URL database
* `socket_tests._zermelo_config.sql` - specific data (but not the create table statements) to setup the sockets and wrenches needed for the test reports (this file is skipped by automatic loading)

## What is missing from lore.sql

In order to make lore.sql manageable, the following tables should be emptied:

* card
* cardface
* cardprice
* classofc_cardface
* creature_cardface

These are the tables that can grow to be many megabytes of data. Without them, lore.sql is very small and manageable.
Remember, you should not DROP these tables but instead EMPTY them. This way running the artisan scry:sync command will rebuild them on a new instance.

## Manual Loading

If you need to manually reload a database, you can use the existing `load_databases.php` script:

```bash
docker-compose exec app php /var/www/html/LoreCommander/setup_db/load_databases.php
```

This will prompt for the root password and reload all databases, overwriting any existing data.
