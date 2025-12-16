-- Grant root-level permissions to loreuser
-- This gives full administrative access to all databases
GRANT ALL PRIVILEGES ON *.* TO 'loreuser'@'%' WITH GRANT OPTION;

FLUSH PRIVILEGES;
