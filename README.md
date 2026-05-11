# Determined Development Laravel Starter Kit

This is a [Laravel](https://laravel.com) starter kit used by [Determined Development](https://determineddevelopment.com). It is not an official starter kit, but is instead a collection of preferences on top of the standard [Laravel Project Skeleton](https://github.com/laravel/laravel).

The modifications to the Laravel skeleton are mostly setup steps and composer requirements that configure the base application to fit our common usage patterns.

## Local Environment Setup

The fastest way to work on this software locally is using [Laravel Sail](https://laravel.com/docs/11.x/sail).

**NB:** This will require [Docker](https://www.docker.com/).

### Configure the environment

Copy the file `.env.sail` to `.env` and update any necessary details. The majority of default settings in that file
should be sufficient without modification, however you should review it to ensure that everything is correct.

### Installing sail and dependencies

Once your environment is configured, you can install the application and dependencies with the following commands:

```bash
docker run --rm -u "$(id -u):$(id -g)" -v "$(pwd):/var/www/html" -w /var/www/html laravelsail/php82-composer:latest composer install --ignore-platform-reqs
alias sail="vendor/bin/sail"
sail up -d
sail composer install
sail artisan key:secret
sail npm ci
```

### Installing and seeding the database

You can install the database and fill it with development data using the following command:

```bash
sail artisan migrate:fresh --seed --seeder=DevelopmentSeeder
```

**NB** If you have an existing database configured, `migrate:fresh` will drop all tables, resulting in unrecoverable
data loss. It is likely a good idea to do this regularly to ensure that you aren't working with stale data.

### Build front-end assets

You have to build the frontend assets (CSS and JavaScript) before you can use the application. This can be done with the
following commands:

```bash
# To build all assets once
sail npm run build

# To watch for changes to assets so that the assets are automatically rebuilt as you make changes
sail npm run dev
```

### Access the site
Once this has been done, you should be able to access the site at [http://localhost](http://localhost).

#### Mail
All emails will be sent to "Mailpit", which you can access at [http://localhost:8025](http://localhost:8025). This will
capture all outbound email so that you can test updates as needed.

## Code Quality

The following code quality tools are installed and configured. These tools _will_ be run in CI, and merges will not be
accepted without passing all tests. Automatic code style fixes _will not_ be run in CI. Ensure that your code is
compliant before pushing.

### Code Style

The project adheres the [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standard.

The following scripts are available to check and fix code style issues:
```bash
# Check for any code style issues
composer lint
# Attempt to fix any code style issues
composer lint:fix
```
Individual tools are also available:

#### [Laravel Pint](https://laravel.com/docs/11.x/pint)

Configuration: `pint.json`
```bash
# Check for any code style issues
composer lint:pint
# Attempt to fix any code style issues
composer pint:fix
```

#### [PHP Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer)
Configuration: `phpcs.xml.dist`
```bash
# Check for any code style issues
composer lint:phpcs
# Attempt to fix any code style issues (using phpcbf)
composer phpcs:fix
```

### Static Analysis

#### [LaraStan](https://github.com/larastan/larastan)
Configuration: `phpstan.neon`
```bash
composer test:types
```

### Testing

Testing is done with the Laravel [testing framework](https://laravel.com/docs/11.x/testing), using
[Pest](https://pestphp.com/) to provide the testing setup.

**WARNING:** Tests require a testing database. If you do not configure a test database, this _will_ destroy your
development database. This is not necessary if you are using Sail - the test database is already configured.

Configuration: `phpunit.xml`
```bash
# Architecture tests
composer test:arch
# Feature tests
composer test:feat
# Unit tests
composer test:unit
# All tests
composer test
```

### Run all Checks
```bash
composer test:all
```

### Asset tests
Assets are tested using npm libraries.

#### [Biome](https://eslint.org/)
Configuration: `biome.json`
```bash
# Check for any code style issues
npx biome check
# Attempt to fix any code style issues
npx biome check --write
# Include "unsafe" fixes
npx biome check --write --unsafe
```

#### [ESLint](https://eslint.org/)
Configuration: `eslint.config.js`
```bash
npx eslint
```

#### [OXLint](https://oxc.rs/docs/guide/usage/linter.html)
Configuration: `.oxlintrc.json`
```bash
npx oxlint
```