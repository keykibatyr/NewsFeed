<?php 
    exec("docker compose up -d");
    exec("java -jar selenium-server-4.39.0.jar standalone");  

    