<?php 
require_once(ROOT_PATH . '/models/comment.php');
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

        function AllComments(){
            $query = $this -> db -> prepare(
                "SELECT COUNT(*) FROM comments"
            );

            $query -> execute();

            $comments = $query -> fetchColumn();

            return $comments;
        }
    }