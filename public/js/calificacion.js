	$(document).ready( function () {
	$.fn.dataTable.ext.errMode = 'none';
		table = $('#myTable').DataTable({
			"processing": true,
            "serverSide": true,
            "ajax": "/calificaciones",
            "columns": [
				{data: 'id_t_usuarios'},
				{data: 'nombre'},
				{data: 'apellido'},
				{data: 'nombre'},
				{data: 'calificacion'},
				{data: 'promedio'},
				{
				"mData": null,
				"bSortable": false,
				"mRender": function (o) { 
				return '<button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-success" data-target-usuario="'+ o.id_t_usuarios +'" data-target-materia="'+ o.id_t_materias+'">Editar</button><button type="button" data-toggle="modal" data-target="#ModalDelete" class="btn-ok btn btn-danger" data-target-usuario="'+ o.id_t_usuarios +'" data-target-materia="'+ o.id_t_materias+'">Eliminar</button>'; }
				}
            ],
    	 language: {
	        "decimal": "",
	        "emptyTable": "No hay información",
	        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
	        "infoEmpty": "Mostrando 0 de 0 Entradas",
	        "infoFiltered": "",
	        "infoPostFix": "",
	        "thousands": ",",
	        "lengthMenu": "Mostrar _MENU_ Entradas",
	        "loadingRecords": "Cargando...",
	        "processing": "Procesando...",
	        "search": "Buscar:",
	        "zeroRecords": "Sin resultados encontrados",
	        "paginate": {
	            "first": "Primero",
	            "last": "Ultimo",
	            "next": "Siguiente",
	            "previous": "Anterior"
	        }
    	}
    });
	$('#myModal').on('show.bs.modal', function (e) {
		$('select').prop("disabled", false);
		$('.number_only').on('keyup', function(){
          var Number = $(this).val();
           if(isNaN(Number) || Number > 10){
           	$('.number_only').val('')
           }
		});
		matter = $(e.relatedTarget).data('target-materia');
		user =  $(e.relatedTarget).data('target-usuario'); 

		if($.isNumeric(user)  && $.isNumeric(matter)){
			$('select.sAlumno option[value="'+user+'"]').prop('selected', true);
			$('select.sMateria option[value="'+matter+'"]').prop('selected', true);
			$('select').prop("disabled", true);
		}
	});
	$( "form" ).on( "submit", function(e) {
	    e.preventDefault();
	    e.stopImmediatePropagation();
 		data_type = 'POST';
 		url = "/calificaciones";
	  	$(".guardar").attr("disabled", true);
		if($('select.sAlumno').is(':disabled')){
  			data_type = 'PUT';
  			url = "/calificaciones/"+$("[name='id_t_usuarios']").val();	       
		}
  	  $.ajax({
        url: url,
        type: data_type,
        data: {
            "_token": $('meta[name="csrf-token"]').attr('content'),
            id_t_materias : $("[name='id_t_materias']").val(),
        	id_t_usuarios : $("[name='id_t_usuarios']").val(),
            calificacion : $("[name='calificacion']").val(),  
            fecha_registro :  $("[name='fecha_registro']").val()
        },
        dataType: "JSON",
        success: function (jsonStr) {

           $('#myModal').modal('toggle');

           $('select').val('');
           $('input').val('');
          if(jsonStr.success == 'ok'){
		   $("<div class='alert alert-success' role='alert'>"+jsonStr.msg+"</div>").appendTo('.mensaje');
			$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
			   $(".alert-success").remove();
			});
			table.ajax.reload();
        	}else{
        	var errorString = '<ul>';
	        $.each( jsonStr.msg, function( key, value) {
	            errorString += '<li>' + value + '</li>';
	        });
        	errorString += '</ul>';
			   		$("<div class='alert alert-danger' role='alert'>"+errorString+"</div>").appendTo('.mensaje');
			   		$(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
			    	$(".alert-danger").remove();
				});	
        	}
        	
        }
         // table.ajax.reload();
      });
     $(".guardar").attr("disabled", false);
           return false;
	});

  $("#Delete").on('click', function () { 
  	$(".delete").attr("disabled", false);
  	var  user =  $('.usuario').val();
	var matter = $('.materia').val();
	console.log('numero 0');
                  $.ajax({  
                     url: '/calificaciones/'+user,  
                     type: 'DELETE',  
                     dataType: 'json',  
                     data: { 
                     	 "_token": "{{ csrf_token() }}",
                     	'_method': 'delete',
                     	id_usuario : user,
                     	id_materia : matter
                     },  
                     success: function (data) {  
                     	console.log(data);
                        	$('#ModalDelete').modal('toggle'); 
						if(data.success == 'ok'){
						$("<div class='alert alert-success' role='alert'>"+data.msg+"</div>").appendTo('.mensaje');
						$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
						$(".alert-success").remove();
						});
						}
						table.ajax.reload();
     				},  
                     error: function (xhr, textStatus, errorThrown) {  
                         console.log('Error in Operation');  
                     }  
                 }); 
                   table.ajax.reload();
             });  
			$('#ModalDelete').on('show.bs.modal', function(e) {
				var  user =  $(e.relatedTarget).data('target-usuario'); 
				var matter = $(e.relatedTarget).data('target-materia');
				$('.materia').val(matter);
				$('.usuario').val(user);
			});  
});
