<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');

	class registros extends CI_Model{
		
		private $key_hash;
		private $timezone;

		function __construct(){
			parent::__construct();
			$this->load->database("default");
			$this->key_hash    = $_SERVER['HASH_ENCRYPT'];
			$this->timezone    = 'UM1';

				//usuarios
		      $this->usuarios             = $this->db->dbprefix('usuarios');
          $this->perfiles             = $this->db->dbprefix('perfiles');

          $this->configuraciones      = $this->db->dbprefix('catalogo_configuraciones');
          
          $this->proveedores          = $this->db->dbprefix('catalogo_empresas');
          $this->historico_acceso     = $this->db->dbprefix('historico_acceso');

          $this->catalogo_estados      = $this->db->dbprefix('catalogo_estados');
          $this->catalogo_litraje      = $this->db->dbprefix('catalogo_litraje');

          $this->participantes      = $this->db->dbprefix('participantes');
          $this->bitacora_participante     = $this->db->dbprefix('bitacora_participante');
          $this->catalogo_imagenes         = $this->db->dbprefix('catalogo_imagenes');
          
          $this->registro_participantes         = $this->db->dbprefix('registro_participantes');

          $this->catalogo_preguntas         = $this->db->dbprefix('catalogo_preguntas');
          

		}


        public function agregar_datos($data){

             //$this->db->set( 'cara', "AES_ENCRYPT('{$data['juego']}','{$this->key_hash}')", FALSE );
             $this->db->set( 'cara', "AES_ENCRYPT('{$data['cara']}','{$this->key_hash}')", FALSE );
             $this->db->set( 'misdatos', "AES_ENCRYPT('{$data['misdatos']}','{$this->key_hash}')", FALSE );
             
            
             $this->db->where("id", '"'.$this->session->userdata('id_participante').'"',false);  
            
             $this->db->update($this->participantes );
  
              if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();

        }


        public function get_datos(){
            
            $this->db->select("AES_DECRYPT(cara,'{$this->key_hash}') AS cara", FALSE);      
            $this->db->select("AES_DECRYPT(misdatos,'{$this->key_hash}') AS misdatos", FALSE);      
            $this->db->select("AES_DECRYPT(tarjeta,'{$this->key_hash}') AS tarjeta", FALSE);      
            $this->db->select("AES_DECRYPT(tiempo_juego,'{$this->key_hash}') AS tiempo_juego", FALSE);      

            $this->db->from($this->participantes);
            $this->db->where("id", '"'.$this->session->userdata('id_participante').'"',false);  
            $preg = $this->db->get();
            if ($preg->num_rows() > 0)
              return $preg->row();
            else
              return TRUE;
            $login->free_result();
        }



    //Recuperar contraseña  del participante
      public function recuperar_invitado($data){
         $this->db->select("p.id");           
        $this->db->from($this->participantes.' as p');
        $this->db->where('p.email_invitado',"AES_ENCRYPT('{$data['email_invitado']}','{$this->key_hash}')",FALSE);
        $login = $this->db->get();
        if ($login->num_rows() > 0)
          return $login->row();
        else 
          return FALSE;
        $login->free_result();    
      } 



        //agregar participante
        public function actualizar_facebook( $data ){
            $timestamp = time();

            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );  //fecha cdo se registro
            $this->db->set( 'redes', "AES_ENCRYPT('{$data['redes']}','{$this->key_hash}')", FALSE );
            $this->db->where("id", '"'.$this->session->userdata('id_participante').'"',false);  
            $this->db->update($this->participantes );

            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
        }        



        public function listado_preguntas(){
            $this->db->select( 'id, pregunta, a, b,c, respuesta' );
            $preguntas = $this->db->get($this->catalogo_preguntas );
            if ($preguntas->num_rows() > 0 )
                 

               return $preguntas->result();
            else
               return FALSE;
            $estados->free_result();
        }   



        public function get_preguntas($id){
            $this->db->select( 'id, pregunta, a, b,c, respuesta' );
            $this->db->from($this->catalogo_preguntas);
            $this->db->where('id', $id); //
            $preg = $this->db->get();
            if ($preg->num_rows() > 0)
              return $preg->row();
            else
              return TRUE;
            $login->free_result();
        }

    //agregar participante
    public function anadir_registro( $data ){
            $timestamp = time();

            
            $this->db->set( 'total', "AES_ENCRYPT(0,'{$this->key_hash}')", FALSE );  //total comienza en 0
            $this->db->set( 'tarjeta', "AES_ENCRYPT('','{$this->key_hash}')", FALSE );  //total comienza en 0
            $this->db->set( 'juego', "AES_ENCRYPT('','{$this->key_hash}')", FALSE );  //total comienza en 0

            $this->db->set( 'id_perfil', $data['id_perfil']);  //4 jefe participante
            $this->db->set( 'creacion',  gmt_to_local( $timestamp, $this->timezone, TRUE) );
            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );  //fecha cdo se registro
            $this->db->set( 'id', "UUID()", FALSE); //id

            $this->db->set( 'nombre', "AES_ENCRYPT('{$data['nombre']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'apellidos', "AES_ENCRYPT('{$data['apellidos']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'fecha_nac', strtotime(date( "d-m-Y", strtotime($data['fecha_nac']) )) ,false);


            //$this->db->set( 'id_estado', $data['id_estado']);
	          $this->db->set( 'ciudad', "AES_ENCRYPT('{$data['ciudad']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'celular', "AES_ENCRYPT('{$data['celular']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'email', "AES_ENCRYPT('{$data['email']}','{$this->key_hash}')", FALSE );

            $this->db->set( 'equipo', "AES_ENCRYPT('{$data['equipo']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'email_invitado', "AES_ENCRYPT('{$data['email_invitado']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE );

            $this->db->insert($this->participantes );

            if ($this->db->affected_rows() > 0){
                  return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
            
        }


   //agregar participante
    public function anadir_invitado( $data ){
            $timestamp = time();

            
            $this->db->set( 'total', "AES_ENCRYPT(0,'{$this->key_hash}')", FALSE );  //total comienza en 0
            $this->db->set( 'tarjeta', "AES_ENCRYPT('','{$this->key_hash}')", FALSE );  //total comienza en 0
            $this->db->set( 'juego', "AES_ENCRYPT('','{$this->key_hash}')", FALSE );  //total comienza en 0

            $this->db->set( 'id_perfil', $data['id_perfil']); //4 invitado
            $this->db->set( 'creacion',  gmt_to_local( $timestamp, $this->timezone, TRUE) );
            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );  //fecha cdo se registro
            $this->db->set( 'id', "UUID()", FALSE); //id

            $this->db->set( 'nombre', "AES_ENCRYPT('{$data['nombre']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'apellidos', "AES_ENCRYPT('{$data['apellidos']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'fecha_nac', strtotime(date( "d-m-Y", strtotime($data['fecha_nac']) )) ,false);


            //$this->db->set( 'id_estado', $data['id_estado']);
            $this->db->set( 'ciudad', "AES_ENCRYPT('{$data['ciudad']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'celular', "AES_ENCRYPT('{$data['celular']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'email', "AES_ENCRYPT('{$data['email']}','{$this->key_hash}')", FALSE );

            $this->db->set( 'equipo', "AES_ENCRYPT('{$data['equipo']}','{$this->key_hash}')", FALSE );
            
            $this->db->set( 'contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE );

            $this->db->set( 'id_jefe', $this->db->escape($data['id']) , FALSE );  //id del jefe participante

            $this->db->insert($this->participantes );

            if ($this->db->affected_rows() > 0){
                  return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
            
        }


     //checar el login del participante
        public function check_login($data){
          $this->db->select("id", FALSE);           
          $this->db->select("AES_DECRYPT(p.email,'{$this->key_hash}') AS email", FALSE);      
          $this->db->select("AES_DECRYPT(p.nombre,'{$this->key_hash}') AS nombre", FALSE);      
          $this->db->select("AES_DECRYPT(p.apellidos,'{$this->key_hash}') AS apellidos", FALSE);      
          $this->db->select("AES_DECRYPT(p.celular,'{$this->key_hash}') AS celular", FALSE);      
          $this->db->select("AES_DECRYPT(p.contrasena,'{$this->key_hash}') AS contrasena", FALSE);

          $this->db->select("AES_DECRYPT(p.tarjeta,'{$this->key_hash}') AS tarjeta", FALSE);
          $this->db->select("AES_DECRYPT(p.juego,'{$this->key_hash}') AS juego", FALSE);

          $this->db->select("AES_DECRYPT(p.email_invitado,'{$this->key_hash}') AS email_invitado", FALSE);      
          $this->db->select("AES_DECRYPT(p.equipo,'{$this->key_hash}') AS equipo", FALSE);      

          $this->db->from($this->participantes.' as p');
            
          $this->db->where('p.email', "AES_ENCRYPT('{$data['email']}','{$this->key_hash}')", FALSE); 
          $this->db->where('p.contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE);
          $login = $this->db->get();

          if ($login->num_rows() > 0)
            return $login->result();
          else 
            return FALSE;
          $login->free_result();
        }        


        public function datos_jefe_equipo($id){

         // $id = $this->db->escape($id);

             $this->db->select("id", FALSE);           
          $this->db->select("AES_DECRYPT(p.email,'{$this->key_hash}') AS email", FALSE);      
          $this->db->select("AES_DECRYPT(p.nombre,'{$this->key_hash}') AS nombre", FALSE);      
          $this->db->select("AES_DECRYPT(p.apellidos,'{$this->key_hash}') AS apellidos", FALSE);      
          $this->db->select("AES_DECRYPT(p.celular,'{$this->key_hash}') AS celular", FALSE);      
          $this->db->select("AES_DECRYPT(p.contrasena,'{$this->key_hash}') AS contrasena", FALSE);

          $this->db->select("AES_DECRYPT(p.tarjeta,'{$this->key_hash}') AS tarjeta", FALSE);
          $this->db->select("AES_DECRYPT(p.juego,'{$this->key_hash}') AS juego", FALSE);

          $this->db->select("AES_DECRYPT(p.email_invitado,'{$this->key_hash}') AS email_invitado", FALSE);      
          $this->db->select("AES_DECRYPT(p.equipo,'{$this->key_hash}') AS equipo", FALSE);      

          $this->db->from($this->participantes.' as p');
            
            $this->db->where('p.id', $this->db->escape($id), false); 
          //$this->db->where('p.email', "AES_ENCRYPT('{$data['email']}','{$this->key_hash}')", FALSE); 
          //$this->db->where('p.contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE);
          $login = $this->db->get();

          if ($login->num_rows() > 0)
            return $login->row();
          else 
            return FALSE;
          $login->free_result();
        }   

      //agregar a la bitacora de participante sus accesos  
       public function anadir_historico_acceso($data){
            $timestamp = time();
            $ip_address = $this->input->ip_address();
            $user_agent= $this->input->user_agent();

            $this->db->set( 'id_usuario', $data->id); // luego esta se compara con la tabla participante
            $this->db->set( 'email', "AES_ENCRYPT('{$data->email}','{$this->key_hash}')", FALSE );
            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );  //fecha cdo se registro
            $this->db->set( 'ip_address',  $ip_address, TRUE );
            $this->db->set( 'user_agent',  $user_agent, TRUE );
            $this->db->insert($this->bitacora_participante );
            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();

        }

/*
select 
  AES_DECRYPT( email,'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS email,
  AES_DECRYPT( tarjeta,'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS tarjeta
from 
  calimax_participantes
  */

        public function actualizar_respuesta_tarjeta($data){

            $this->db->select("AES_DECRYPT(tarjeta,'{$this->key_hash}') AS tarjeta", FALSE);      
            $this->db->from($this->participantes);
            $this->db->where("id", '"'.$this->session->userdata('id_participante').'"',false);  
            $preg = $this->db->get();
              //return $preg->row();


            $data["formato"] =trim($preg->row()->tarjeta).trim($data["formato"]);
            $this->db->set( 'tarjeta', "AES_ENCRYPT(' {$data["formato"]}  ','{$this->key_hash}')", FALSE );
            $this->db->set( 'tiempo_juego', "AES_ENCRYPT('{$data['tiempo']}','{$this->key_hash}')", FALSE );  
            $this->db->where("id", '"'.$this->session->userdata('id_participante').'"',false);  
            
             $this->db->update($this->participantes );
  
              if ($this->db->affected_rows() > 0){
                    return json_encode($data["formato"]);
                } else {
                    return FALSE;
                }
                $result->free_result();

        }

        public function actualizar_tiempo($data){

            $this->db->set( 'tiempo_juego', "AES_ENCRYPT('{$data['tiempo']}','{$this->key_hash}')", FALSE );  
            $this->db->where("id", '"'.$this->session->userdata('id_participante').'"',false);  
            
             $this->db->update($this->participantes );
  
              if ($this->db->affected_rows() > 0){
                    return true;
                } else {
                    return FALSE;
                }
                $result->free_result();

        }


////////////////////////////////////////////////////////////////////////////////////
/////////////////////////juegos/////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
        public function listado_imagenes(){

            $this->db->select('c.id, c.nombre, c.valor, c.activo, c.puntos, c.porciento');
            $this->db->from($this->catalogo_imagenes.' as c');
            $this->db->where('c.activo',0);
            $result = $this->db->get();
            
            if ( $result->num_rows() > 0 )
               return $result->result();
            else
               return False;
            $result->free_result();
        }     



        public function actualizar_respuesta_juego($data){

             $this->db->set( 'juego', "AES_ENCRYPT('{$data['juego']}','{$this->key_hash}')", FALSE );
             $this->db->set( 'tiempo_juego', "AES_ENCRYPT('{$data['tiempo']}','{$this->key_hash}')", FALSE );
             $this->db->set( 'puntos', "AES_ENCRYPT('{$data['total_puntos']}','{$this->key_hash}')", FALSE );
             $this->db->set( 'redes', $data['redes'] );
            
             $this->db->where("id", '"'.$this->session->userdata('id_participante').'"',false);  
            
             $this->db->update($this->participantes );
  
              if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();

        }

////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////


      public function record_personal($data){

          $this->db->select("AES_DECRYPT(nombre, '{$this->key_hash}') AS nombre", FALSE);
          $this->db->select("AES_DECRYPT(Apellidos, '{$this->key_hash}') AS Apellidos", FALSE);
          $this->db->select("AES_DECRYPT(juego, '{$this->key_hash}') AS juego", FALSE);
          $this->db->select("AES_DECRYPT(tiempo_juego, '{$this->key_hash}') AS tiempo_juego", FALSE);
          $this->db->select("AES_DECRYPT(tarjeta, '{$this->key_hash}') AS tarjeta", FALSE);
          $this->db->select("AES_DECRYPT(email, '{$this->key_hash}') AS email", FALSE);
          $this->db->select("AES_DECRYPT(contrasena, '{$this->key_hash}') AS contrasena", FALSE);
          $this->db->select("AES_DECRYPT(puntos, '{$this->key_hash}') AS puntos", FALSE);
          $this->db->select("AES_DECRYPT(email_invitado, '{$this->key_hash}') AS email_invitado", FALSE);
          $this->db->select("redes,id_jefe");


          $this->db->from($this->participantes.' as p');
          $where = "( (p.id='".$data['id_participante']."') ) ";      
          $this->db->where($where);
          $this->db->group_by("p.id");

            $result = $this->db->get();
            
            if ( $result->num_rows() > 0 )
               return $result->row();
            else
               return False;
            $result->free_result();


      }  


public function record_invitado($data){

          $this->db->select("AES_DECRYPT(nombre, '{$this->key_hash}') AS nombre", FALSE);
          $this->db->select("AES_DECRYPT(Apellidos, '{$this->key_hash}') AS Apellidos", FALSE);
          $this->db->select("AES_DECRYPT(juego, '{$this->key_hash}') AS juego", FALSE);
          $this->db->select("AES_DECRYPT(tiempo_juego, '{$this->key_hash}') AS tiempo_juego", FALSE);
          $this->db->select("AES_DECRYPT(tarjeta, '{$this->key_hash}') AS tarjeta", FALSE);
          $this->db->select("AES_DECRYPT(email, '{$this->key_hash}') AS email", FALSE);
          $this->db->select("AES_DECRYPT(contrasena, '{$this->key_hash}') AS contrasena", FALSE);
          $this->db->select("AES_DECRYPT(puntos, '{$this->key_hash}') AS puntos", FALSE);
          $this->db->select("AES_DECRYPT(email_invitado, '{$this->key_hash}') AS email_invitado", FALSE);
          $this->db->select("redes,id_jefe");


          $this->db->from($this->participantes.' as p');
          $this->db->where('email',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);
          $this->db->group_by("p.id");

            $result = $this->db->get();
            
            if ( $result->num_rows() > 0 )
               return $result->row();
            else
               return False;
            $result->free_result();


      }  




////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////





/*

INSERT INTO calimax_participantes (`tarjeta`, `juego`)  
values (
AES_ENCRYPT('pana','gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5'), 
AES_ENCRYPT('osmel','gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5')
    )


SELECT
 AES_DECRYPT(nombre, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS nombre,
AES_DECRYPT(Apellidos, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS Apellidos,
AES_DECRYPT(juego, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS juego,
AES_DECRYPT(tiempo_juego, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS tiempo_juego,
AES_DECRYPT(tarjeta, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS tarjeta,
AES_DECRYPT(email, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS email,
AES_DECRYPT(contrasena, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS contrasena,

AES_DECRYPT(puntos, 'gtg5igLZasUC3xNfDlvTGBxxkoMuR6FaCYw5') AS puntos,
redes

   FROM calimax_participantes

*/


       public function record_general(){

          $largo = 20;
          $inicio =0; 
          $this->db->select("CONVERT(AES_DECRYPT(p.total,'{$this->key_hash}'),decimal) AS total", FALSE);
          $this->db->select("AES_DECRYPT(p.nick,'{$this->key_hash}') AS nick", FALSE);      
          $this->db->from($this->participantes.' as p');
          $this->db->order_by("total", "DESC");

          $this->db->limit($largo,$inicio); 

            $result = $this->db->get();
            
            if ( $result->num_rows() > 0 )
               return $result->result();
            else
               return False;
            $result->free_result();


      }  




        //agregar participante
        public function actualizar_tickets( $data ){
            $timestamp = time();

            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );  //fecha cdo se registro
            
            $id_participante         = $this->session->userdata('id_participante');
            $num_ticket_participante = $this->session->userdata('num_ticket_participante');
            

            $this->db->set( 'redes', 1, FALSE );
            $this->db->where('id_participante', $id_participante);  
            $this->db->where("AES_DECRYPT(ticket,'{$this->key_hash}')", '"'.$num_ticket_participante.'"',false);  
            $this->db->update($this->registro_participantes );


            if ($this->db->affected_rows() > 0){
                    self::registro_total_tickets2($data);
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
            
        }  


        public function registro_total_tickets2( $data ){


            $id_participante = $this->session->userdata('id_participante');

            
            
            $this->db->set( 'total', "AES_ENCRYPT( (CASE WHEN ( ISNULL (CONVERT(AES_DECRYPT(total,'{$this->key_hash}') , decimal) ) =1 )  THEN 0 else (CONVERT(AES_DECRYPT(total,'{$this->key_hash}') , decimal) ) END ) +".$data['total']." , '{$this->key_hash}')", false);


              $this->db->where('id', $id_participante);   
            $this->db->update($this->participantes );
            

        }           






        public function registro_total_tickets( $data ){


            $id_participante = $this->session->userdata('id_participante');

            
            
            $this->db->set( 'total', "AES_ENCRYPT( (CASE WHEN ( ISNULL (CONVERT(AES_DECRYPT(total,'{$this->key_hash}') , decimal) ) =1 )  THEN 0 else (CONVERT(AES_DECRYPT(total,'{$this->key_hash}') , decimal) ) END ) +".$data['total']." , '{$this->key_hash}')", false);


              $this->db->where('id', $id_participante);   
            //$this->db->where('id', '"'.$id_participante.'"',false); // id del usuario que se registro

            $this->db->update($this->participantes );
            

        }    

      

        



        //checar si el tickets ya fue registrado
        public function check_tickets_existente($data){
            $this->db->from($this->registro_participantes);
            $this->db->where('ticket',"AES_ENCRYPT('{$data['ticket']}','{$this->key_hash}')",FALSE);
            $login = $this->db->get();
            if ($login->num_rows() > 0)
                return FALSE;
            else
                return TRUE;
            $login->free_result();
        }







 //----------------**************catalogos-------------------************------------------
        public function listado_estados(){
            $this->db->select( 'id, nombre' );
            $estados = $this->db->get($this->catalogo_estados );
            if ($estados->num_rows() > 0 )
            	 return $estados->result();
            else
            	 return FALSE;
            $estados->free_result();
        }	  
       
     

        public function listado_litraje(){
            $this->db->select( 'id, nombre' );
            $estados = $this->db->get($this->catalogo_litraje );
            if ($estados->num_rows() > 0 )
                 return $estados->result();
            else
                 return FALSE;
            $estados->free_result();
        }     
       


        //checar si el correo ya fue registrado
		public function check_correo_existente($data){
			$this->db->select("AES_DECRYPT(email,'{$this->key_hash}') AS email", FALSE);			
			$this->db->from($this->participantes);

			$this->db->where('email',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);
      $this->db->or_where('email',"AES_ENCRYPT('{$data['email_invitado']}','{$this->key_hash}')",FALSE);
      $this->db->or_where('email_invitado',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);
      $this->db->or_where('email_invitado',"AES_ENCRYPT('{$data['email_invitado']}','{$this->key_hash}')",FALSE);
			$login = $this->db->get();
			if ($login->num_rows() > 0)
				return FALSE;
			else
				return TRUE;
			$login->free_result();
		}


		//Recuperar contraseña	del participante
	    public function recuperar_contrasena($data){
	    	$this->db->select("id", FALSE);						
			$this->db->select("AES_DECRYPT(p.email,'{$this->key_hash}') AS email", FALSE);						
			$this->db->select("AES_DECRYPT(p.nombre,'{$this->key_hash}') AS nombre", FALSE);			
			$this->db->select("AES_DECRYPT(p.apellidos,'{$this->key_hash}') AS apellidos", FALSE);			
                        //      $this->db->select("AES_DECRYPT(p.nick,'{$this->key_hash}') AS nick", FALSE);      
			//$this->db->select("AES_DECRYPT(p.telefono,'{$this->key_hash}') AS telefono", FALSE);			
			$this->db->select("AES_DECRYPT(p.contrasena,'{$this->key_hash}') AS contrasena", FALSE);
			$this->db->from($this->participantes.' as p');
			$this->db->where('p.email',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);
			$login = $this->db->get();
			if ($login->num_rows() > 0)
				return $login->result();
			else 
				return FALSE;
			$login->free_result();		
	    }	




		//checar el login del participante
		public function check_loginconemail($data){
			$this->db->select("id", FALSE);						
			$this->db->select("AES_DECRYPT(p.email,'{$this->key_hash}') AS email", FALSE);			
			$this->db->select("AES_DECRYPT(p.nombre,'{$this->key_hash}') AS nombre", FALSE);			
			$this->db->select("AES_DECRYPT(p.apellidos,'{$this->key_hash}') AS apellidos", FALSE);			
      $this->db->select("AES_DECRYPT(p.nick,'{$this->key_hash}') AS nick", FALSE);      
			$this->db->select("AES_DECRYPT(p.telefono,'{$this->key_hash}') AS telefono", FALSE);			
			$this->db->select("AES_DECRYPT(p.contrasena,'{$this->key_hash}') AS contrasena", FALSE);

      $this->db->select("p.premiado,p.id_premio");
			
			$this->db->from($this->participantes.' as p');
			
			$this->db->where('p.contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE);
			$this->db->where('p.email',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);

			$login = $this->db->get();

			if ($login->num_rows() > 0)
				return $login->result();
			else 
				return FALSE;
			$login->free_result();
		}

   
    

















	} 
?>
