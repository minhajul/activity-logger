## Welcome to Laravel Activity Logger!

In one of my personal project I was needed to track model events(created, updated, deleted, restored) etc in database, So this was my purpose to create a package to simply track model events. If you are looking for full featured activity logger, I highly recommend to use this [spatie/laravel-activitylog](https://github.com/spatie/laravel-activitylog) package.

## Installation 
You can install the package via composer by running this command in your terminal,

```
composer require minhajul/activity-logger
```
or 

```
"require": {
    "minhajul/activity-logger": "master"
}
```
then execute `composer update` 

You can publish the migration with:
```php artisan vendor:publish --provider="Minhajul\ActivityLogger\ActivityLoggerServiceProvider" --tag="migrations"```

Run ```php artisan migrate``` to create related database

## Contributing

## Credits
- [Md. Minhajul Islam](https://github.com/minhajul)

## License
The MIT License (MIT). Please see [License File](LICENSE) for more information.