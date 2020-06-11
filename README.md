Lore Commander
====================
This is a test project for Zermelo/DURC and to host some data experiments with MTG Card data.

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


