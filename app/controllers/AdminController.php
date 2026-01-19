<?php 
    require_once(ROOT_PATH . '/models/user.php');
    class AdminController{
        private UserService $userService;
        private PostService $postService;
        private CommentService $commentService;

        public function __construct(UserService $userService, PostService $postService, CommentService $commentService){
            $this->userService = $userService;
            $this->postService = $postService;
            $this->commentService = $commentService;
        }

        public function posts(){
            $posts = $this -> postService -> GetAllPosts();
            return[
                'path' => ['admin', 'admin/pages/posts'],
                'data' => [
                    'posts' => $posts
                ]
            ];
        }

        public function dashboard(){
            $posts = $this -> postService -> NumberOfPosts();
            $users = $this -> userService -> AllUsers();
            $comments = $this -> commentService -> AllComments();

            return [
                'path' => ['admin', 'admin/pages/dashboard'],
                'data' => [
                    'stats' => [
                        'posts' => $posts,
                        'users' => $users,
                        'comments' =>  $comments]
                ]
            ];
        }

        public function delete($match = null) {
            $postID = (int)$match;

            $this -> postService -> DeletePost($postID);

            header('Location: /admin/posts');
            exit;
        }

        
    }