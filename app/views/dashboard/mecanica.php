<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'header' ); ?>
<?php $this->load->view( 'navbar' ); ?>


 <!-- contenido-->
<div class="container mecanica">
	<div class="">
		
		<!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h2 class="text-center">Como participar</h2>
		</div> -->
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center">
			
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center mecans1">
			<!-- <img src="<?php echo base_url()?>img/meca1.png" class="img-responsive img-center">
			<img src="<?php echo base_url()?>img/meca7.png" class="img-responsive img-center">
			<img src="<?php echo base_url()?>img/meca3.png" class="img-responsive img-center">
			<img src="<?php echo base_url()?>img/meca4.png" class="img-responsive img-center"> -->
		</div>
		<!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
			<img src="<?php echo base_url().$this->session->userdata('c24'); ?>" class="img-responsive img-center">
		</div>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
			<img src="<?php echo base_url().$this->session->userdata('c25'); ?>" class="img-responsive img-center">
		</div> -->
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center containersinb">
			<img src="<?php echo base_url()?>img/1.png" style="margin: 0px auto;margin-top:50px" class="img-responsive sinizquierdo">
		</div>	
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center containersinb">
			<img src="<?php echo base_url()?>img/2.png" style="margin: 0px auto;" class="img-responsive sinizquierdo">
		</div>	
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center containersinb">
			<img src="<?php echo base_url()?>img/3.png" style="margin: 0px auto;margin-top:50px" class="img-responsive sinizquierdo">
		</div>
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 text-center">
		</div>	
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 text-center containersinb">
			<img src="<?php echo base_url()?>img/centromecanica.png" style="margin: 0px auto;margin-top:40px" class="img-responsive sinizquierdo">
		</div>
	</div>
</div>



<?php $this->load->view( 'footer' ); ?>