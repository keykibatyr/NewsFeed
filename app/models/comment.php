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
?>