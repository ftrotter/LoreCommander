-- Grant permissions for Zermelo cache and config databases
-- These databases are created dynamically by Zermelo

GRANT ALL PRIVILEGES ON `_zermelo_cache`.* TO 'loreuser'@'%';
GRANT ALL PRIVILEGES ON `_zermelo_config`.* TO 'loreuser'@'%';
GRANT CREATE ON *.* TO 'loreuser'@'%';

FLUSH PRIVILEGES;
