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
?>