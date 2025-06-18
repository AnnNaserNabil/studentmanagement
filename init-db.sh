#!/bin/bash
set -e

# Wait for MySQL to be ready
echo "Waiting for MySQL to be ready on $DB_HOST:$DB_PORT..."
until mysqladmin ping -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USERNAME" -p"$DB_PASSWORD" --silent; do
    echo "MySQL is not ready yet. Retrying in 5 seconds..."
    sleep 5
done

# Create database if it doesn't exist
echo "Creating database $DB_DATABASE if it doesn't exist..."
mysql -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USERNAME" -p"$DB_PASSWORD" -e "CREATE DATABASE IF NOT EXISTS \`$DB_DATABASE\`;"

# Import schema
if [ -f "/app/database/schema.sql" ]; then
    echo "Importing schema..."
    mysql -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" < /app/database/schema.sql
    echo "Database schema imported successfully!"
else
    echo "Warning: schema.sql not found. Skipping database initialization."
fi

# Import initial data if data.sql exists
if [ -f "/app/database/seeders/initial_data.sql" ]; then
    echo "Importing initial data..."
    mysql -h"$DB_HOST" -P"$DB_PORT" -u"$DB_USERNAME" -p"$DB_PASSWORD" "$DB_DATABASE" < /app/database/seeders/initial_data.sql
fi

echo "Database initialization complete!"

exec "$@"
