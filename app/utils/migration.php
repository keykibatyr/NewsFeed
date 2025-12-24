<?php
    function migration(PDO $pdo) {
        $pdo -> exec("CREATE TABLE migrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255)
        );");
        
        

    }

    function runMigration(PDO $pdo, string $name, string $query){
        $stmt = $pdo -> prepare("SELECT 1 FROM migrations WHERE name = ?");
        $stmt -> execute([$name]);
        if (!$stmt ->fetch()){
            $pdo -> exec($query);

            $stmt = $pdo -> prepare("INSERT INTO migrations (name) VALUES (?)");
            $stmt = $stmt -> execute([$name]);
        }

    }



// <!-- write the migrations function

// and write a helper migration runner so that i could insert
// 3 tables at once -->