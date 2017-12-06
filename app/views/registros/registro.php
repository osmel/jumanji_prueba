<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'header' ); ?>
<?php $this->load->view( 'navbar' ); 

redirect('/ingresar_usuario', 'refresh');
?>
 

 

<?php echo form_close(); ?>
<?php $this->load->view('footer'); ?>