<?php

    $allowedIPs = file(__DIR__ . '/../utils/allowed_ips.txt', FILE_IGNORE_NEW_LINES);
    $ip = explode(',' ,$_SERVER['HTTP_X_FORWARDED_FOR'])[0];

    // var_dump($ip);

    // // var_dump($_SERVER['HTTP_X_FORWARDED_FOR']);
    // // var_dump(explode(',', $_SERVER('HTTP_X_IP')));
    // var_dump($_SERVER['REMOTE_ADDR']);
        function RequireUser(SessionService $sessionService){
        if (!isset($_COOKIE['cookie_session'])){
            header('Location: /signin');
            exit;
        }

        $token = $_COOKIE['cookie_session'];

        if ($sessionService -> IsExpired($token)){
            $sessionService -> Delete($token);
            setcookie("cookie_session", "", time() - 3600);
            header('Location: /signin');
            exit;
        } else {
            return;
        }
    }  

    function RequireAdmin(SessionService $sessionService){
        global $allowedIPs;
        global $ip;



        // var_dump($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_X_FORWARDED_FOR']);
        // exit;

        if (!isset($_COOKIE['cookie_session'])){
            header('Location: /signin');
            exit;
        }
        
        $token = $_COOKIE['cookie_session'];

        // !in_array($_SERVER['REMOTE_ADDR'],  $allowedIPs, true
        if (!in_array(trim($ip),  $allowedIPs, true)){
            header('Location: /');
            exit;
        }

        if (!$token || $sessionService->isExpired($token)) {
            if (isset($token)){
                $sessionService -> Delete($token);
                setcookie("cookie_session", "", time() - 3600);
            }
            header('Location: /signin');
            exit;
        }

        $user = $sessionService -> User($token);
    
        if (($user->getRole()) != "admin"){
            header('Location: /');
            exit;
        } else {
            return;
        }
    }