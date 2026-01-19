<?php 
    require_once(ROOT_PATH . '/models/session.php');
    require_once(ROOT_PATH . '/models/post.php');
      require_once(ROOT_PATH . '/models/like.php');
    class FeedController {

        private PostService $postService;
        private SessionService $sessionService;
        private LikeService $likeService;
        private CommentService $commentService;

        public function __construct(PostService $postService, SessionService $sessionService,
        LikeService $likeService, CommentService $commentService){
            $this -> postService = $postService;
            $this -> sessionService = $sessionService;
            $this -> likeService = $likeService;
            $this -> commentService = $commentService;
        }
        public function feed() {    
        $posts = $this -> postService -> GetAllPosts();
            // var_dump($posts);
        return [
            'path' => [null, 'feed/index'],
            'data' => [
                'posts' => $posts
            ]
            ];
        }

        public function health(){
        http_response_code(200);
        return [
            'path' => ['user', null],
            'data' => null
            ];
        }

        public function newPost() {
            return [
                'path' => ['user', 'feed/new_post'],
                'data' => null
            ];
        }

        

        public function newPostProcess(){
            $description = trim($_POST['description'] ?? '');
            $title = $_POST['title'] ?? '';
            $uploadOK = 1;
            $message = 'oops, there is some error';

            $token = $_COOKIE['cookie_session'];
            $user = $this -> sessionService -> User($token);
            $userID = $user -> getID();

            // var_dump(basename($_FILES["image"]["name"]));

            $target_dir = __DIR__   . '../../uploads/';

            // var_dump(($target_dir));

            $target_file = $target_dir . basename($_FILES["image"]["name"]);

            switch ($_FILES["image"]["error"]){
                case UPLOAD_ERR_OK:    
                    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                    
                    // if (isset($_POST["submit"])){
                    //     $check = getimagesize($_FILES["image"]["name"]); // try to parse the file as (JPEG, PNG, GIF etc)
                    //     if ($check !== false){
                    //         $message = "File is an image - " . $check["mime"] . "."; //refactor
                    //         $uploadOK = 1;
                    //     } else {
                    //         $message = "File is not an image."; //refactor
                    //         $uploadOK = 0;
                    //     }
                    // }

                    //REFACTOR IT! REFACTOR IT! REFACTOR IT! REFACTOR IT! REFACTOR IT!

                    // Check file size
                    if ($_FILES["image"]["size"] > 5000000) {
                        $message = "Sorry, your file is too large."; //refactor
                        $uploadOK = 0;
                    }

                    if ($imageFileType != "jpg" && $imageFileType != "png" && 
                    $imageFileType != "jpeg" && $imageFileType != "gif" ){
                        $message = "Sorry, cannot accept that kind of file extension"; //refactor
                        $uploadOK = 0;
                    }


                    // var_dump($target_file);

                    // var_dump(empty($_FILES["image"]));
                    if ($uploadOK == 0) {
                        throw new Exception("Sorry, your file was not uploaded. " .  $message);
                        // if everything is ok, try to upload file
                    } else {
                        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
                    }
                    
                    $this -> postService -> Create($userID, 
                    $description, $title, $target_file);
                    break;
                case UPLOAD_ERR_NO_FILE:
                    $this -> postService -> Create($userID, 
                    $description, $title);
            }
            header('Location: /');
            exit;

        }

        public function like() {
            $token = $_COOKIE['cookie_session'];
            $user = $this -> sessionService -> User($token);
            $postID = $_POST['post_id'];

            $this -> likeService -> Like($user->getID(), $postID);
            
            header("Location: /");
            exit;
        }

        public function comment($match) {
            $postID = (int)$match;

            $comments = $this -> commentService -> getAllbyId($postID);

            return [
                'path' => ['user', 'feed/comment'],
                'data' => 
                [
                    'comments' => $comments,
                    'post_id' => $postID
                ]
            ];
        }

        public function processComment(){
            $postID = (int)$_POST['post_id'];
            $description = $_POST['content'];
            $token = $_COOKIE['cookie_session'];
            $user = $this -> sessionService -> User($token);

            $this -> commentService -> Create($user -> getID(), $postID, $description, $user -> getNick());
            
            // var_dump($postID);
            // var_dump($description);
            // var_dump($token);
            // var_dump($user);

            header("Location: /post/comments/" . $postID); //refactor
            exit;
        }


        //add deleting own comments

        //add editiding the comment
        
    }
?>