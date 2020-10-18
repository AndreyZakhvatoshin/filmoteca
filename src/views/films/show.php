<?= $this->layout('layout'); ?>
<div class="container">
    <div class="row film__list">
        <div class="col col-md-2">
            <img src="/img/films/<?= $film['image']; ?>">
        </div>
        <div class="col">
            <div class="row">
                <div class="col col-md-3">
                    <a href="/films/<?= $film['id']; ?>">
                        <h2 class="title"><?= $film['title']; ?></h2>
                    </a>
                </div>
                <div class="col m-sm-2"><?= $film['date']; ?></div>
            </div>
            <div class="row">
                <div class="col">
                    <p><?= $film['description']; ?></p>
                </div>
            </div>
        </div>
    </div>
    <a href="/films/<?= $film['id']; ?>/edit" class="btn btn-success">Редактировать</a>
    <a href="/films/<?= $film['id']; ?>/delete" class="btn btn-danger">Удалить</a>
</div>
