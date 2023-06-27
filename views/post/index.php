<?php

use App\Helpers\Text;
use App\Model\Post;

 $title = 'Mon blog'; 

 $pdo = new PDO('mysql:host=localhost:3306;dbname=blog;charset=utf8', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
 ]);
 $query = $pdo->query('SELECT * FROM post ORDER BY created_at DESC LIMIT 12');
 $posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class);
 ?>

<h1>Mon blog</h1>

<div class="row">
    <?php foreach($posts as $post): ?>
        <div class="col-md-3">
            <div class="card m-2">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlentities($post->getName())?></h5>
                    <p class="text-muted"><?= $post->getCreatedAt()->format('d F Y') ?></p>
                    <p class="card-text"><?= $post->getExcerpt() ?></p>
                    <p class="card-text">
                        <a href="#" class="btn btn-primary">voir plus</a>
                    </p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>


