# Laravel Trivia

[![Latest Version on Packagist](https://img.shields.io/packagist/v/chriscrawford1/laravel-trivia.svg?style=flat-square)](https://packagist.org/packages/chriscrawford1/laravel-trivia)
[![Build Status](https://img.shields.io/travis/chriscrawford1/laravel-trivia/master.svg?style=flat-square)](https://travis-ci.org/chriscrawford1/laravel-trivia)
[![Total Downloads](https://img.shields.io/packagist/dt/chriscrawford1/laravel-trivia.svg?style=flat-square)](https://packagist.org/packages/chriscrawford1/laravel-trivia)

A package to fetch questions from the Open Trivia API using a familiar interface to Laravel.

## Installation

You can install the package via composer:

```bash
composer require chriscrawford1/laravel-trivia
```

## Usage

#### Basic Usage
Using Laravel Trivia is very simple. You can either use it the Laravel way
which will use Laravel Trivia's default client(Guzzle).
``` php
\ChrisCrawford1\LaravelTrivia\Facades\Questions::get();
```

Or if you wish to use it via an instantiation you can do so.
If you wish to to this, you will have to instantiate your own HTTP client and pass it in.

```php
$myVar = new \ChrisCrawford1\LaravelTrivia\Entities\LaravelTrivia($client);
```

#### Available Functions
You can use the functionality straight away after instantiation / facade usage with the 
`::get()` or `->get()` methods respective to your usage choice.

Using it like this will get 10 questions at medium difficulty from the API.

Should you wish to change this you can do the following.

```php
Questions::setNoOfQuestions(30)->setDifficulty('hard')->get();
```

These two options can be chained in any order you like and once you have selected
what you would like to change, you simply add `->get()` to the end of it as demonstrated above.

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email christopher.crawford1@outlook.com instead of using the issue tracker.

## Credits

- [Christopher Crawford](https://github.com/chriscrawford1)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
