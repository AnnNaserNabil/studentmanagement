# Student Management System

A comprehensive PHP-based student management system for educational institutions, featuring user management, course management, and more.

## Features

- User authentication (Admin, Teacher, Student)
- Student management
- Teacher management
- Course management
- Enrollment system
- Responsive design
- Export functionality (PDF, Excel)

## Prerequisites

- Docker and Docker Compose
- Git
- (Optional) Railway CLI for deployment

## Local Development with Docker

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd studentmanagement
   ```

2. **Copy the example environment file**
   ```bash
   cp .env.example .env
   ```
   
   Update the `.env` file with your database credentials if needed.

3. **Start the application**
   ```bash
   docker-compose up -d
   ```

4. **Initialize the database**
   ```bash
   docker-compose exec app /bin/sh -c "/var/www/html/init-db.sh"
   ```

5. **Access the application**
   - Web application: http://localhost:8080
   - PHPMyAdmin: http://localhost:8081
   - Default admin credentials:
     - Username: admin
     - Password: admin123

## Deployment to Railway

### Option 1: Using Railway CLI (Recommended)

1. **Install Railway CLI**
   ```bash
   npm install -g @railway/cli
   ```

2. **Login to Railway**
   ```bash
   railway login
   ```

3. **Run the deployment script**
   ```bash
   chmod +x deploy.sh
   ./deploy.sh
   ```

### Option 2: Manual Deployment via GitHub

1. **Push your code to a GitHub repository**

2. **Go to [Railway](https://railway.app/)** and log in

3. **Create a new project**
   - Click "New Project"
   - Select "Deploy from GitHub repo"
   - Authorize Railway with GitHub if needed
   - Select your repository

4. **Set up the database**
   - Add a new MySQL service
   - Link it to your application

5. **Configure environment variables**
   - Go to your project settings
   - Add the variables from `.env.example`
   - Update the values for production

6. **Deploy**
   - Railway will automatically deploy your application
   - Once deployed, click on the generated URL to access your application

## Environment Variables

Copy `.env.example` to `.env` and update the values as needed:

```env
# Database Configuration
DB_HOST=db
DB_PORT=3306
DB_DATABASE=schoolproject
DB_USERNAME=root
DB_PASSWORD=securepassword

# Application Configuration
APP_NAME="Student Management System"
APP_ENV=production
APP_DEBUG=false
APP_URL=http://your-railway-url.railway.app
```

## Database Schema

The database schema is automatically created when you run the initialization script. You can find the schema in `database/schema.sql`.

## Contributing

1. Fork the repository
2. Create a new branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is open source and available under the [MIT License](LICENSE).
