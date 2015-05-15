<?php namespace MauroCasas\Cbu\Facades {

    use Illuminate\Support\Facades\Facade;

    /**
     * @package Cbu
     * @version 0.1
     * @author Mauro Casas <casas.mauroluciano@gmail.com>
     */

    class Cbu extends Facade {
        
        protected static function getFacadeAccessor(){
            return 'cbu';
        }

    }

}