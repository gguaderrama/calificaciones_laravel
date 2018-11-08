<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calificaciones extends Model
{
	 public $timestamps = false;
     protected $table = 't_calificaciones';
     protected $fillable = ['id_t_materias', 'id_t_usuarios', 'calificacion', 'fecha_registro'];
}
