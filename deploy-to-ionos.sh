#!/bin/bash
# Deployment Script for IONOS Server
# Usage: ./deploy-to-ionos.sh

echo "========================================="
echo "Team Mehrwert - IONOS Deployment Script"
echo "========================================="
echo ""

# IONOS Server Details
SERVER="home30227715.1and1-data.host"
USER="p7872929"
REMOTE_PATH="~/tmp/email"
LOCAL_PATH="public/"

echo "Server: $SERVER"
echo "User: $USER"
echo "Remote Path: $REMOTE_PATH"
echo "Local Path: $LOCAL_PATH"
echo ""

# Check if public folder exists
if [ ! -d "$LOCAL_PATH" ]; then
    echo "Error: public/ folder not found!"
    exit 1
fi

echo "Starting file upload..."
echo ""

# Use rsync to upload files
rsync -avz --progress \
    --exclude '.git' \
    --exclude '.gitignore' \
    --exclude 'node_modules' \
    "$LOCAL_PATH" "${USER}@${SERVER}:${REMOTE_PATH}/"

if [ $? -eq 0 ]; then
    echo ""
    echo "========================================="
    echo "✓ Deployment successful!"
    echo "========================================="
    echo ""
    echo "Next steps:"
    echo "1. SSH into server: ssh ${USER}@${SERVER}"
    echo "2. Check files: ls -la ~/tmp/email"
    echo "3. Set permissions: chmod 755 ~/tmp/email/api/*.php"
    echo "4. Test URL: http://[your-domain]/tmp/email/"
    echo ""
else
    echo ""
    echo "========================================="
    echo "✗ Deployment failed!"
    echo "========================================="
    echo ""
    exit 1
fi
