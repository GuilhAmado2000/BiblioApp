# Base image
FROM node:18.16.0-alpine

# Set the working directory
WORKDIR /app

# Copy package.json and package-lock.json
COPY package*.json ./

# Install dependencies
RUN npm install

# Expose the development server port
EXPOSE 8080

# Start the development server
CMD npm run dev