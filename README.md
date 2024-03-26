# DEI Template - Laravel 11 + Vue 3

This repository is a template for a common set of tools use on DEI projects.

## TLDR Checklist

- [ ] **Laravel/backend**: Create and configure .env
- [ ] **Laravel/backend**: Run `php artisan key:generate` 
- [ ] **Vue/frontend**: Create and configure .env
- [ ] **Docker**: Check configurations
- [ ] **Gitea Actions**: Check configurations

## Components

When creating a new repository based on this template we will have the following components.

### Laravel 11

A Laravel instance on `src/backend`, with the defaults for version 11 for the framework.

In order to run this instance on the development environment we need to create the `.env` file (copy the `.env.example) and configure these options: 

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=docker
```

We should also run the command `php artisan key:generate` if we don't have PHP installed locally we can run `docker exec backend php artisan key:generate`.
 
### Vue

A Vue instance on `src/frontend`, with the defaults for version 3 of VueJS, with VueRouter, Pinia, ESLint and Prettier, and without Typescript or any testing tool.

We should create and `.env` file (copy from `.env.example`) and take notice of the variables used.

### Docker for Local Development

This template has a functioning docker-compose service set. If we want to merge our existing code we need to make sure we don't remove the docker elements:

- `src/docker-compose.yml`
- `src/backend/Dockerfile`
- `src/frontend/Dockerfile`

This service set has some assumptions, namely that the app versions are 11 and 3 for Laravel and Vue respectively. This might have an impact on the projects, with one common example being older versions of Vue having the startup command `npm run serve` and the new ones `npm run dev`. We need to check if the Dockerfiles match our applications.

To run the service set we run the command `docker-compose up` on the `src` folder. The first run will build the service set, if we need to rebuild it (we changed any of the Docker components) we run `docker-compose up --build*`.

### Gitea Actions for Staging Deployment

This repository also comes with a Gitea Actions (feature parity with Github Actions) for deploying to the staging environment at eah push to main. 

This work needs to be enabled and it depends on a set of configuration variables and secrets on the repository itself.

