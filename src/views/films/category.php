<?= $this->layout('layout'); ?>

<header class="header">
    <div class="container">
        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Жанры
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <?php foreach ($genre as $item) : ?>
                    <a class="dropdown-item" href="/category/<?= $item['id']; ?>"><?= $item['genre']; ?></a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <?php foreach ($films as $film) : ?>
        <div class="row film__list">
            <div class="col col-md-2">
                <img src="/img/films/<?= $film['image']; ?>">
            </div>
            <div class="col">
                <div class="row">
                    <div class="col col-md-6">
                        <a href="/films/<?= $film['id']; ?>">
                            <h2 class="title"><?= $film['title']; ?></h2>
                        </a>
                    </div>
                    <div class="col ml-auto"><?= $film['date']; ?></div>
                </div>
                <div class="row">
                    <div class="col">
                        <p><?= $film['description']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
