<?= $this->layout('layout'); ?>

<div class="container">
    <form enctype="multipart/form-data" action="/films/store" method="POST">
        <div class="form-group">
            <label for="exampleFormControlInput1">Название</label>
            <input name="name" type="text" class="form-control" id="exampleFormControlInput1">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Описание</label>
            <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Дата выхода</label>
            <input name="date" type="text" class="form-control" id="exampleFormControlInput1" placeholder="год">
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Жанр</label>
            <select name="genre" class="form-control" id="exampleFormControlSelect1">
                <?php foreach ($genre as $item) : ?>
                    <option value="<?= $item['id']; ?>"><?= $item['genre']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
            <label for="exampleFormControlFile1">Изображение</label>
            <input name="image" type="file" class="form-control-file" id="exampleFormControlFile1">
        </div>
        <button type="submit" class="btn btn-primary">Создать</button>
    </form>

</div>
