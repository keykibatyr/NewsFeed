<?php
    class Comment{
        public int $id;
        public int $user_id;
        public int $post_id;
        public string $nickname;
        public string $description;
        public DateTime $created_at;

        public function __construct(
            int $user_id,
            int $post_id,
            string $description,
            string $nickname,
            
            DateTime $created_at = new DateTime()
        ) {
            $this -> user_id = $user_id;
            $this -> post_id = $post_id;
            $this -> description = $description;
            $this -> created_at = $created_at;
            $this -> nickname = $nickname;
        }
    }

    class CommentService{
        private PDO $db;

        public function __construct(PDO $db){
            $this -> db = $db;
        }

        public function Create(int $user_id, int $post_id, string $description, string $nickname){
            $query = $this->db->prepare("INSERT INTO comments (user_id, post_id, description, nickname)
             VALUES (:uid, :pid, :desc, :nick)");

            $query -> execute([
                ':uid' => $user_id,
                ':pid' => $post_id,
                ':desc' => $description,
                ':nick' => $nickname
            ]);
        }

        public function getAllbyId($post_id):array{
            $query = $this -> db -> prepare("SELECT user_id, post_id, description, created_at, nickname FROM comments WHERE post_id = ?");

            $query -> execute([$post_id]);

            $rows = $query -> fetchAll(PDO::FETCH_ASSOC);

            $comments = [];
            foreach($rows as $row){
                $comments[] = new Comment(                
                $row['user_id'],
                $row['post_id'],
                $row['description'],
                $row['nickname'],
                new DateTime($row['created_at']),
            );
            }

            return $comments;
        }   
    }
?>