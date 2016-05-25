<?php
    class listClass {
        
        public $nombre;
        public $is_user;
        public $canciones;
        function create($nombre, $id_user, $canciones) {
            $this->nombre = $nombre;
            $this->id_user = $id_user;
            $this->canciones = $canciones;
        }
    }
?>
