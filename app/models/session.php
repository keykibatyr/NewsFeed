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

        class SessionService {
        private PDO $db;

        public function __construct(PDO $db){
            $this -> db = $db;
        }

        public function Create(int $userID): Session {
            $token = random_token(32);
            $token_hash = hash('sha256', $token);

            $query = $this->db->prepare("INSERT INTO sessions (user_id, token_hash) VALUES (:uid, :tkhash)");

            $query -> execute([
                ':uid' => $userID,
                ':tkhash' => $token_hash
            ]);

            $query = $this->db->prepare("SELECT token_hash, id, expires_at FROM sessions WHERE user_id = ?");
            $query -> execute([$userID]); 
            $row = $query -> fetch(PDO::FETCH_ASSOC);
            $token_hash = $row['token_hash'];
            $id = (int)$row['id'];
            $expires_at = new DateTime($row['expires_at']);
            $session = new Session($id, $userID, $token, $token_hash, $expires_at);
            return $session;
        }

        public function User(string $token):User{
            $tokenHash = hash('sha256', $token);

            $query = $this -> db -> prepare("SELECT users.id, users.nickname, users.email, users.password_hash, users.role FROM users INNER JOIN sessions ON sessions.user_id = users.id WHERE sessions.token_hash = ?");

            $query -> execute([$tokenHash]);

            $row = $query -> fetch(PDO::FETCH_ASSOC);
            $id = (int)$row['id'];
            $nick = $row['nickname'];
            $email = $row['email'];
            $passwordHash = $row['password_hash'];
            $role = $row['role'];

            $user = new User($id, $nick, $email, $passwordHash, $row);

            return $user;

        }

        public function IsExpired(string $token):bool{
            $tokenHash = hash('sha256', $token);
        
            $query = $this->db->prepare("SELECT expires_at FROM sessions WHERE token_hash = ?");
            $query -> execute([$tokenHash]); 
            $row = $query -> fetch(PDO::FETCH_ASSOC);
            if (!$row) {
                return true; // no session = treat as expired
            }

            $expires_at = new DateTime($row['expires_at']);
            $current_time = new DateTime();
            if ($expires_at < $current_time){
                return true;
            }
            
            return false;
        }
    }
?>