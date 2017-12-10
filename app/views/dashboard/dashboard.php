<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'header' ); ?>
<?php $this->load->view( 'navbar' ); ?>
<style>
.logoderecha{
	display: none;
}


</style>
 <?php 
	 if ($this->session->userdata('session_participante') == true) { 
      	$retorno ="registro_ticket";
    } else {
        $retorno ="registro_usuario";
    }


 $attr = array('class' => 'form-horizontal', 'id'=>'form_registrar_ticket','name'=>$retorno,'method'=>'POST','autocomplete'=>'off','role'=>'form');
 echo form_open('/validar_registrar_ticket', $attr);
?>	

		
			<div class="container home">		
				<div class="col-sm-12 col-md-12">		
					<div class="col-sm-4 col-md-4">
						
					</div>

					<div class="col-sm-4 col-sm-4 col-md-4">
						<img src="<?php echo base_url()?>img/logo4.png" class="alto1">
					</div>
			    
					<div class="col-sm-12 col-md-12">
			      		<img src="<?php echo base_url()?>img/sanfa.png">
					</div>

			    	<div class="col-sm-3 col-md-3">
			    	</div>

			    	<div class="col-sm-6 col-md-6" style="margin-bottom: 25px;margin-top: 25px;">
			            <video width="100%" height="280" controls>
			            <source src="<?php echo base_url()?>img/video.mp4" type="video/mp4">
			            Your browser does not support the video tag.
			            </video>
				    </div>

				    <div class="col-sm-3 col-md-3">
				    </div>

				    <div class="col-sm-12 col-md-12">
				      <img src="<?php echo base_url()?>img/fecha.png"  class="alto2">
				    </div>

				    <div class="col-sm-4 col-md-4">
				    </div>

				    <div class="col-sm-4 col-md-4">
				      <img src="<?php echo base_url()?>img/prox.png">
				    </div>

				    <div class="col-sm-4 col-md-4">
				    </div>

				</div>
















				
			</div>				  
		


<?php echo form_close(); ?>




<?php $this->load->view( 'footer' ); ?>



<div class="modal fade bs-example-modal-lg" id="modalMessage"  ventana="redi_ticket" valor="<?php echo $retorno; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>



<script type="text/javascript">
ya=0;
function tickets(){
$(".slider").slick({
        dots: false,
        infinite: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        arrows: true,
        autoplay: true,
  		autoplaySpeed: 5500,
        responsive: [
        	{
        		breakpoint:768,
        		settings: {
        			dots: false,
			        infinite: false,
			        slidesToShow: 2,
			        slidesToScroll: 1,
			        arrows: true,
			        autoplay: true,
  					autoplaySpeed: 5500,
        		}
        	},
        	{
        		breakpoint:481,
        		settings: {
        			dots: false,
			        infinite: false,
			        slidesToShow: 1,
			        slidesToScroll: 1,
			        arrows: true,
			        autoplay: true,
  					autoplaySpeed: 5500,
        		}
        	},
        	{
        		breakpoint:361,
        		settings: {
        			dots: false,
			        infinite: false,
			        slidesToShow: 1,
			        slidesToScroll: 1,
			        arrows: true,
			        autoplay: true,
  					autoplaySpeed: 5500,
        		}
        	}
        ]
      });
ya=1;
}
function cerrar(){	
	$('.ventana-ejemplos').animate({'opacity':0}, 1000, function(){
		$('.ventana-ejemplos').css({'z-index':'-100'});
	});
}
function abrir() {
	$('.ventana-ejemplos').css({'z-index':'1000'});
	$('.ventana-ejemplos').animate({'opacity':1}, 1000, function(){
		if (ya == 0) {
			tickets();
		};		
	});
}

$('a.ver-ticket').click(function() {
	abrir();
});

$('.ventana-ejemplos .close').click(function() {
	cerrar();
});

$(document).ready(function() {
	tickets();
});

</script>