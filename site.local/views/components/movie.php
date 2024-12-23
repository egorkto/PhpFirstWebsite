<?php
/**
 * @var \App\Models\Movie $movie
 * @var \App\Kernel\Storage\StorageInterface $storage
 */
?>

<a href="movie.html" class="card text-decoration-none movies__item">
    <img src="<?php echo $storage->url($movie->preview()) ?>" height="200px" class="card-img-top" alt="<?php echo $movie->name() ?>">
    <div class="card-body">
        <h5 class="card-title"><?php echo $movie->name() ?></h5>
        <p class="card-text">Оценка <span class="badge bg-warning warn__badge">7.9</span></p>
        <p class="card-text"><?php echo $movie->description() ?></p>
    </div>
</a>