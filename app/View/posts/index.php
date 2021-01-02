<?php $title = 'Les articles'; ?>

<?php if (!empty($posts)): ?>
    <h1 class="my-5">Les articles</h1>
    <?php foreach ($posts as $post): ?>
        <div class="blog-post">
            <h4><?= $post->title ?></h4>
            <p><?= Text::truncate(strip_tags($post->content)); ?></p>
            <a href="<?= Urls::route('posts@show', ['slug' => $post->slug]) ?>">Lire la suite</a>
        </div>
    <?php endforeach; ?>
    <?php Paginate::show('App\Repository\PostRepository'); ?>
<?php else: ?>
    <h3 class="text-center my-5">Aucun articles</h3>
<?php endif; ?>
