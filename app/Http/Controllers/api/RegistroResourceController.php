<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Calificaciones;
use App\Models\Alumnos;
use App\Models\Materias;
use Validator;
use Illuminate\Support\Facades\DB;
// use Datatables;



class RegistroResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(Calificaciones $Calificaciones, Materias $Materias, Alumnos $Alumnos)
    {
          $this->Calificaciones = $Calificaciones;
          $this->Materias = $Materias;
          $this->Alumnos = $Alumnos;
    }

    public function index()
    {
            $LisTable = DB::select('select a.id_t_usuarios,m.id_t_materias, a.nombre as name, a.ap_paterno as apellido, m.nombre, c.calificacion, (SELECT AVG(`calificacion`) from t_calificaciones GROUP BY id_t_usuarios) AS promedio FROM t_calificaciones as c 
            INNER JOIN t_alumnos as a ON c.id_t_usuarios = a.id_t_usuarios 
            INNER JOIN t_materias as m ON c.id_t_materias = m.id_t_materias 
            where a.activo = 1 GROUP BY  c.id_t_materias');
              return response()->json(['data' => $LisTable]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
         $msg = '';   
        $validator = Validator::make($request->all(), [
              'id_t_materias' => 'required|integer',
              'id_t_usuarios' => 'required|integer',
              'calificacion' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['success' => 'fail', 'msg' => $validator->errors()]);
        }
        $CalificacionExists = $this->Calificaciones->where('id_t_usuarios', '=', $request->id_t_usuarios)->where('id_t_materias', '=', $request->id_t_materias)->get();
         $msg = 'Calificacion YA HA sido Registrada para este usuario';   
        if($CalificacionExists->isEmpty()){
        $this->Calificaciones->create([
            'id_t_materias' => $request->id_t_materias,
            'id_t_usuarios' => $request->id_t_usuarios,
            'calificacion' =>  $request->calificacion,
            'fecha_registro' => date('Y-m-d H:i:s'),
        ]);

          $msg = 'Calificacion Registrada'; 
        }
        return response()->json(['success' => 'ok', 'msg' => $msg]);
        } catch (Exception $e) {
            return response()->json(['success' => 'fail', 'comments' => 'hbewfhbewhf']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if(!is_numeric($id)){
            return response()->json(['success' => 'fail', 'msg' => 'El valor debe ser numerico']);
        }
        $filter = 'AND c.id_t_usuarios='.$id;
        $LisTable = DB::select('select a.id_t_usuarios, a.nombre as name, a.ap_paterno as apellido, m.nombre, c.calificacion, (SELECT AVG(`calificacion`) from t_calificaciones GROUP BY id_t_usuarios) AS promedio FROM t_calificaciones as c 
        INNER JOIN t_alumnos as a ON c.id_t_usuarios = a.id_t_usuarios 
        INNER JOIN t_materias as m ON c.id_t_materias = m.id_t_materias 
        where a.activo = 1 '.$filter);
        return response()->json(['data' => $LisTable]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
       $id_t_usuarios = $request['id_usuario'];
       $id_t_materias = $request['id_materia'];
       $CalificacionEdit = $this->Calificaciones->where('id_t_usuarios', '=', $id_t_usuarios)
       ->where('id_t_materias', '=', $id_t_materias)->get();

        return response()->json(['data' => $CalificacionEdit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       $id_t_usuarios = $request->id_t_usuarios;
       $id_t_materias = $request->id_t_materias;
       $CalificacionDelete = $this->Calificaciones->where('id_t_usuarios', '=', $id_t_usuarios)
       ->where('id_t_materias', '=', $id_t_materias)->update(['calificacion' => $request->calificacion]);
          return response()->json(['success' => 'ok', 'msg' => 'Calificacion Actualizada']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
       $id_t_usuarios = $request['id_usuario'];
       $id_t_materias = $request['id_materia'];
       $CalificacionDelete = $this->Calificaciones->where('id_t_usuarios', '=', $id_t_usuarios)
       ->where('id_t_materias', '=', $id_t_materias)->delete();
          return response()->json(['success' => 'ok', 'msg' => 'Calificacion Eliminada']);
    }
}
