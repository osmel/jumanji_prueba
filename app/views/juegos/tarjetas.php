<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php 
   
        /*
        $cant_fichas=30;
        $cant_caritas=5;
        $carita[1] = 20;
        $carita[2] = 20;
        $carita[3] = 20;
        $carita[4] = 20;
        $carita[5] = 20;

        
        $porciento[1]=($carita[1]*$cant_fichas)/100;
        $porciento[2]=($carita[2]*$cant_fichas)/100;
        $porciento[3]=($carita[3]*$cant_fichas)/100;
        $porciento[4]=($carita[4]*$cant_fichas)/100;
        $porciento[5]=($carita[5]*$cant_fichas)/100;

        $total = $porciento[1]+$porciento[2]+$porciento[3]+$porciento[4]+$porciento[5];


        for ($i = 1; $i <= $total; $i++) {
            $misdatos[]=$i;
          

        }   
        shuffle($misdatos);


        foreach ($misdatos as $key => $i) {
            
            $cara[]=($i<=$porciento[1])  ?  '1' : ($i<=$porciento[1]+$porciento[2] ? '2' : ($i<=$porciento[1]+$porciento[2]+ $porciento[3] ? '3' : ($i<=$porciento[1]+$porciento[2]+ $porciento[3]+ $porciento[4] ? '4' : '5' )));

        }*/
        /*
        print_r($misdatos);
        echo '<br>';
        echo '<br>';
        print_r($cara);*/
        //die;

        //count($cara); die;  

 ?>

<?php $this->load->view( 'header' ); ?>
<?php $this->load->view( 'navbar' ); ?>




<div class="container mecanica">

<br><br><br><br>

<div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">  

       
           <?php for ($i = 1; $i <= count($cara); $i++) {

            ?>
                 <div class="col-md-2">
                    <div class="card<?php echo ( substr_count($tarjeta,$i.'+')>=1) ? 's': ''; ?>" valor="<?php echo ( substr_count($tarjeta,$i.'+')>=1) ? 's': 'n'; ?>" posicion="<?php echo $i; ?>" numero="<?php echo $misdatos[$i-1]; ?>" cara="<?php echo $cara[$i-1]; ?>" > 
                          
                          <div class="front" style="padding-bottom: 20px;"> 
                            <?php 
                                $imagen = ( substr_count($tarjeta,$i.'+')>=1) ? 'card'.$cara[$i-1].'.jpg' : 'cara.jpg';
                            ?>
                                <img  src="<?php echo base_url()?>img/fichas/<?php echo $imagen; ?>">
                                <?php echo $misdatos[$i-1]; ?>
                          </div> 
                          <div class="back" style="padding-bottom: 20px; display: <?php echo ( substr_count($tarjeta,$i.'+')>=1) ? 'none': ''; ?>;">
                                
                                <img src="<?php echo base_url().'img/fichas/card'.$cara[$i-1].'.jpg'; ?>">
                                <?php echo $misdatos[$i-1]; ?>
                               
                          </div> 
                    </div>      
                </div>
            <?php } ?>

    </div> 
</div>

</div>
<script>

//https://nnattawat.github.io/flip/
    jQuery(document).ready(function($) {

         

        jQuery('body').on('click','.card[valor="n"]', function (e) {               
          jQuery(this).attr('valor','s');
          jQuery(this).off('.flip'); //no flipear
          jQuery.ajax({ //guardar en la cookie el conteo
                    url : '/respuesta_tarjeta',
                    data : { 
                           posicion: $(this).attr('posicion'),
                        numero: $(this).attr('numero'),
                        cara: $(this).attr('cara'),
                        //cara: $('span.r1').html(), //'0:09', //$(this).attr('resp'),
                    },
                    type : 'POST',
                    dataType : 'json',
                    success : function(data) {  
                        //localStorage.setItem('fondo',  'nada' );
                        //localStorage.setItem('tiempo_fondo', '00:00:00');
                       

                        localStorage.clear();
                        
                          if   (data.redireccion!='no')
                            window.location.href = '/'+data.redireccion;        
                          
                          return false;

                    }

            }); 


        });

        jQuery(".card[valor='n']").flip(); 
        //jQuery(".card[valor='s']").off('.flip'); 

    });
</script>

<?php $this->load->view( 'footer' ); ?>