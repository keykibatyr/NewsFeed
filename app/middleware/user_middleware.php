<?php
    function RequireUser(string $token, 
    SessionService $sessionService){
        if ($sessionService -> IsExpired($token)){
            header('Location: /signin');
            exit;
        } else {
            return;
        }
    }  

    function RequireAdmin(string $token, SessionService $sessionService){

        if (!$token || $sessionService->isExpired($token)) {
            header('Location: /signin');
            exit;
        }

        $user = $sessionService -> User($token);
        if (($user->getRole()) != "admin"){
            header(`Location: /`);
            exit;
        } else {
            return;
        }
    }