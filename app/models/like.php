<?php
class Like {
    private int $id; 
    private int $user_id;
    private int $post_id;

    public function __construct(
        int $user_id,
        int $post_id
    ){
        $this -> user_id = $user_id;
        $this -> post_id = $post_id;
    }
    
    public function getId():int {
        return $this->id;
    }
}

class LikeService {
    private PDO $db;

    public function __construct(
        PDO $db
    ){
        $this -> db = $db;
    }

    public function Like(int $user_id, int $post_id){
        $query = $this -> db -> prepare("SELECT 1 FROM likes 
        where user_id = ? AND post_id = ?");

        $query -> execute([$user_id, $post_id]);

        if ($query -> fetch()){
            $query = $this -> db -> prepare("DELETE FROM likes 
            WHERE user_id=? AND post_id=?");

            $query -> execute([$user_id, $post_id]);
            
        } else {
            $query = $this -> db -> prepare("INSERT INTO likes (user_id, post_id)
            VALUES (:uid , :pid)");

            $query -> execute([
                ':uid' => $user_id,
                ':pid' => $post_id
        ]);
        }

    }
}
?>