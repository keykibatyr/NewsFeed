<?php
    class Post{
        public int $id;
        public int $userID;
        public string $description;
        public string $title;
        public string $image_url;
        public int $likes;
        public int $comments;
        public DateTime $created_at;

        public function __construct(
            int $id,
            int $userID,
            string $description,
            string $title, 
            string $image_url,
            int $likes = 0,
            int $comments = 0,
            DateTime $created_at = new DateTime()
        ) {
            $this -> id = $id;
            $this -> userID = $userID;
            $this -> description = $description;
            $this -> title = $title;
            $this -> image_url = $image_url;
            $this -> likes = $likes;
            $this -> comments = $comments;
            $this -> created_at = $created_at;
        }
    }

    class PostService {
        private PDO $db;

        public function __construct(PDO $db){
            $this -> db = $db;
        }

        public function Create(int $userID, string $description, string $title, string $image_url = ""): Post{
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

        public function DeletePost(int $postID){
            $query = $this -> db -> prepare("DELETE FROM posts WHERE id = ?");
            $query -> execute([$postID]);
        } 

        public function GetAllPosts(): array|Post {
            $query = $this -> db -> prepare("SELECT
            p.id, p.user_id AS userID, 
            p.description, p.title, 
            p.image_url, p.created_at, COUNT(DISTINCT l.id) as likes, COUNT(DISTINCT  c.id) as comments
            
            FROM posts p

            LEFT JOIN likes l ON l.post_id = p.id
            LEFT JOIN comments c ON c.post_id = p.id

            GROUP BY p.id, userID, p.description, p.title, p.image_url, p.created_at
            ORDER BY p.id DESC");

            $query -> execute();

            $rows = $query -> fetchAll(PDO::FETCH_ASSOC);
            $posts = [];
            foreach($rows as $row){
                $posts[] = new Post(
                    $row['id'],
                    $row['userID'],
                    $row['description'],
                    $row['title'],
                    $row['image_url'],
                    $row['likes'],
                    $row['comments'],
                    new DateTime($row['created_at'] )
                );
            }

            return $posts;
        }

        // public function NumberOfPosts(): array {
        //     $query = $this -> db -> prepare("SELECT COUNT(*) FROM posts");

        //     $query -> execute();

        //     $number = $query -> fetchAll(PDO::FETCH_ASSOC);

        //     return $number;
        // }
    }
?>