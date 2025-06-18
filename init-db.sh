#!/bin/bash
set -e

# Wait for MySQL to be ready
max_attempts=30
attempt=1

while ! mysqladmin ping -h"$DB_HOST" --silent; do
    if [ $attempt -ge $max_attempts ]; then
        echo "Error: MySQL server is not responding after $max_attempts attempts"
        exit 1
    fi
    echo "Waiting for MySQL to be ready (attempt $attempt/$max_attempts)..."
    sleep 2
    attempt=$((attempt + 1))
done

echo "MySQL is ready! Initializing database..."

# Create database if it doesn't exist
mysql -h"$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" -e "CREATE DATABASE IF NOT EXISTS \`$DB_DATABASE\`;"

# Import database schema if schema.sql exists
if [ -f "database/schema.sql" ]; then
    echo "Importing database schema..."
    mysql -h"$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" < database/schema.sql
fi

# Import initial data if data.sql exists
if [ -f "database/seeders/initial_data.sql" ]; then
    echo "Importing initial data..."
    mysql -h"$DB_HOST" -u"$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" < database/seeders/initial_data.sql
fi

echo "Database initialization complete!"

exec "$@"
