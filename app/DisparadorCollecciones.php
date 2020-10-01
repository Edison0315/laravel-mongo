<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;

class DisparadorCollecciones extends Moloquent
{
    
    protected $conexion = "mongodb";

    protected $collection = 'disparadores_collecciones';

    public $timestamps = false;	
}
