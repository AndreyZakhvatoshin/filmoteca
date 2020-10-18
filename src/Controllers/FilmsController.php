<?php

namespace App\Controllers;

use App\Components\Db;
use App\Components\Image;
use League\Plates\Engine;


class FilmsController
{
    private $view;
    private $database;

    public function __construct(Db $database, Engine $view)
    {
        $this->view = $view;
        $this->database = $database;
    }
    public function index()
    {
        $genre = $this->database->all('genre');
        $films = $this->database->all('films');
        echo $this->view->render('films/index', ["films" => $films, "genre" => $genre]);
    }

    public function show($id)
    {

        $film = $this->database->getOne('films', $id);
        echo $this->view->render('films/show', ["film" => $film]);
    }
    public function showCategory($id)
    {
        $genre = $this->database->all('genre');
        $films = $this->database->getFromCategory('films', $id);
        echo $this->view->render('films/category', ["films" => $films, "genre" => $genre]);
    }
    public function add()
    {
        $genre = $this->database->all('genre');
        echo $this->view->render('films/add', ['genre' => $genre]);
    }

    public function store()
    {
        $uploadImage = new Image;
        $image = $uploadImage->upload($_FILES['image']);
        $data = [
            'title' => $_POST['name'],
            'image' => $image,
            'description' => $_POST['description'],
            'genre_id' => $_POST['genre'],
            'date' => $_POST['date'],
        ];
        $this->database->store('films', $data);
        header("Location: /");
    }

    public function edit($id)
    {
        $genre = $this->database->all('genre');
        $film = $this->database->getOne('films', $id);
        echo $this->view->render('films/edit', ["film" => $film, "genre" => $genre]);
    }

    public function update($id)
    {
        $uploadImage = new Image;
        $image = $uploadImage->upload($_FILES['image']);
        $data = [
            'title' => $_POST['name'],
            'image' => $image,
            'description' => $_POST['description'],
            'genre_id' => $_POST['genre'],
            'date' => $_POST['date'],
        ];
        $this->database->update('films', $id, $data);
        header("Location: /");
    }

    public function delete($id)
    {
        $this->database->delete('films', $id);
        header("Location: /");
    }
}
