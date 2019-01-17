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
    "minhajul/activity-logger": "dev-master"
}
```
then execute `composer update` 

You can publish the config file by running this command:
```php artisan vendor:publish```

Run ```php artisan migrate``` to create related database

## Usages 

```php
// Add this trait in your model
use RecordsActivity;

// By default package will track 'created', 'updated' , 'deleted', 'restored' events if you want to override events you can add static $recordEvents in model 
protected static $recordEvents = [ 'created', 'updated']

// To fetch model events
$model->activities;

// To fetch events caused by specific user
$user->causedBy;
```

## Contributing

## Credits
- [Md. Minhajul Islam](https://github.com/minhajul)

## License
The MIT License (MIT). Please see [License File](LICENSE) for more information.