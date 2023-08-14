```markdown
# Symfony Project Name

Welcome to the Symfony Project Name! This is a [Symfony](https://symfony.com) application that does XYZ.

## Getting Started

These instructions will help you get a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

Before you begin, make sure you have the following software installed:

- PHP 8.1 or higher
- Composer (https://getcomposer.org/)
- Using SQlite

### Installing

1. Clone the repository:

   ```bash
   git clone https://github.com/esperluet/news_scrapper.git
   ```

2. Navigate to the project directory:

   ```bash
   cd news_scrapper
   ```

3. Install project dependencies using Composer:

   ```bash
   composer install
   ```

4. Create a `.env.local` file based on `.env` and configure your database connection:

   ```dotenv
   DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
   ```

5. Create the database and run migrations:

   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate
   ```

6. Start the local development server:

   ```bash
   symfony serve
   ```

The application should now be accessible at `http://localhost:8000`.

## Usage

Explain how to use your application here. Provide examples and explanations for common tasks. If your project has a web interface, describe the different pages and features.

## Running Tests

To run tests, execute the following command:

```bash
php bin/console phpunit
```

## Deployment

Describe the process of deploying your application to a production environment. Include any necessary configuration steps, server requirements, and deployment scripts.

## Built With

- [Symfony](https://symfony.com) - The PHP web framework used
- [Twig](https://twig.symfony.com) - The template engine
- [Doctrine](https://www.doctrine-project.org/) - The database toolkit

## Contributing

If you would like to contribute to this project, feel free to open a pull request. Please follow the [code of conduct](CODE_OF_CONDUCT.md) in all your interactions with the project.

## License

This project is licensed under the [MIT License](LICENSE).

## Acknowledgments

- Hat tip to anyone whose code was used
- Inspiration
- etc.

```