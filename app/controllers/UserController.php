<?php
    require_once(ROOT_PATH . '/models/user.php');
    // define("COOKIE_SESSION", "session");
    class UserController {

        private UserService $userService;
        private SessionService $sessionService;

        public function __construct(
            UserService $userService, 
            SessionService $sessionService)
            {
            $this->userService = $userService;
            $this->sessionService = $sessionService;
        }

        public function signup() {
            return [
                'path' => [null, 'auth/signup'],
                'data' => null
            ];
        }

        public function processSignup() {
            $nickname = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($nickname === '' || $email === '' || $password === ''){
                return [
                    'path' => [null, 'auth/signin'],
                    'data' => null
                ];
            }

            $user = $this->userService->CreateUser($nickname, 
            $email, $password);
            if ($user == null){
                header('Location: /signup');
                exit;
            }
            error_log($user);
            $session = $this->sessionService->Create($user->getID());
            setcookie('cookie_session', $session->getToken(), 
            [
            "httponly" => true,
            "secure"   => false,   // make true for HTTPS only
            "samesite" => "Strict"
            ]);
            header('Location: /');
            exit;
        }

        public function signin() {
            return [
                'path' => [null, 'auth/signin'],
                'data' => null
            ];
        }

        public function processSignIn(){
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($email === '' || $password === ''){
                return [
                    'path' => [null, 'feed/index'],
                    'data' => null
                ];
            }

            $user = $this -> userService -> Authenticate($password, $email);
            if ($user == null){
                header('Location: /signin');
                exit;
            }
            $session = $this->sessionService->Create($user->getID());
            setcookie('cookie_session', $session->getToken(), 
            [
            "httponly" => true,
            "secure"   => false,   // make true for HTTPS only
            "samesite" => "Strict"
            ]);
            header('Location: /');
            exit;
        }

        public function processSignOut(){
            $token = $_COOKIE['cookie_session'];

            $this->sessionService->Delete($token);
            setcookie("cookie_session", "", time() - 3600);
   
            header('Location: /signin');
            exit;
        }
    }
?>