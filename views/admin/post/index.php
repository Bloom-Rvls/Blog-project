<?php

use App\Auth;
use App\Connection;
use App\Table\PostTable;

Auth::check();

$title = "Administration";
$pdo = Connection::getPDO();
$link = $router->url('admin_posts');

[$posts, $pagination] = (new PostTable($pdo))->findPaginated();

?>

<?php if(isset($_GET['delete'])): ?>
    <div class="alert alert-success">
        L'enregistrement à bien été supprimer
    </div>
<?php endif; ?>

<table class="table">
    <thead>
        <th>#</th>
        <th>Titre</th>
        <th>
            <a href="<?= $router->url('admin_post_new')?>" class="btn btn-primary">Nouveau </a>
        </th>
    </thead>
    <tbody>
        <?php foreach($posts as $post): ?>
            <tr>
                <td>
                    #
                    <?= e($post->getID())?>
                </td>
                <td>
                    <a href="<?= $router->url('admin_post', ['id' => $post->getID()])?>">
                        <?= e($post->getName()) ?>
                    </a>
                </td>
                <td>
                    <a href="<?= $router->url('admin_post', ['id' => $post->getID()])?>" class="btn btn-primary">
                        Editer
                    </a>
                    <form action="<?= $router->url('admin_post_delete', ['id' => $post->getID()])?>" method="post"
                        onsubmit="return confirm('voulez vous vraiment effectuer cette action?')" style="display: inline;">
                        <button class="btn btn-danger" type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="d-flex justify-content-between my-4">
    <?= $pagination->previousLink($link) ?>
    <?= $pagination->nextLink($link) ?>
</div>