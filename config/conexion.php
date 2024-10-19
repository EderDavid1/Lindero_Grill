<?php


    session_start();

    
    class Conectar {
        protected $dbh;
    
        protected function conexion() {
            try {
                $conectar = $this->dbh = new PDO("pgsql:host=localhost;dbname=db_lindero_grill", "postgres", "123456789");
                $conectar->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conectar->exec("SET NAMES 'utf8'");
                return $conectar;
            } catch (Exception $e) {
                print "Error BD!: " . $e->getMessage() . "<br/>";
                die();
            }
        }
    
        public function set_names() {
            return $this->dbh->query("SET NAMES 'utf8'");
        }
    
        public static function ruta() {
            return "http://localhost/LinderoGrill/";
        }
    }
    
?>