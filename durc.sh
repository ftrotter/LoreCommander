#!/bin/bash
rm resources/views/DURC/* -rf
php artisan DURC:mine --squash --DB=lore --DB=DURC_aaa --DB=DURC_irs --DB=DURC_northwind_model --DB=DURC_northwind_data
php artisan DURC:write  
cp routes/starting.web.php routes/web.php
cat routes/web.durc.php | tail -n +2 >> routes/web.php
cat routes/ending.web.php >> routes/web.php
composer clear-cache
composer dump-autoload
