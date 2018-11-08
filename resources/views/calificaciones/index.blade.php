<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="css/calificacion.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<!-- Latest compiled and minified JavaScript -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="js/calificacion.js"></script>
    </head>
    <body>
    	<div class="container">
        <div class="row calificaciones text-center">
    		<h3>Bienvenido al Sistema de Calificaciones</h3>
    	</div>
    	<div class="row margin_b">
    		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Registrar Calificación</button>
    	</div>	
        <div class="row mensaje">
    	</div>	
    	 <div class="row ">
    		<table class="table table-striped table-bordered" id="myTable">
    		<thead>
    			<th>Usuario</th>
    			<th>Nombre</th>
    			<th>Apellido</th>
    			<th>Materia</th>
    			<th>Calificación</th>
    			<th>Promedio</th>
    			<th></th>
    		</thead>
    		<tbody>
    		</tbody>
    	</table>
    	</div>
    	</div>
    	    	<!-- Modal Delete -->
		<div id="ModalDelete" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">¿Seguro que desea eliminar la calificación?</h4>
		      </div>
				<div class="modal-footer">
					<input type="hidden" name="materia" class="materia">
					<input type="hidden" name="materia" class="usuario">
					<button type="button"   id="Delete" class="btn btn-danger delete" onclick="">Si, Deseo Eliminarla</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
		  </div>
		</div>
		</div>
    	<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Registrar Calificación</h4>
		      </div>
		      <div class="modal-body">
		        	<form method="get" enctype="multipart/form-data">
 		        		<meta name="csrf-token" content="{{ csrf_token() }}">
			 	       <div class="row">
				       		<div class="col-md-6 form-group">
				       		<label for="textbox1">Seleccione Alumno*</label>
				              <select class="form-control sAlumno" placeholder="Seleccione Alumno" name="id_t_usuarios" required>
				              	<option value="">Seleccione</option>
				              	@foreach ($Alumnos as $a)
				              		<option value="{{$a->id_t_usuarios}}">{{$a->nombre}}</option>
				              	@endforeach
				              </select>
							</div>
							<div class="col-md-6 form-group">
							<label for="textbox1">Seleccione Materia*</label>
				              <select class="form-control sMateria" placeholder="Seleccione Materia" 
				              name="id_t_materias" required>
								<option value="">Seleccione</option>
				                @foreach ($Materias as $m)
				              		<option value="{{$m->id_t_materias}}">{{$m->nombre}}</option>
				              	@endforeach
				              </select>
							</div>
							<div class="col-md-6 form-group">
								<label for="textbox1">Calificación*(Debe ser del 0 al 10)</label>
								<input type="text" class="form-control number_only" id="textbox1" name="calificacion" required />
							</div>
				       </div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary guardar">Guardar</button>
						    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						</div>
					</form>
				</div>
		  </div>
		</div>
	 	</div>
</body>
</html>



