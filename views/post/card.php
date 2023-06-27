<div class="card m-2">
    <div class="card-body">
        <h5 class="card-title"><?= htmlentities($post->getName())?></h5>
        <p class="text-muted"><?= $post->getCreatedAt()->format('d F Y') ?></p>
        <p class="card-text"><?= $post->getExcerpt() ?></p>
        <p class="card-text">
            <a href="<?= $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]) ?>" class="btn btn-primary">voir plus</a>
        </p>
    </div>
</div>