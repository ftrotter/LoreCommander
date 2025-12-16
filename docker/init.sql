-- Grant permissions for ZZermelo cache and config databases
-- These databases are created dynamically by ZZermelo

GRANT ALL PRIVILEGES ON `_zzermelo_cache`.* TO 'loreuser'@'%';
GRANT ALL PRIVILEGES ON `_zzermelo_config`.* TO 'loreuser'@'%';
GRANT CREATE ON *.* TO 'loreuser'@'%';

-- Create the lore database and grant permissions
CREATE DATABASE IF NOT EXISTS `lore` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
GRANT ALL PRIVILEGES ON `lore`.* TO 'loreuser'@'%';

-- Source the lore database schema
USE `lore`;
SOURCE /docker-entrypoint-initdb.d/setup_db/lore.sql;

FLUSH PRIVILEGES;
