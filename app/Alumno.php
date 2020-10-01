<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Moloquent;

class Alumno extends Moloquent
{

    protected $conexion = "mongodb";

    protected $collection = 'alumnos';

    public $timestamps = false;

}
