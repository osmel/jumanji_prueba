jQuery(document).ready(function($) {


	//logueo y recuperar contraseña
	jQuery("#form_login").submit(function(e){
		jQuery('#foo').css('display','block');

		var spinner = new Spinner(opts).spin(target);

		jQuery(this).ajaxSubmit({
			success: function(data){
				
				if(data != true){
					spinner.stop();
					jQuery('#foo').css('display','none');
					jQuery('#messages').css('display','block');
					jQuery('#messages').addClass('alert-danger');
					jQuery('#messages').html(data);
					jQuery('html,body').animate({
						'scrollTop': jQuery('#messages').offset().top
					}, 1000);
				}else{
						spinner.stop();
						jQuery('#foo').css('display','none');

						window.location.href = '/promojumanji/admin';
				}
			}
		});
		return false;
	});





	//gestion de usuarios (crear, editar y eliminar )
	jQuery('body').on('submit','#form_usuarios', function (e) {	


		jQuery('#foo').css('display','block');
		var spinner = new Spinner(opts).spin(target);

		jQuery(this).ajaxSubmit({
			success: function(data){
				if(data != true){
					
					spinner.stop();
					jQuery('#foo').css('display','none');
					jQuery('#messages').css('display','block');
					jQuery('#messages').addClass('alert-danger');
					jQuery('#messages').html(data);
					jQuery('html,body').animate({
						'scrollTop': jQuery('#messages').offset().top
					}, 1000);
				

				}else{
						$catalogo = e.target.name;
						spinner.stop();
						jQuery('#foo').css('display','none');
						window.location.href = '/promojumanji/'+$catalogo;				
				}
			} 
		});
		return false;
	});	








jQuery('#tabla_usuarios').dataTable( {
	
	  "pagingType": "full_numbers",
		
		"processing": true,
		"serverSide": true,
		"ajax": {
	            	"url" : "/promojumanji/procesando_usuarios",
	         		"type": "POST",
	         		
	     },   

		"language": {  //tratamiento de lenguaje
			"lengthMenu": "Mostrar _MENU_ registros por página",
			"zeroRecords": "No hay registros",
			"info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(Mostrando _TOTAL_ de _MAX_ registros totales)",  
			"emptyTable":     "No hay registros",
			"infoPostFix":    "",
			"thousands":      ",",
			"loadingRecords": "Leyendo...",
			"processing":     "Procesando...",
			"search":         "Buscar:",
			"paginate": {
				"first":      "Primero",
				"last":       "Último",
				"next":       "Siguiente",
				"previous":   "Anterior"
			},
			"aria": {
				"sortAscending":  ": Activando para ordenar columnas ascendentes",
				"sortDescending": ": Activando para ordenar columnas descendentes"
			},
		},


		"columnDefs": [
			    	
			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[2]+' '+row[3]; //nombre+apellidos
		                },
		                "targets": [0] 
		            },


			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[1]; //perfil
		                },
		                "targets": [1] //,2,3,4
		            },		            

			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[4]; //email
		                },
		                "targets": [2] //,2,3,4
		            },


		            {
		                "render": function ( data, type, row ) {

						texto='<td>';
							texto+='<a href="/promojumanji/editar_usuario/'+jQuery.base64.encode(row[0])+'" type="button"'; 
							texto+=' class="btn btn-warning btn-sm btn-block" >';
								texto+=' <span class="glyphicon glyphicon-edit"></span>';
							texto+=' </a>';
						texto+='</td>';



							return texto;	
		                },
		                "targets": 3
		            },

		            
		            {
		                "render": function ( data, type, row ) {

		                	if (true) {  //row[4]==0
	   							texto='	<td>';								
									texto+=' <a href="/promojumanji/eliminar_usuario/'+jQuery.base64.encode(row[0])+'/'+jQuery.base64.encode(row[2]+' '+row[3])+ '"'; 
									texto+=' class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#modalMessage">';
									texto+=' <span class="glyphicon glyphicon-remove"></span>';
									texto+=' </a>';
								texto+=' </td>';	
		                	} else {
	   							texto='	<fieldset disabled> <td>';								
									texto+=' <a href="#"'; 
									texto+=' class="btn btn-danger btn-sm btn-block">';
									texto+=' <span class="glyphicon glyphicon-remove"></span>';
									texto+=' </a>';
								texto+=' </td></fieldset>';	
	                		
		                	}
									


							return texto;	
		                },
		                "targets": 4
		            },
		           
		            
		        ],
	});	

	jQuery('#modalMessage').on('hide.bs.modal', function(e) {
	    jQuery(this).removeData('bs.modal');
	});	






jQuery('#tabla_acceso_usuario').dataTable( {
	
	  "pagingType": "full_numbers",
		
		"processing": true,
		"serverSide": true,
		"ajax": {
	            	"url" : "/promojumanji/procesando_historico_accesos",
	         		"type": "POST",
	         		
	     },   

		"language": {  //tratamiento de lenguaje
			"lengthMenu": "Mostrar _MENU_ registros por página",
			"zeroRecords": "No hay registros",
			"info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(Mostrando _TOTAL_ de _MAX_ registros totales)",  
			"emptyTable":     "No hay registros",
			"infoPostFix":    "",
			"thousands":      ",",
			"loadingRecords": "Leyendo...",
			"processing":     "Procesando...",
			"search":         "Buscar:",
			"paginate": {
				"first":      "Primero",
				"last":       "Último",
				"next":       "Siguiente",
				"previous":   "Anterior"
			},
			"aria": {
				"sortAscending":  ": Activando para ordenar columnas ascendentes",
				"sortDescending": ": Activando para ordenar columnas descendentes"
			},
		},


/*

 									0=>$row->nombre,
                                      1=>$row->apellidos,
                                      2=>$row->perfil,
                                      3=>$row->email,
                                      4=>$row->fecha,
                                      5=>$row->ip_address,
                                      6=>$row->user_agent,
                                      7=>$row->telefono,
*/

		"columnDefs": [
			    	
			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[0]+' '+row[1]; //nombre+apellidos
		                },
		                "targets": [0] 
		            },


			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[2]; //perfil
		                },
		                "targets": [1] 
		            },		            

			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[3]; //email
		                },
		                "targets": [2] 
		            },


			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[4]; //fecha
		                },
		                "targets": [3] 
		            },

			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[5]; //ip_addrees
		                },
		                "targets": [4] 
		            },

		            		            			    	{ 
		            "render": function ( data, type, row ) {
		                		return row[6]; //user_agent
		                },
		                "targets": [5] 
		            },


					{ 
		                 "visible": false,
		                "targets": [6]
		            }

		            
		        ],
	});	

jQuery('#tabla_listado_completo').dataTable( {
	
	  "pagingType": "full_numbers",
		 "order": [[ 3, "desc" ]], //comience ordenado por el q más punto tiene
		"processing": true,
		"serverSide": true,
		"ajax": {
	            	"url" : "/promojumanji/procesando_listado_completo",
	         		"type": "POST",
	         		
	     },   

		"language": {  //tratamiento de lenguaje
			"lengthMenu": "Mostrar _MENU_ registros por página",
			"zeroRecords": "No hay registros",
			"info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(Mostrando _TOTAL_ de _MAX_ registros totales)",  
			"emptyTable":     "No hay registros",
			"infoPostFix":    "",
			"thousands":      ",",
			"loadingRecords": "Leyendo...",
			"processing":     "Procesando...",
			"search":         "Buscar:",
			"paginate": {
				"first":      "Primero",
				"last":       "Último",
				"next":       "Siguiente",
				"previous":   "Anterior"
			},
			"aria": {
				"sortAscending":  ": Activando para ordenar columnas ascendentes",
				"sortDescending": ": Activando para ordenar columnas descendentes"
			},
		},


 
		"columnDefs": [
			    	
			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[8]; //Fecha creación
		                },
		                "targets": [0] 
		            },		            


			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[1]+' '+row[2]; //nombre+apellidos
		                },
		                "targets": [1] 
		            },


			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[3]; //fecha nacimiento
		                },
		                "targets": [2] 
		            },		           		            


			    
		            { 
		                "render": function ( data, type, row ) {
		                		return row[4]; //ciudad
		                },
		                "targets": [3] //ciudad
		            },


		            { 
		                "render": function ( data, type, row ) {
		                		return row[5]; //celular
		                },
		                "targets": [4] 
		            },

		            { 
		                "render": function ( data, type, row ) {
		                		return row[6]; //email
		                },
		                "targets": [5] 
		            },

		            { 
		                "render": function ( data, type, row ) {
		                		return row[7]; //contraseña
		                },
		                "targets": [6] 
		            },



					{ 

		                 "visible": false,
		                "targets": [7,8] //6
		            }
		            
		           
		            
		        ],
	});	



//listado de participantes

jQuery('#tabla_participantes').dataTable( {
	  "pagingType": "full_numbers",
		   "order": [[ 3, "desc" ]], //comience ordenado por el q más punto tiene
		"processing": true,
		"serverSide": true,
		"ajax": {
	            	"url" : "/promojumanji/procesando_participantes",
	         		"type": "POST",
	     },   
		"language": {  //tratamiento de lenguaje
			"lengthMenu": "Mostrar _MENU_ registros por página",
			"zeroRecords": "No hay registros",
			"info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(Mostrando _TOTAL_ de _MAX_ registros totales)",  
			"emptyTable":     "No hay registros",
			"infoPostFix":    "",
			"thousands":      ",",
			"loadingRecords": "Leyendo...",
			"processing":     "Procesando...",
			"search":         "Buscar:",
			"paginate": {
				"first":      "Primero",
				"last":       "Último",
				"next":       "Siguiente",
				"previous":   "Anterior"
			},
			"aria": {
				"sortAscending":  ": Activando para ordenar columnas ascendentes",
				"sortDescending": ": Activando para ordenar columnas descendentes"
			},
		},

 
		"columnDefs": [
			    	
			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[12]; //Fecha creación
		                },
		                "targets": [0] 
		            },		            
					{ 
		                "render": function ( data, type, row ) {
		                		return row[2]+' '+row[3]; //nombre y apellidos
		                },
		                "targets": [1] 
		            },

					{ 
		                "render": function ( data, type, row ) {
		                		return row[2]; //equipo
		                },
		                "targets": [14] 
		            },		         

					{ 
		                "render": function ( data, type, row ) {
		                		return row[15]; //total
		                },
		                "targets": [3] 
		            },		            
					{ 
		                "render": function ( data, type, row ) {
		                		return row[10]; //contrasena
		                },
		                "targets": [4] 
		            },
					{ 
		                "render": function ( data, type, row ) {
		                		return row[9]; //email
		                },
		                "targets": [5] 
		            },		            
					{ 
		                "render": function ( data, type, row ) {
		                		return row[5]; //celular
		                },
		                "targets": [6] 
		            },

					{ 
		                "render": function ( data, type, row ) {
		                		return row[1]; //estado
		                },
		                "targets": [7] 
		            },

			    	{ 
		                "render": function ( data, type, row ) {
		                			return row[6]; //JUEGO
		                },
		                "targets": [8] 
		            },

			    	{ 
		                "render": function ( data, type, row ) {
		                			return row[7]; //TIEMPO JUEGO
		                },
		                "targets": [9]  
		            },
		            
			    	{ 
		                "render": function ( data, type, row ) {
		                			return row[8]; //jefe o invitado
		                },
		                "targets": [10] 
		            },

					{ 


		                 "visible": false,
		                 "targets": [11,12,13,14,15] //6
		                
		            }
		            
		           
		            
		        ],
	});	







jQuery('#tabla_detalle_participantes').dataTable( {
	
	  "pagingType": "full_numbers",
		
		"processing": true,
		"serverSide": true,
		"ajax": {
	            	"url" : "/promojumanji/procesando_detalle_participantes",
	         		"type": "POST",
	         		"data": function ( d ) {
	         		 	d.id = jQuery('#id').val();  
	         		 },
	         		
	     },   

		"language": {  //tratamiento de lenguaje
			"lengthMenu": "Mostrar _MENU_ registros por página",
			"zeroRecords": "No hay registros",
			"info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(Mostrando _TOTAL_ de _MAX_ registros totales)",  
			"emptyTable":     "No hay registros",
			"infoPostFix":    "",
			"thousands":      ",",
			"loadingRecords": "Leyendo...",
			"processing":     "Procesando...",
			"search":         "Buscar:",
			"paginate": {
				"first":      "Primero",
				"last":       "Último",
				"next":       "Siguiente",
				"previous":   "Anterior"
			},
			"aria": {
				"sortAscending":  ": Activando para ordenar columnas ascendentes",
				"sortDescending": ": Activando para ordenar columnas descendentes"
			},
		},



		"columnDefs": [
			    	
			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[1]; //total de puntos acumulados
		                },
		                "targets": [0] 
		            },		            


			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[2]; //caritas o resultados
		                },
		                "targets": [1] 
		            },


			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[3]; //monto
		                },
		                "targets": [2] 
		            },		            

			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[4]; //ticket
		                },
		                "targets": [3] 
		            },

			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[5]; //transaccion
		                },
		                "targets": [4] 
		            },
			    	/*
			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[6]; //codigo_producto
		                },
		                "targets": [5] 
		            },*/


			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[7]; //fecha de compra
		                },
		                "targets": [5] 
		            },

		            

					// { 
		   //              "render": function ( data, type, row ) {
		   //              		return row[10]; 
		   //              },
		   //              "targets": [6]  //redes
		   //          },		            
			    	
			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[11]; //fecha de compra
		                },
		                "targets": [6] 
		            },
			    	/*{ 
		                "render": function ( data, type, row ) {
		                		return row[11]; //litraje
		                },
		                "targets": [7] 
		            },

					{ 
		                "render": function ( data, type, row ) {
		                		return row[9]; //cantidad
		                },
		                "targets": [8] 
		            },*/

 					
		            
					{ 

		                 "visible": false,
		                "targets": [] //6
		            }
		            
		           
		            
		        ],
	});	



//historico de participantes

jQuery('#tabla_bitacora_participante').dataTable( {
	
	  "pagingType": "full_numbers",
		
		"processing": true,
		"serverSide": true,
		"ajax": {
	            	"url" : "/promojumanji/procesando_historico_participantes",
	         		"type": "POST",
	         		
	     },   

		"language": {  //tratamiento de lenguaje
			"lengthMenu": "Mostrar _MENU_ registros por página",
			"zeroRecords": "No hay registros",
			"info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"infoEmpty": "No hay registros disponibles",
			"infoFiltered": "(Mostrando _TOTAL_ de _MAX_ registros totales)",  
			"emptyTable":     "No hay registros",
			"infoPostFix":    "",
			"thousands":      ",",
			"loadingRecords": "Leyendo...",
			"processing":     "Procesando...",
			"search":         "Buscar:",
			"paginate": {
				"first":      "Primero",
				"last":       "Último",
				"next":       "Siguiente",
				"previous":   "Anterior"
			},
			"aria": {
				"sortAscending":  ": Activando para ordenar columnas ascendentes",
				"sortDescending": ": Activando para ordenar columnas descendentes"
			},
		},



		"columnDefs": [
			    	
			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[1]+' '+row[2]; //nombre+apellidos
		                },
		                "targets": [0] 
		            },

			    	{ 
		                "render": function ( data, type, row ) {
		                		return '@'+row[3]; //nick
		                },
		                "targets": [1] 
		            },


			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[4]; //email
		                },
		                "targets": [2] 
		            },


			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[5]; //fecha acceso
		                },
		                "targets": [3] 
		            },

			    	{ 
		                "render": function ( data, type, row ) {
		                		return row[6]; //ip_addrees
		                },
		                "targets": [4] 
		            },

		            		            			    	{ 
		            "render": function ( data, type, row ) {
		                		return row[7]; //user_agent
		                },
		                "targets": [5] 
		            },


					{ 
		                 "visible": false,
		                "targets": [6,7]
		            }

		            
		        ],
	});	

/////////////////////////////////premios///////////////////////

jQuery('#tabla_cat_premios').dataTable( {
  
    "pagingType": "full_numbers",
    
    "processing": true,
    "serverSide": true,
    "ajax": {
                "url" : "/promojumanji/procesando_cat_premios",
              "type": "POST",
              
       },   

    "language": {  //tratamiento de lenguaje
      "lengthMenu": "Mostrar _MENU_ registros por página",
      "zeroRecords": "No hay registros",
      "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "infoEmpty": "No hay registros disponibles",
      "infoFiltered": "(Mostrando _TOTAL_ de _MAX_ registros totales)",  
      "emptyTable":     "No hay registros",
      "infoPostFix":    "",
      "thousands":      ",",
      "loadingRecords": "Leyendo...",
      "processing":     "Procesando...",
      "search":         "Buscar:",
      "paginate": {
        "first":      "Primero",
        "last":       "Último",
        "next":       "Siguiente",
        "previous":   "Anterior"
      },
      "aria": {
        "sortAscending":  ": Activando para ordenar columnas ascendentes",
        "sortDescending": ": Activando para ordenar columnas descendentes"
      },
    },


    "columnDefs": [
            
            	{ 
                    "render": function ( data, type, row ) {
                        return row[1];
                    },
                    "targets": [0] //nombre
                },

            	{ 
                    "render": function ( data, type, row ) {
                        return row[2];
                    },
                    "targets": [1] //premio
                },
          
            	{ 
                    "render": function ( data, type, row ) {
                        return row[3];
                    },
                    "targets": [2] //cantidad
                },

                {
                    "render": function ( data, type, row ) {
				            texto='<td>';
				              texto+='<a href="promojumanji/editar_premio/'+jQuery.base64.encode(row[0])+'" type="button"'; 
				              texto+=' class="btn btn-warning btn-sm btn-block" >';
				                texto+=' <span class="glyphicon glyphicon-edit"></span>';
				              texto+=' </a>';
				            texto+='</td>';
				              return texto; 
                    },
                    "targets": 3
                },
                
                {
                    "render": function ( data, type, row ) {
		                      if (row[4]==0) {
					                  texto=' <td>';                
					                  texto+=' <a href="promojumanji/eliminar_premio/'+jQuery.base64.encode(row[0])+'/'+jQuery.base64.encode(row[1])+ '"'; 
					                  texto+=' class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#modalMessage">';
					                  texto+=' <span class="glyphicon glyphicon-remove"></span>';
					                  texto+=' </a>';
					                texto+=' </td>';  
					                      } else {
					                  texto=' <fieldset disabled> <td>';                
					                  texto+=' <a href="#"'; 
					                  texto+=' class="btn btn-danger btn-sm btn-block">';
					                  texto+=' <span class="glyphicon glyphicon-remove"></span>';
					                  texto+=' </a>';
					                texto+=' </td></fieldset>'; 
					                      
					          }
		             		return texto; 
			       },
			           "targets": 4
			    },
               
                
            ],
  }); 

/////////////////////////////////imagenes///////////////////////

jQuery('#tabla_cat_imagenes').dataTable( {
  
    "pagingType": "full_numbers",
    
    "processing": true,
    "serverSide": true,
    "ajax": {
                "url" : "/promojumanji/procesando_cat_imagenes",
              "type": "POST",
              
       },   

    "language": {  //tratamiento de lenguaje
      "lengthMenu": "Mostrar _MENU_ registros por página",
      "zeroRecords": "No hay registros",
      "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "infoEmpty": "No hay registros disponibles",
      "infoFiltered": "(Mostrando _TOTAL_ de _MAX_ registros totales)",  
      "emptyTable":     "No hay registros",
      "infoPostFix":    "",
      "thousands":      ",",
      "loadingRecords": "Leyendo...",
      "processing":     "Procesando...",
      "search":         "Buscar:",
      "paginate": {
        "first":      "Primero",
        "last":       "Último",
        "next":       "Siguiente",
        "previous":   "Anterior"
      },
      "aria": {
        "sortAscending":  ": Activando para ordenar columnas ascendentes",
        "sortDescending": ": Activando para ordenar columnas descendentes"
      },
    },


    "columnDefs": [
            
            	{ 
                    "render": function ( data, type, row ) {
                        return row[1];
                    },
                    "targets": [0] //nombre
                },

            	{ 
                    "render": function ( data, type, row ) {
                        return row[2];
                    },
                    "targets": [1] //imagen
                },
          
            	{ 
                    "render": function ( data, type, row ) {
                        return row[3];
                    },
                    "targets": [2] //puntos
                },

                {
                    "render": function ( data, type, row ) {
				            texto='<td>';
				              texto+='<a href="promojumanji/editar_imagen/'+(row[0])+'" type="button"'; 
				              texto+=' class="btn btn-warning btn-sm btn-block" >';
				                texto+=' <span class="glyphicon glyphicon-edit"></span>';
				              texto+=' </a>';
				            texto+='</td>';
				              return texto; 
                    },
                    "targets": 3
                },
                
                {
                    "render": function ( data, type, row ) {
		                      if (row[4]==0) {
					                  texto=' <td>';                
					                  texto+=' <a href="promojumanji/eliminar_imagen/'+(row[0])+'/'+jQuery.base64.encode(row[1])+ '"'; 
					                  texto+=' class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#modalMessage">';
					                  texto+=' <span class="glyphicon glyphicon-remove"></span>';
					                  texto+=' </a>';
					                texto+=' </td>';  
					                      } else {
					                  texto=' <fieldset disabled> <td>';                
					                  texto+=' <a href="#"'; 
					                  texto+=' class="btn btn-danger btn-sm btn-block">';
					                  texto+=' <span class="glyphicon glyphicon-remove"></span>';
					                  texto+=' </a>';
					                texto+=' </td></fieldset>'; 
					                      
					          }
		             		return texto; 
			       },
			           "targets": 4
			    },
               
                
            ],
  }); 

/////////////////////////////////Litrajes///////////////////////

jQuery('#tabla_cat_litrajes').dataTable( {
  
    "pagingType": "full_numbers",
    
    "processing": true,
    "serverSide": true,
    "ajax": {
                "url" : "/promojumanji/procesando_cat_litrajes",
              "type": "POST",
              
       },   

    "language": {  //tratamiento de lenguaje
      "lengthMenu": "Mostrar _MENU_ registros por página",
      "zeroRecords": "No hay registros",
      "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "infoEmpty": "No hay registros disponibles",
      "infoFiltered": "(Mostrando _TOTAL_ de _MAX_ registros totales)",  
      "emptyTable":     "No hay registros",
      "infoPostFix":    "",
      "thousands":      ",",
      "loadingRecords": "Leyendo...",
      "processing":     "Procesando...",
      "search":         "Buscar:",
      "paginate": {
        "first":      "Primero",
        "last":       "Último",
        "next":       "Siguiente",
        "previous":   "Anterior"
      },
      "aria": {
        "sortAscending":  ": Activando para ordenar columnas ascendentes",
        "sortDescending": ": Activando para ordenar columnas descendentes"
      },
    },


    "columnDefs": [
            
            { 
                    "render": function ( data, type, row ) {
                        return row[1];
                    },
                    "targets": [0] //,2,3,4
                },

          

                {
                    "render": function ( data, type, row ) {

            texto='<td>';
              texto+='<a href="promojumanji/editar_litraje/'+(row[0])+'" type="button"'; 
              texto+=' class="btn btn-warning btn-sm btn-block" >';
                texto+=' <span class="glyphicon glyphicon-edit"></span>';
              texto+=' </a>';
            texto+='</td>';


              return texto; 
                    },
                    "targets": 1
                },

                
                {
                    "render": function ( data, type, row ) {

                      if (row[2]==0) {
                  texto=' <td>';                
                  texto+=' <a href="promojumanji/eliminar_litraje/'+(row[0])+'/'+jQuery.base64.encode(row[1])+ '"'; 
                  texto+=' class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#modalMessage">';
                  texto+=' <span class="glyphicon glyphicon-remove"></span>';
                  texto+=' </a>';
                texto+=' </td>';  
                      } else {
                  texto=' <fieldset disabled> <td>';                
                  texto+=' <a href="#"'; 
                  texto+=' class="btn btn-danger btn-sm btn-block">';
                  texto+=' <span class="glyphicon glyphicon-remove"></span>';
                  texto+=' </a>';
                texto+=' </td></fieldset>'; 
                      
                      }
                  


              return texto; 
                    },
                    "targets": 2
                },
               
                
            ],
  }); 


/////////////////////////////////Estados///////////////////////



  jQuery('#tabla_cat_estados').dataTable( {
  
    "pagingType": "full_numbers",
    
    "processing": true,
    "serverSide": true,
    "ajax": {
                "url" : "/promojumanji/procesando_cat_estados",
              "type": "POST",
              
       },   

    "language": {  //tratamiento de lenguaje
      "lengthMenu": "Mostrar _MENU_ registros por página",
      "zeroRecords": "No hay registros",
      "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "infoEmpty": "No hay registros disponibles",
      "infoFiltered": "(Mostrando _TOTAL_ de _MAX_ registros totales)",  
      "emptyTable":     "No hay registros",
      "infoPostFix":    "",
      "thousands":      ",",
      "loadingRecords": "Leyendo...",
      "processing":     "Procesando...",
      "search":         "Buscar:",
      "paginate": {
        "first":      "Primero",
        "last":       "Último",
        "next":       "Siguiente",
        "previous":   "Anterior"
      },
      "aria": {
        "sortAscending":  ": Activando para ordenar columnas ascendentes",
        "sortDescending": ": Activando para ordenar columnas descendentes"
      },
    },


    "columnDefs": [
            
            { 
                    "render": function ( data, type, row ) {
                        return row[1];
                    },
                    "targets": [0] //,2,3,4
                },

          

                {
                    "render": function ( data, type, row ) {

            texto='<td>';
              texto+='<a href="promojumanji/editar_estado/'+(row[0])+'" type="button"'; 
              texto+=' class="btn btn-warning btn-sm btn-block" >';
                texto+=' <span class="glyphicon glyphicon-edit"></span>';
              texto+=' </a>';
            texto+='</td>';


              return texto; 
                    },
                    "targets": 1
                },

                
                {
                    "render": function ( data, type, row ) {

                      if (row[2]==0) {
                  texto=' <td>';                
                  texto+=' <a href="promojumanji/eliminar_estado/'+(row[0])+'/'+jQuery.base64.encode(row[1])+ '"'; 
                  texto+=' class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#modalMessage">';
                  texto+=' <span class="glyphicon glyphicon-remove"></span>';
                  texto+=' </a>';
                texto+=' </td>';  
                      } else {
                  texto=' <fieldset disabled> <td>';                
                  texto+=' <a href="#"'; 
                  texto+=' class="btn btn-danger btn-sm btn-block">';
                  texto+=' <span class="glyphicon glyphicon-remove"></span>';
                  texto+=' </a>';
                texto+=' </td></fieldset>'; 
                      
                      }
                  


              return texto; 
                    },
                    "targets": 2
                },
               
                
            ],
  }); 



	jQuery('body').on('submit','#form_catalogos', function (e) {	


		jQuery('#foo').css('display','block');
		var spinner = new Spinner(opts).spin(target);

		jQuery(this).ajaxSubmit({
			success: function(data){
				if(data != true){
					
					spinner.stop();
					jQuery('#foo').css('display','none');
					jQuery('#messages').css('display','block');
					jQuery('#messages').addClass('alert-danger');
					jQuery('#messages').html(data);
					jQuery('html,body').animate({
						'scrollTop': jQuery('#messages').offset().top
					}, 1000);
				

				}else{
						$catalogo = e.target.name;
						spinner.stop();
						jQuery('#foo').css('display','none');
						window.location.href = '/promojumanji/'+$catalogo;				
				}
			} 
		});
		return false;
	});	

//Agregar las estradas a salidas
jQuery('body').on('click','#exportar_reportes', function (e) {
		  	  busqueda      = jQuery('input[type=search]').val();

	    abrir('POST', 'exportar_reportes', {
	    			busqueda:busqueda,
	    			tipo_reporte: jQuery(this).attr('nombre') //reportes_participante
	    }, '_blank' );
});






abrir = function(verb, url, data, target) {
  var form = document.createElement("form");
  form.action = url;
  form.method = verb;
  form.target = target || "_self";
  if (data) {
    for (var key in data) {
      var input = document.createElement("textarea");
      input.name = key;
      input.value = typeof data[key] === "object" ? JSON.stringify(data[key]) : data[key];
      form.appendChild(input);
    }
  }
  form.style.display = 'none';
  document.body.appendChild(form);
  form.submit();
};


	var opts = {
		lines: 13, 
		length: 20, 
		width: 10, 
		radius: 30, 
		corners: 1, 
		rotate: 0, 
		direction: 1, 
		color: '#E8192C',
		speed: 1, 
		trail: 60,
		shadow: false,
		hwaccel: false,
		className: 'spinner',
		zIndex: 2e9, 
		top: '50%', // Top position relative to parent
		left: '50%' // Left position relative to parent		
	};

	
	jQuery(".navigacion").change(function()	{
	    document.location.href = jQuery(this).val();
	});

   	var target = document.getElementById('foo');


});
