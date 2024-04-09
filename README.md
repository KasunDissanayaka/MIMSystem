# Laravel API Application (MIM App)

## Overview

This is a Laravel API application built to provide endpoints for managing customers and medication inventory. It utilizes Laravel Sanctum for API token authentication and Spatie Laravel Permission for handling user permissions. The application follows the repository design pattern for data access, separating database operations from the application logic.

## Features

- Authentication using API tokens with Laravel Sanctum.
- CRUD operations for managing customer records.
- CRUD operations for managing medication inventory.
- Role-based access control (RBAC) using Spatie Laravel Permission.
- Soft delete and permanent delete functionality for records.
- API routes protected by authentication and authorization middleware.
- Repository design pattern for data access.

## Requirements

- PHP >= 7.4
- Composer
- MySQL or SQLite or other compatible database

## Installation

1. Clone the repository:

   ```bash
     git clone https://github.com/KasunDissanayaka/MIMSystem.git
     cd api
     cp .env.example .env
     php artisan key:generate
     php artisan migrate
     php artisan db:seed

## Usage
    php artisan serve

## Requirements
  - PHP >= 7.4
  - MySQL or SQLite or compatible database
  - Access the API endpoints using your preferred HTTP client (e.g., Postman, Etc ...).

# API Endpoints

  ## Customers
  
  - `GET /v1/customers`: Get all customers.
  - `POST /v1/customers`: Create a new customer.
  - `GET /v1/customers/{id}`: Get a specific customer.
  - `PUT /v1/customers/{id}`: Update a customer.
  - `DELETE /v1/customers/{id}`: Delete a customer.
  - `DELETE /v1/customers/{id}/permanently`: Permanently delete a customer.
  - `GET /v1/customers/{id}/restore`: Restore a soft deleted customer.
  
  ## Medication Inventory
  
  - `GET /v1/medication`: Get all medication inventory.
  - `POST /v1/medication`: Create new medication inventory.
  - `GET /v1/medication/{id}`: Get specific medication inventory.
  - `PUT /v1/medication/{id}`: Update medication inventory.
  - `DELETE /v1/medication/{id}`: Delete medication inventory.
  - `DELETE /v1/medication/{id}/permanently`: Permanently delete medication inventory.
  - `GET /v1/medication/{id}/restore`: Restore a soft deleted medication inventory.

# Authentication and Authorization

- Authentication is handled via Laravel Sanctum.
- API routes are protected by the `auth:sanctum` middleware.
- Authorization is implemented using Spatie Laravel Permission.
- Role-based access control (RBAC) is used to restrict access to certain routes based on user roles and permissions.

# Repository Design Pattern

- The application follows the repository design pattern for data access.
- Repositories are responsible for encapsulating the logic required to access data sources.
- This separation of concerns allows for better organization and maintainability of the codebase.


