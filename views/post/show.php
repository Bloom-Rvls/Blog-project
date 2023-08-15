<?php
use App\Connection;
use App\Model\{Category, Post};
use App\Table\PostTable;

$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();

$post = (new PostTable($pdo))->find($id);

if($post->getSlug() !== $slug) {
    $url = $router->url('post', ['slug' => $post->getSlug(), 'id' => $id]);
    http_response_code(301);
    header('Location: '. $url);
}

$query = $pdo->prepare('
SELECT c.id, c.slug, c.name
FROM post_category pc
JOIN category c ON pc.category_id = c.id 
WHERE pc.post_id = :id');
$query->execute(['id' => $post->getID()]);
$query->setFetchMode(PDO::FETCH_CLASS, Category::class);
$category = $query->fetch();
$category_url = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);
?>


<h1><?= e($post->getName())?></h1>
<p class="text-muted"><?= $post->getCreatedAt()->format('d F Y') ?></p>
<a href="<?= $category_url ?>"><?= e($category->getName())?></a>
<p class="card-text"><?= $post->getFormattedContent() ?></p>
