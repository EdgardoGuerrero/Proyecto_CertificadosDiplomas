<?php
    /* Inicializando la sesión del usuario */
    session_start();
    /* Iniciamos Clase Conectar */
    class Conectar{
        protected $dbh;

        /* Función Protegia de la cadena de Conexión */
        protected function Conexion(){
            try{
                /* Cadena de conexión */
                $conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=diplomas","root","");
                return $conectar;
            } catch (Exception $e){
                /* En caso hubiera un error en la cadena de conexión */
                print "¡Error BD!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        /* Para impedir que tengamos problemas con las ñ o tildes */
        public function set_names(){
            return $this->dbh->query("SET NAMES 'utf8'");
        }

        /* Ruta principal del proyecto */
        public static function ruta(){
            return "http://localhost/Proyecto_CertificadosDiplomas/";
        }
    } 
?>