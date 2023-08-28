<?php

use App\Connection;
use App\Table\PostTable;
use App\Validator;
use App\HTML\Form;
use App\Validators\PostValidator;

$pdo = Connection::getPDO();
$postTable = new PostTable($pdo);
$post = $postTable->find($params['id']);
$success = false;

$errors = [];

if(!empty($_POST)) {
     Validator::lang('fr');
     $v = new PostValidator($_POST);
     $post
          ->setName($_POST['name'])
          ->setContent($_POST['content'])
          ->setSlug($_POST['slug'])
          ->setCreatedAt($_POST['created_at']);
          
     if($v->validate()) {
          $postTable->update($post);
          $success = true;
     }else {
          $errors = $v->errors();
     }
}

$form = new Form($post, $errors);
?>

<?php if($success): ?>
     <div class="alert alert-success">
          L'article a bien été modifié
     </div>
<?php endif; ?>

<?php if(!empty($errors)): ?>
     <div class="alert alert-danger">
          L'article n'a pas pu être modifier, merci de corriger vos erreurs
     </div>
<?php endif; ?>

<h1>Modifier l'article <?= e($post->getName()) ?></h1>

<form action="" method="post">
     <?= $form->input('name', 'Titre') ?>
     <?= $form->input('slug', 'URL') ?>
     <?= $form->textarea('content', 'Contenu') ?>
     <?= $form->input('created_at', 'Date de creation') ?>
     <button class="btn btn-primary mt-3">Modifier</button>

</form>