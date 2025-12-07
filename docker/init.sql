-- Grant permissions for Zermelo cache and config databases
-- These databases are created dynamically by Zermelo
GRANT ALL PRIVILEGES ON `_zermelo_cache`.* TO 'loreuser'@'%';
GRANT ALL PRIVILEGES ON `_zermelo_config`.* TO 'loreuser'@'%';

-- Grant permissions for DURC test databases
-- These are loaded from SQL files in setup_db/
GRANT ALL PRIVILEGES ON `DURC_aaa`.* TO 'loreuser'@'%';
GRANT ALL PRIVILEGES ON `DURC_irs`.* TO 'loreuser'@'%';
GRANT ALL PRIVILEGES ON `DURC_northwind_data`.* TO 'loreuser'@'%';
GRANT ALL PRIVILEGES ON `DURC_northwind_model`.* TO 'loreuser'@'%';

-- Grant permissions for lore and wallpaper databases
GRANT ALL PRIVILEGES ON `lore`.* TO 'loreuser'@'%';
GRANT ALL PRIVILEGES ON `wallpaper`.* TO 'loreuser'@'%';
GRANT ALL PRIVILEGES ON `wallpaper_url`.* TO 'loreuser'@'%';

-- Allow the user to create new databases (needed for setup script)
GRANT CREATE ON *.* TO 'loreuser'@'%';

FLUSH PRIVILEGES;
