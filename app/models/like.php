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
?>