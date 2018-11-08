<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Alumnos;
use App\Models\Materias;
use App\Models\Calificaciones;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller
{


	 public function __construct(Calificaciones $Calificaciones, Alumnos $Alumnos)
    {
          $this->Calificaciones = $Calificaciones;
          $this->Alumnos = $Alumnos;
    }

       public function index()
    {
    	/* Obtenemos el listado de Alumnos NOTA: Solo los activos*/
    	$Alumnos = Alumnos::where('activo', '1')->get();
    	/* Obtenemos el listado de Calificaciones NOTA: Solo los activos*/
    	$Materias = Materias::where('activo', '1')->get();
    	// return $LisTable;
        return View::make('calificaciones.index', array('Alumnos' => $Alumnos, 'Materias' => $Materias));
    }



       public function GetInformacion($id)
    {
    	/* Obtenemos el listado de Alumnos NOTA: Solo los activos*/
    	$Alumnos = Alumnos::where('activo', '1')->get();
    	/* Obtenemos el listado de Calificaciones NOTA: Solo los activos*/
    	$Materias = Materias::where('activo', '1')->get();
    	// return $LisTable;
        return View::make('calificaciones.index', array('Alumnos' => $Alumnos, 'Materias' => $Materias));
    }

}
