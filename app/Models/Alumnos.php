<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
     protected $table = 't_alumnos';


      public function AlumnosRelacion()
    {
        return $this->belongsTo('App\Models\Calificaciones');
    }

}
