#Multilanguage

[![Build Status](https://travis-ci.org/Palmabit-IT/multilanguage.png)](https://travis-ci.org/Palmabit-IT/multilanguage)

##Description

This package adds multilanguage capability to your laravel app.

## Installation

The simplest method of installation is to install it as a global Composer package:

1. composer require `"palmabit/multilanguage 1.0.*"`
2. Add to your service providers the following string: `'Palmabit\Multilanguage\MultilanguageServiceProvider'`
3. Run the following command: `"php artisan asset:publish"`


## Docs

In order to see the docs install the laravel package example app: https://github.com/Palmabit-IT/package-examples


## API REST

### GET current language

    http://<url>/api/v1/lang

response:

    {
        "lang": "en"
    }

### Set new language (PUT)

    http://<url>/api/v1/lang/<new-lang>

response:

    {
        "success": true
        "lang": "en"
    }

### Set new language (POST)

    http://<url>/api/v1/lang

parameters:

    {
        "lang": "en"
    }

response:

    {
        "success": true
        "lang": "en"
    }
