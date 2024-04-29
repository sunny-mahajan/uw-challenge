# Secret message (uw-challenge)

## Description

This is a Laravel project for a chat application that allows users to communicate with each other.

## Table of Contents

-   [Installation](#installation)
-   [Usage](#usage)
-   [Contributing](#contributing)
-   [License](#license)

## Installation

Follow these steps to set up the project:

1. **Install PHP and MySQL or XAMPP:**

    - If you don't have PHP and MySQL installed, you can download and install them separately. Alternatively, you can use XAMPP, which includes both PHP and MySQL in one package.
    - PHP ^8.0: [Download PHP](https://www.php.net/downloads)
    - MySQL: [Download MySQL](https://dev.mysql.com/downloads/mysql/)
    - XAMPP: [Download XAMPP](https://www.apachefriends.org/download.html)

2. **Install Composer:**

    - Composer is required to manage dependencies in Laravel projects.
    - [Download Composer](https://getcomposer.org/download/)

3. **Clone the Project:**
    - Clone the project repository to your local machine:
        ```
        git clone https://github.com/sunny-mahajan/uw-challenge.git
        ```
4. **Setup Environment Variables:**

    - Navigate to the project directory and create a copy of the `.env.example` file named `.env`:
        ```
        cp .env.example .env
        ```
    - Open the `.env` file and configure the database connection settings, including `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`.

5. **Install Dependencies:**

    - Run the following command to install project dependencies:
        ```
        composer install
        npm install && npm run dev
        ```

6. **Generate Application Key:**

    - Generate the application key using Artisan:
        ```
        php artisan key:generate
        ```

7. **Run Migrations:**

    - Run database migrations to create the necessary tables:
        ```
        php artisan migrate
        ```

## Usage

1. **Serve the Application:**

    - Start the Laravel development server:
        ```
        php artisan serve
        ```
    - Access the application in your browser at `http://127.0.0.1:8000`.
    - Scheduler can be set using `php artisan schedule:run` command to auto delete unread messages after 24 hours.
    - To manually mark the unread messages as expired, command `php artisan mark:messagesExpire` can be used.

2. **Run seeders to generate users:**

    - `php artisan db:seed --class=UserSeeder` will create users with the usernames "john@example.com," "jane@example.com," "alice@example.com," and "bob@example.com."
    - The password for all users is "12345678"
    - You can log in as any user from the seeders to access the app.

3. **Start Chatting:**
    - Select a user from the dropdown to start chatting.
    - Send and receive messages.
    - Messages will be automatically deleted once the recipient has seen the message or after 24 hours.

## Contributing

Contributions are welcome! Please follow the [Contributing Guidelines](CONTRIBUTING.md) for more details.

## License

This project is licensed under the [MIT License](LICENSE).
