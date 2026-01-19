<?php 
    require_once(ROOT_PATH . '/models/user.php');
    class AdminController{
        private UserService $userService;
        private PostService $postService;

        public function __construct(UserService $userService, PostService $postService){
            $this->userService = $userService;
            $this->postService = $postService;
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

        // public function dashboard(){
        //     $posts = $this -> postService -> NumberOfPosts();
        //     var_dump($posts);
        //     return [
        //         'path' => ['admin', 'admin/pages/posts'],
        //         'data' => [
        //             'posts' => $posts
        //         ]
        //     ];
        // }

        public function delete($match = null) {
            $postID = (int)$match;

            $this -> postService -> DeletePost($postID);

            header('Location: /admin/posts');
            exit;
        }

        
    }