# STInvoice Laravel Client Package

## Installation

You can install the package via composer:

```bash

composer require sankyutech/stinvoice-client

```

### Register Service Provider

Put StinvoiceClientServiceProvider in boostrap/providers.php or in configuration file app.php in provider section

```php

Sankyutech\StinvoiceClient\StinvoiceClientServiceProvider::class,

```

## (Optional) Migrate prepared database structure related to E-Invoice needs

This action will migrate directly to database without publish to application database/migration directory. If your application database migration not sync with database, this might be option.

```php

php artisan migrate --path=vendor/sankyutech/stinvoice-client/database/migrations

```

## Publish Vendor

### Database

If you want to track this database structure along with your application database migration, this might be the option

```php

php artisan vendor:publish --tag=stinvoice-migrations
php artisan migrate

```

## Usage


### Testing

```bash
composer test
```



### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email info@sankyutech.com instead of using the issue tracker.

## Credits

-   [SankyuTech](https://github.com/sankyutech)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

