<?php

$pdo = new PDO('mysql:host=localhost:3306;dbname=blog;charset=utf8','root','',[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
]);

//ignore les clés étrangères
$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
//TRUNCATE vide une table
$pdo->exec('TRUNCATE TABLE post_category');
$pdo->exec('TRUNCATE TABLE post');
$pdo->exec('TRUNCATE TABLE category');
$pdo->exec('TRUNCATE TABLE user');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');

$posts = [];
$categories = [];
for ($i=0; $i < 50 ; $i++) { 
    $pdo->exec("INSERT INTO post SET name='Article #$i', slug='article-$i', content='lorem ipsum dolor', created_at='2023-06-21 18:00:00'");
    $posts[] = $pdo->lastInsertId();
}

for ($i=0; $i < 5 ; $i++) { 
    $pdo->exec("INSERT INTO category SET name='Category #$i', slug='category-$i'");
    $categories[] = $pdo->lastInsertId();
}

foreach($posts as $post) {
    $category = random_int(0, count($categories));
    $pdo->exec("INSERT INTO post_category SET post_id=$post, category_id=$category");
    
}

$password = password_hash('admin', PASSWORD_BCRYPT);
$pdo->exec("INSERT INTO user SET username='admin', password='$password'");