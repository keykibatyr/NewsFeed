<?php
        function random_token(int $length): string{
            $bytes = random_bytes($length);
            $token = bin2hex($bytes);

            return $token;
        }
