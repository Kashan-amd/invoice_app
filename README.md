# invoice_app
A simple Invoice generation Laravel based web application. The application allows users to create, manage, and print invoices. It offers features such as adding customers, services, and user authentication.

## Table of Contents

- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Usage](#usage)

## Getting Started

Follow these instructions to set up and run the application on your local machine.

### Prerequisites

Before you begin, make sure you have the following installed:

- [PHP](https://www.php.net/) (>=7.3)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/)
- [NPM](https://www.npmjs.com/)
- [MySQL](https://www.mysql.com/) or another database of your choice

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/Kashan-amd/invoice_app.git
   ```

2. Navigate to the project directory:

   ```bash
   cd task-manager
   ```

3. Install PHP dependencies using Composer:

   ```bash
   composer install
   ```

4. Install JavaScript dependencies using NPM:

   ```bash
   npm install
   ```

5. Create a `.env` file if you don't already have one by copying `.env.example` and update it with your database configuration:

   ```bash
   cp .env.example .env
   ```

6. Generate a new application key:

   ```bash
   php artisan key:generate
   ```

7. Migrate the database:

   ```bash
   php artisan migrate
   ```

<<<<<<< HEAD
8. Start the vite:
=======
8. Start the development server:

   ```bash
   php artisan serve
   ```

9. Start the vite:
>>>>>>> 000ec0e86b4a9e797f106053ba62ddbb6450826d

```bash
yarn dev
```

9. Link storage:

```bash
php artisan storage:link
```

<<<<<<< HEAD
10. Start the development server:

   ```bash
   php artisan serve
   ```

11. Visit `http://localhost:8000` in your web browser to access the application.
=======
9. Visit `http://localhost:8000` in your web browser to access the application.
>>>>>>> 000ec0e86b4a9e797f106053ba62ddbb6450826d

## Usage

- Register for a new user account or log in if you already have one.
- Create customers and services.
- View and manage your invoices after creating them.
