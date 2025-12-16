-- Grant full privileges to loreuser on all databases
-- loreuser needs root-level access for ZZermelo and DURCC operations

GRANT ALL PRIVILEGES ON *.* TO 'loreuser'@'%' WITH GRANT OPTION;

-- Create the lore database
CREATE DATABASE IF NOT EXISTS `lore` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Create the graph_reports database for ZZermelo graph reports
CREATE DATABASE IF NOT EXISTS `graph_reports` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Create the _zzermelo_cache database for ZZermelo caching
CREATE DATABASE IF NOT EXISTS `_zzermelo_cache` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Source the lore database schema
USE `lore`;
SOURCE /docker-entrypoint-initdb.d/setup_db/lore.sql;

FLUSH PRIVILEGES;
