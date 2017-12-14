<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'header' ); ?>
<?php $this->load->view( 'navbar' ); ?>

<?php 
	//print_r((trim($jefe->tarjeta)));
	//die;
?>

<div class="container intro">

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h2 class="text-center">@<?php echo $jefe->equipo?></h2>
		</div>
	</div>

	<div class="">								
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1 col-xs-12 mimarcador">
			<?php 	
			$suma_invitado =0;
			$suma_jefe =0;
			//$suma_jefe =0;

			if (($jefe)) {
				$matriz = explode( ";",substr(trim($jefe->tarjeta), 0, -1));
				
				if ($jefe->tarjeta!='')
				foreach ($matriz as $key => $value) { //3+c-0*5|00:00:01;1+a-1*12|00:00:10;2+c-0*8|00:00:0...
					$ma1=explode( "+",$value);   //Array ( [0] => 3 [1] => c-0*5|00:00:01 )  -->fig 1,2,3,4,5
					$ma2=explode( "|",$ma1[1]);   //Array ( [0] => c [1] => 0*5|00:00:01 )   --> resp a, b o c

					$suma_jefe = $suma_jefe + (int)$this->session->userdata('ip'.$ma2[1]);
				} 

				$matriz = explode( ";",substr(trim($jefe->tarjeta2), 0, -1));
				
				if ($jefe->tarjeta2!='')
				foreach ($matriz as $key => $value) { //3+c-0*5|00:00:01;1+a-1*12|00:00:10;2+c-0*8|00:00:0...
					$ma1=explode( "+",$value);   //Array ( [0] => 3 [1] => c-0*5|00:00:01 )  -->fig 1,2,3,4,5
					$ma2=explode( "|",$ma1[1]);   //Array ( [0] => c [1] => 0*5|00:00:01 )   --> resp a, b o c

					$suma_jefe = $suma_jefe + (int)$this->session->userdata('ip'.$ma2[1]);
				} 



			}
				
			if (($invitado)) {
			
				$matriz = explode( ";",substr(trim($invitado->tarjeta), 0, -1));
				
				if ($invitado->tarjeta!='')
				foreach ($matriz as $key => $value) { //3+c-0*5|00:00:01;1+a-1*12|00:00:10;2+c-0*8|00:00:0...
					$ma1=explode( "+",$value);   //Array ( [0] => 3 [1] => c-0*5|00:00:01 )  -->fig 1,2,3,4,5
					$ma2=explode( "|",$ma1[1]);   //Array ( [0] => c [1] => 0*5|00:00:01 )   --> resp a, b o c

					$suma_invitado = $suma_invitado + (int)$this->session->userdata('ip'.$ma2[1]);
				} 

				$matriz = explode( ";",substr(trim($invitado->tarjeta2), 0, -1));
				
				if ($invitado->tarjeta2!='')
				foreach ($matriz as $key => $value) { //3+c-0*5|00:00:01;1+a-1*12|00:00:10;2+c-0*8|00:00:0...
					$ma1=explode( "+",$value);   //Array ( [0] => 3 [1] => c-0*5|00:00:01 )  -->fig 1,2,3,4,5
					$ma2=explode( "|",$ma1[1]);   //Array ( [0] => c [1] => 0*5|00:00:01 )   --> resp a, b o c

					$suma_invitado = $suma_invitado + (int)$this->session->userdata('ip'.$ma2[1]);
				} 

			}
		
			//echo $suma_jefe;
			echo '<div class="col-md-8"><span class="textosmarcador text-center">PUNTOS JUGADOR 1: </span><span class="textosmarcador2 text-center">'.$jefe->nombre.' '.$jefe->Apellidos.'</span></div><div class="col-md-4"><span class="marcadorconte">'.$suma_jefe.'</span></div>';
			echo '<div class="col-md-8"><span class="textosmarcador text-center">PUNTOS JUGADOR 2: </span><span class="textosmarcador2 text-center">'.(($invitado) ? $invitado->nombre.' '.$invitado->Apellidos : "Aún no se registra").'</span></div><div class="col-md-4"><span class="marcadorconte">'.$suma_invitado.'</span></div>';

			echo '<div class="col-md-8"><span class="textosmarcador">PUNTOS TOTALES:</span></div><div class="col-md-4"><span class="marcadorconte">'.($suma_jefe+$suma_invitado).'</span></div>';


			

			?>
			
		</div>
	</div>	

</div>


<?php $this->load->view( 'footer' ); ?>
