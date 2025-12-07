#!/bin/bash
# setup_databases.sh
# This script checks if databases are missing or empty and loads them from SQL files in setup_db/
# It should be called from entrypoint.sh after the database is ready

SETUP_DB_DIR="/var/www/html/LoreCommander/setup_db"
DB_HOST="${DB_HOST:-db}"
DB_PORT="${DB_PORT:-3306}"
DB_USER="${DB_USERNAME:-root}"
DB_PASS="${DB_PASSWORD:-}"
DB_ROOT_PASS="${DB_ROOT_PASSWORD:-$DB_PASS}"

# Function to check if a database exists
database_exists() {
    local db_name="$1"
    local result=$(mysql -h "$DB_HOST" -P "$DB_PORT" -u root -p"$DB_ROOT_PASS" -N -e "SELECT SCHEMA_NAME FROM information_schema.SCHEMATA WHERE SCHEMA_NAME = '$db_name';" 2>/dev/null)
    [ -n "$result" ]
}

# Function to check if a database is empty (has no tables)
database_is_empty() {
    local db_name="$1"
    local table_count=$(mysql -h "$DB_HOST" -P "$DB_PORT" -u root -p"$DB_ROOT_PASS" -N -e "SELECT COUNT(*) FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$db_name';" 2>/dev/null)
    [ "$table_count" = "0" ] || [ -z "$table_count" ]
}

# Function to extract database name from SQL file header
get_database_name_from_sql_file() {
    local sql_file="$1"
    # Look for the "-- Host: localhost    Database: <name>" line in MySQL dumps
    local db_name=$(head -20 "$sql_file" | grep -E "^-- Host:.*Database:" | sed -E 's/.*Database: *([^ ]+).*/\1/')
    echo "$db_name"
}

# Function to create database if it doesn't exist
create_database_if_needed() {
    local db_name="$1"
    if ! database_exists "$db_name"; then
        echo "Creating database: $db_name"
        mysql -h "$DB_HOST" -P "$DB_PORT" -u root -p"$DB_ROOT_PASS" -e "CREATE DATABASE IF NOT EXISTS \`$db_name\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;" 2>/dev/null
        # Grant permissions to the application user
        mysql -h "$DB_HOST" -P "$DB_PORT" -u root -p"$DB_ROOT_PASS" -e "GRANT ALL PRIVILEGES ON \`$db_name\`.* TO '$DB_USER'@'%';" 2>/dev/null
        mysql -h "$DB_HOST" -P "$DB_PORT" -u root -p"$DB_ROOT_PASS" -e "FLUSH PRIVILEGES;" 2>/dev/null
    fi
}

# Function to load SQL file into database
load_sql_file() {
    local db_name="$1"
    local sql_file="$2"
    echo "Loading $sql_file into database $db_name..."
    mysql -h "$DB_HOST" -P "$DB_PORT" -u root -p"$DB_ROOT_PASS" "$db_name" < "$sql_file" 2>&1 | head -5
    if [ $? -eq 0 ]; then
        echo "Successfully loaded $db_name from $sql_file"
    else
        echo "Warning: There may have been issues loading $db_name from $sql_file"
    fi
}

# Main logic
echo "=============================================="
echo "Checking and loading setup databases..."
echo "=============================================="

# Check if setup_db directory exists
if [ ! -d "$SETUP_DB_DIR" ]; then
    echo "Warning: setup_db directory not found at $SETUP_DB_DIR"
    exit 0
fi

# Find all SQL files in setup_db (excluding files that start with socket_tests or README)
for sql_file in "$SETUP_DB_DIR"/*.sql; do
    # Skip if no files found
    [ -f "$sql_file" ] || continue
    
    # Get the filename
    filename=$(basename "$sql_file")
    
    # Skip certain files that are not full database dumps
    # socket_tests.* files are supplementary data, not full database dumps
    if [[ "$filename" == socket_tests.* ]]; then
        echo "Skipping supplementary file: $filename"
        continue
    fi
    
    # Extract database name from the SQL file
    db_name=$(get_database_name_from_sql_file "$sql_file")
    
    # If we couldn't extract a database name, try using the filename without .sql
    if [ -z "$db_name" ]; then
        db_name="${filename%.sql}"
        echo "Could not extract database name from $filename, using filename: $db_name"
    fi
    
    echo "----------------------------------------------"
    echo "Processing: $filename -> Database: $db_name"
    
    # Check if database exists
    if database_exists "$db_name"; then
        # Check if database is empty
        if database_is_empty "$db_name"; then
            echo "Database $db_name exists but is empty. Loading data..."
            load_sql_file "$db_name" "$sql_file"
        else
            echo "Database $db_name exists and has tables. Skipping."
        fi
    else
        echo "Database $db_name does not exist. Creating and loading..."
        create_database_if_needed "$db_name"
        load_sql_file "$db_name" "$sql_file"
    fi
done

echo "=============================================="
echo "Database setup check complete."
echo "=============================================="
