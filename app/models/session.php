<?php
    require_once(ROOT_PATH . '/utils/rand.php');
    class Session {
        private int $id;
        private int $userID;
        private string $token;
        private string $tokenHash;
        private DateTime $expireDate;
        
        public function __construct(
            int $id, 
            int $userID, 
            string $token, 
            string $tokenHash,
            DateTime $expireDate
            ){
                $this -> id = $id;
                $this -> userID = $userID;
                $this -> token = $token;
                $this -> tokenHash = $tokenHash;
                $this -> expireDate = $expireDate;
            }

        public function getToken(): string{
            return $this ->token;
        }
    }

?>