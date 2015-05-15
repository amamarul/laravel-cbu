Clave Bancaria Uniforme
=======================

Working on a project I needed to validate customers CBU, and I didn't like any of the available options so I decided to make my own.

### Installation
__composer.json__

    "maurocasas/laravel-cbu": "dev-master"

__app/config/app.php__

    $providers = array(
    	...
		'MauroCasas\Cbu\CbuServiceProvider'
    	)

That's it!

### Usage

First off, you need to set a CBU value

    Cbu::set('1234567890');

You can now use helpers functions

##### isValid()

    Cbu::set('23456789')->isValid();

##### bank()
Returns the Bank Name

    Cbu::set('23456789')->bank();

##### bankId()
Returns the Bank ID #

    Cbu::set('23456789')->bankId();