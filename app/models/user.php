<?php
    class User {
        private int $ID;
        private string $Nick;
        private string $Email;
        private string $PasswordHash;
        private string $Role;

        public function __construct(
            int $ID, 
            string $Nick,
            string $Email,
            string $PasswordHash,
            string $Role)
        {
            $this -> ID = $ID;
            $this -> Nick = $Nick;
            $this -> Email = $Email;
            $this -> PasswordHash = $PasswordHash;
            $this -> Role = $Role;
        }

        public function getID(): int{
            return $this->ID;
        }

        public function getRole():string{
            return $this->Role;
        }

        public function getNick():string{
            return $this->Nick;
        }

        public function __toString() {
            return "Hello, {$this->Nick}!";
    }
    }

?>