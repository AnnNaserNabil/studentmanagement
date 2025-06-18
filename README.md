# Student Management System

A PHP-based student management system for educational institutions.

## Deployment to Railway

1. **Prerequisites**:
   - A GitHub account
   - A Railway account (sign up at [railway.app](https://railway.app/))

2. **Deployment Steps**:
   - Push your code to a GitHub repository
   - Go to [Railway](https://railway.app/) and log in
   - Click "New Project"
   - Select "Deploy from GitHub repo"
   - Authorize Railway with GitHub if needed
   - Select your repository
   - Railway will automatically detect it's a PHP app and deploy it
   - After deployment, click on the generated URL to access your application

3. **Environment Variables**:
   If your application uses environment variables (like database credentials), set them in the Railway dashboard under your project's "Variables" tab.

## Local Development

1. Clone the repository
2. Run `composer install`
3. Configure your local web server to point to the `public` directory
4. Access the application through your local server

## Database Setup

Make sure to set up your database connection in the appropriate configuration file before deploying.
