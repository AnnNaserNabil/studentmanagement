#!/bin/bash

# Check if Railway CLI is installed
if ! command -v railway &> /dev/null; then
    echo "Railway CLI not found. Installing..."
    npm install -g @railway/cli
fi

# Login to Railway if not already logged in
if ! railway status &> /dev/null; then
    echo "Logging in to Railway..."
    railway login
fi

# Create a new project or use existing one
echo "Setting up Railway project..."
railway init

# Link to existing project if .railway directory exists
if [ -d ".railway" ]; then
    echo "Linking to existing Railway project..."
    railway link
fi

# Set environment variables
echo "Setting up environment variables..."
railway variables set NODE_ENV=production

# Deploy the application
echo "Deploying to Railway..."
railway up --detach

echo "Deployment complete! Your app is being deployed to Railway."
echo "Once deployed, you can access it at the URL provided in your Railway dashboard."
