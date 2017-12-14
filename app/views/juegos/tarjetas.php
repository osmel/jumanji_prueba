<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view( 'header' ); ?>
<?php $this->load->view( 'navbar' ); ?>
 <?php 
 
    if (!isset($retorno)) {
        $retorno ='record/'.$this->session->userdata('id_participante');
        //$retorno =""; //registro_ticket
        //UPDATE `calimax_participantes` SET tarjeta='', tiempo_juego='' WHERE 1
        //http://juman.dev.com/record/9d6a4b86-ddd4-11e7-b76f-a81e846a651f
        //http://juman.dev.com/record/9d6a4b86-ddd4-11e7-b76f-a81e846a651f
    }
 ?>   



<div class="container mecanica">

<br><br><br><br>

<div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 tablero">  

       
           <?php for ($i = 1; $i <= count($cara); $i++) {

            ?>
                 <div class="col-xs-3 col-sm-2 col-md-1">
                    <div class="card<?php echo ( substr_count($tarjeta,$i.'+')>=1) ? 's': ''; ?>" valor="<?php echo ( substr_count($tarjeta,$i.'+')>=1) ? 's': 'n'; ?>" posicion="<?php echo $i; ?>" numero="<?php echo $misdatos[$i-1]; ?>" cara="<?php echo $cara[$i-1]; ?>" > 
                          
                          <div class="front" style="padding-bottom: 20px;"> 
                            <?php 
                                $imagen = ( substr_count($tarjeta,$i.'+')>=1) ? 'card'.$cara[$i-1].'.png' : 'modena.png';
                            ?>
                                <img  src="<?php echo base_url()?>img/fichas/<?php echo $imagen; ?>">
                                <?php //echo $misdatos[$i-1]; ?>
                          </div> 
                          <div class="back" style="padding-bottom: 20px; display: <?php echo ( substr_count($tarjeta,$i.'+')>=1) ? 'none': ''; ?>;">
                                
                                <img src="<?php echo base_url().'img/fichas/card'.$cara[$i-1].'.png'; ?>">
                                <?php //echo $misdatos[$i-1]; ?>
                               
                          </div> 
                    </div>      
                </div>
            <?php } ?>

    </div> 
     <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 text-center">
                <span class="reloj"><i class="fa fa-clock-o" aria-hidden="true"></i><span class="r1 countdown"></span></span>
    
      <div class="monedasvalor">
        <img src="<?php echo base_url(); ?>img/fichas/card1.png"><span> = 100 PTS</span>
      </div> 
      <div class="monedasvalor">
        <img src="<?php echo base_url(); ?>img/fichas/card2.png"><span> = 75 PTS</span>
      </div> 
      <div class="monedasvalor">
        <img src="<?php echo base_url(); ?>img/fichas/card3.png"><span> = 50 PTS</span>
      </div> 
      <div class="monedasvalor">
        <img src="<?php echo base_url(); ?>img/fichas/card4.png"><span> = 25 PTS</span>
      </div> 
      <div class="monedasvalor">
        <img src="<?php echo base_url(); ?>img/fichas/card5.png"><span> = 0 PTS</span>
      </div> 

    </div>
</div>

</div>
<script>

//https://nnattawat.github.io/flip/
    jQuery(document).ready(function($) {

         
         //cada vez que vira una carta
        jQuery('body').on('click','.card[valor="n"]', function (e) {               
          jQuery(this).attr('valor','s');
          jQuery(this).off('.flip'); //no flipear
          jQuery.ajax({ //guardar en la cookie el conteo
                    url : '/promojumanji/respuesta_tarjeta',
                    data : { 
                           posicion: $(this).attr('posicion'),
                        numero: $(this).attr('numero'),
                        cara: $(this).attr('cara'),
                        tiempo   :  $('span.r1').text(),
                        //cara: $('span.r1').html(), //'0:09', //$(this).attr('resp'),
                    },
                    type : 'POST',
                    dataType : 'json',
                    success : function(data) {  
                        //localStorage.setItem('fondo',  'nada' );
                        //localStorage.setItem('tiempo_fondo', '00:00:00');
                       

                       // localStorage.clear();
                        
                          if   (data.redireccion!='no') {
                                                            //new ok 
                                var url = "/promojumanji/proc_modal_facebook";
                                //alert(url);
                                jQuery('#modalMessage_face').modal({
                                      show:'true',
                                    remote:url,
                                }); 
                                
                          } else {
                            //window.location.href = '/promojumanji/'+data.redireccion;        
                          }
                            


                            
                          
                          return false;

                    }

            }); 


        });

        jQuery(".card[valor='n']").flip(); 

        //tiempo

        //si es la primera vez entonces
        if (!(localStorage.getItem('tiempo_fondo'))) {
            localStorage.setItem('tiempo_fondo', '00:05' );
            $('span.r1').html(localStorage.getItem('tiempo_fondo'));
        }



          //var timer2 = localStorage.getItem('tiempo_fondo');      
        
          var interval = setInterval(function() {
            var timer = localStorage.getItem('tiempo_fondo').split(':');
            console.log(localStorage.getItem('tiempo_fondo'));
            //return false;

              var minutes = parseInt(timer[0], 10);
              var seconds = parseInt(timer[1], 10);
              --seconds;
              minutes = (seconds < 0) ? --minutes : minutes;
              if (minutes < 0) clearInterval(interval);
              seconds = (seconds < 0) ? 59 : seconds;
              seconds = (seconds < 10) ? '0' + seconds : seconds;
              //minutes = (minutes < 10) ?  minutes : minutes;


            //minutes = (minutes < 10) ?  minutes : minutes;
              if (localStorage.getItem('tiempo_fondo').substring(0, 1) !="-"){
                  $('.countdown').html(minutes + ':' + seconds);
              } else {
                  $('.countdown').html('0:00');
              } 
              timer2 = minutes + ':' + seconds;
              localStorage.setItem('tiempo_fondo', minutes + ':' + seconds);



              if (localStorage.getItem('tiempo_fondo').substring(0, 1) =="-"){
                  $('.countdown').html('0:00');
              } 

              if (minutes == 0 && seconds == 0) {
                   

                         jQuery.ajax({ //guardar en la cookie el conteo
                                url : '/promojumanji/tiempo_juego',
                                data : { 
                                    tiempo   :  $('span.r1').text(),
                                },
                                type : 'POST',
                                dataType : 'json',
                                success : function(data) {  
                                    
                                    console.log(data);
                                    clearInterval(interval);  //limpiar el intervalo
                                    localStorage.clear();  //quitar las variables del localStorage

                                     //new ok 
                                    var url = "/promojumanji/proc_modal_facebook";
                                    //alert(url);
                                    jQuery('#modalMessage_face').modal({
                                          show:'true',
                                        remote:url,
                                    });

                                    
                                      return false;

                                }

                        }); 

              }
           
           
        }, 1000);



                                          
                                          
                                          
     //si cancela el facebook  entonces va a record     
    jQuery("body").on('hide.bs.modal','#modalMessage_face[ventana="facebook"]',function(e){  
        //clearInterval(interval);  //limpiar el intervalo
        localStorage.clear();  //quitar las variables del localStorage
        $catalogo = jQuery(this).attr('valor'); //e.target.name;
        window.location.href = '/promojumanji/'+$catalogo;                           
        //window.location.href = '/promojumanji/sukarne/registrar_facebook/0';
    }); 




    });
</script>

<?php $this->load->view( 'footer' ); ?>

<div class="modal fade bs-example-modal-lg" id="modalMessage_face" ventana="facebook" valor="<?php echo $retorno; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>

