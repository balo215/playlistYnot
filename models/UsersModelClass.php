<?php
    class users {
        
    //Atributos
        public $nombre;
        public $apellido;
        public $correo;
        public $pass;
        function crear( $nombre, $apellido, $correo, $pass ) {
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->correo = $correo;
            $this->pass = $pass;
        }
}
?>
