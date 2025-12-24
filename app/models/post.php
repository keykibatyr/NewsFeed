<?php
    class Post{
        public int $id;
        public int $userID;
        public string $description;
        public string $title;
        public string $image_url;

        public function __construct(
            int $id,
            int $userID,
            string $description,
            string $title, 
            string $image_url
        ) {
            $this -> id = $id;
            $this -> userID = $userID;
            $this -> description = $description;
            $this -> title = $title;
            $this -> image_url = $image_url;
        }
    }

    class PostService {
        private PDO $db;

        public function __construct(PDO $db){
            $this -> db = $db;
        }

        function Create(int $userID, string $description, string $title, string $image_url): Post{
            $query = $this->db->prepare(
                "INSERT INTO posts (user_id, description, title, image_url) VALUES (:uid, :desc, :title, :img)"
            );

            $query -> execute([
                ':uid' => $userID,
                ':desc' => $description,
                ':title' => $title,
                ':img' => $image_url
            ]);

            $id = (int)$this->db->lastInsertId();
            $post = new Post($id,$userID,  $description, $title, $image_url);
            return $post;
        }
    }



?>