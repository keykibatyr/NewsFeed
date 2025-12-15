<?php
    class MysqlConfig{
        public string $host;
        public string $port;
        public string $user;
        public string $password;
        public string $database;


        public function __construct ( //default config
            string $host,
            string $user,
            string $password,
            string $database
        ){
            $this -> host = $host;
            $this -> user = $user;
            $this -> password = $password;
            $this -> database = $database;
        }

        public function toString(): string {
            return 'mysql:host=' . 
            $this -> host + ';dbname=' . 
            $this -> database . ';charset=utf8mb4';
        }
    }

    function OpenPDO(MysqlConfig $mcf): PDO {   
        $conf1 = $mcf -> toString();
        $conf2 = $mcf -> user;
        $conf3 = $mcf -> password;
        $newPDO = new PDO($conf1, $conf2, $conf3);
        return $newPDO;
    }
?>