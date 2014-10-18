#Multilanguage

[![Build Status](https://travis-ci.org/Palmabit-IT/multilanguage.png)](https://travis-ci.org/Palmabit-IT/multilanguage)

##description

This package adds multilanguage capability to your laravel app.

## Installation

The simplest method of installation is to install it as a global Composer package:

1. composer require `"palmabit/multilanguage 1.0.*"`
2. Add to your service providers the following string: `'Palmabit\Multilanguage\MultilanguageServiceProvider'`
3. Run the following command: `"php artisan asset:publish"`


## Docs

In order to see the docs install the laravel package example app: https://github.com/Palmabit-IT/package-examples


## API REST (Version 1)

### GET current language

    http://<url>/api/v1/lang

the response is for example:

    {
        "lang": "en"
    }

### PUT new language

    http://<url>/api/v1/lang/<new-lang>

the response is for example:

    {
        "success": true
        "lang": "en"
    }

### POST new language

    http://<url>/api/v1/lang

in POST mode the API needs parameters as in this example:

    {
        "lang": "en"
    }

the response is for example:

    {
        "success": true
        "lang": "en"
    }
