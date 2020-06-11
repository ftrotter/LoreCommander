Lore Setup Data
===================

The purpose of the Lore Project is to test Zermelo and DURC, so setting up a lore server nessecarily means also adding lots of test data. 
These include: 

* DURC_aaa.sql - random stuff that does not fit elsewhere
* DURC_irs.sql - a lengthy dataset of IRS 990 data
* DURC_northwind_data.sql - a MySQL fork of the microsoft southwind database, the main repeating data parts
* DURC_northwind_model.sql - a MySQL fork of the microsoft southwind databsae, the meta-data and model parts
* lore.sql - a version of the lore database that does not include the card data, etc so that it will fit into github
* socket_tests._zermelo_config.sql - specific data (but not the create table statements) to setup the sockets and wrenches needed for the test reports


What is missing from lore.sql
------------------------
In order to make lore.sql the following tables should be emptied: 

* card
* cardface
* cardprice
* classofc_cardface
* creature_cardface

These are the tables that can grow to be many megabytes of data. Without them, lore.sql is very small and manageable. 
Remember, you should not DROP these tables but instead EMPTY them. This way running the artisan scry:sync command will rebuild them on a new instance.
