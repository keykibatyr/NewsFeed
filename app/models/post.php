<?php
    class Post{
        public int $id;
        public int $user_id;
        public string $title;
        public string $image_url;

        public function __construct(
            int $id, 
            int $user_id, 
            string $title, 
            string $image_url
        ) {
            $this -> id = $id;
            $this -> user_id = $user_id;
            $this -> title = $title;
            $this -> image_url = $image_url;
        }
    }

    class PostService {
        private PDO $db;

        public function __construct(
            PDO $db
        ){
            $this -> db = $db;
        }
    }

?>