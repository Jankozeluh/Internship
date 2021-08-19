<?php
    class databaseConnection {
        private static $instance = null;
        private $conn;

        private function __construct(){
            $this->conn = new SQLite3('oopP.sqlite');
        }

        public static function getInstance(){
            if(!self::$instance)
            {
                self::$instance = new databaseConnection();
            }
            return self::$instance;
        }

        public function getConnection(){
            return $this->conn;
        }
    }

