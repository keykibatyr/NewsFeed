<?php   
    class FeedController {

        private PostService $postService;

        public function __construct(PostService $postService){
            $this -> postService = $postService;
        }
        public function feed() {
        return [
            'path' => 'feed/index',
            'data' => ['A', 'B']
            ];
        }

        public function health(){
        http_response_code(200);
        return [
            'path' => 'feed/index',
            'data' => null
            ];
        }
    }
?>