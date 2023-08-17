<?php

use App\Connection;
use App\Table\PostTable;

$pdo = Connection::getPDO();
$postTable = new PostTable($pdo);
$post = $postTable->find($params['id']);
$success = false;

if(!empty($_POST)) {
     $post->setName($_POST['name']);
     $postTable->update($post);
     $success = true;
}

?>

<?php if($success): ?>
     <div class="alert alert-success">
          L'article a bien été modifié
     </div>
<?php endif; ?>

<h1>Modifier l'article <?= e($post->getName()) ?></h1>

<form action="" method="post">
     <div class="form-group">
          <label for="name">Titre</label>
          <input type="text" class="form-control" name="name" value="<?= e($post->getName()) ?>" required>
     </div>
     <button class="btn btn-primary mt-3">Modifier</button>

</form>