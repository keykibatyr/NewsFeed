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

    class UserService {
        private PDO $db;

        public function __construct(PDO $db){
            $this -> db = $db;
        }

        function CreateUser(string $nickname, string $email, string $password): User{

            $email = strtolower($email);
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $query = $this->db->prepare(
                "INSERT INTO users (nickname, email, password_hash) VALUES (:nick, :email, :pwHash)"
            );

            $query -> execute([
                ':nick' => $nickname,
                ':email' => $email,
                ':pwHash' => $passwordHash,
            ]);

            $id = (int)$this->db->lastInsertId();
            $query = $this->db->prepare(
                "SELECT role FROM users WHERE id = ?"
            );
            $query -> execute([$id]);
            $role = $query -> fetchColumn(); //fetches the role
            $user = new User($id, $nickname, 
            $email, $passwordHash, $role);
            return $user;
        }

        function Authenticate(string $password, string $email): ?User{
            $email = strtolower($email);

            $query = $this->db->prepare(
                "SELECT password_hash, id, nickname, role FROM users WHERE email = ?"
            );
            $query -> execute([$email]);
            $row = $query->fetch(PDO::FETCH_ASSOC); //GETS ALL VALUES FROM THE RETURNED QUERY
            $passwordHash = $row['password_hash'];
            $id = (int)$row['id'];
            $nickname = $row['nickname'];
            $role = $row['role'];
            if (password_verify($password, $passwordHash)) {
                $user = new User($id, $nickname, $email,  $passwordHash, $role);
                return $user;
            } else {
               return null;
            }
        }

        function AllUsers(){
            $query = $this -> db -> prepare(
                "SELECT COUNT(*) FROM users"
            );

            $query -> execute();

            $users = $query -> fetchColumn();

            return $users;
        }
    }

?>