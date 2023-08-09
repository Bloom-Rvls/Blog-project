<?php

use App\Helpers\Text;
use App\Model\Post;
use App\Connection;
use App\Model\Category;
use App\PaginatedQuery;
use App\Table\PostTable;
use App\URL;

 $title = 'Mon blog'; 

 $pdo = Connection::getPDO();

 $table = new PostTable($pdo);
 [$posts, $pagination] = $table->findPaginated();
 
 //a revoir affichage des categories sur chaque post
 /* $postsByID = [];
 foreach ($posts as $post) {
    $postsByID[$post->getID()] = $post;
 } 

 $categories = $pdo
    ->query(
            "SELECT c.* , pc.post_id  
            FROM 
            	post p,
            	post_category pc,
                category c
            WHERE
                pc.post_id = p.id AND
                c.id = pc.category_id"
    )->fetchAll(PDO::FETCH_CLASS, Category::class);
 dump($categories); */



 $link = $router->url('home');
 ?>


<h1>Mon blog</h1>

<div class="row">
    <?php foreach($posts as $post): ?>
        <div class="col-md-3">
            <?php require 'card.php'; ?>
        </div>
    <?php endforeach; ?>
</div>

<div class="d-flex justify-content-between my-4">
    <?= $pagination->previousLink($link) ?>
    <?= $pagination->nextLink($link) ?>
</div>


