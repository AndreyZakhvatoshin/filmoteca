<?php

namespace App\Components;

class Image
{

    public function upload($image)
    {
        $name = mt_rand(0, 10000) . $image['name'];
        move_uploaded_file($image['tmp_name'], 'img/films/' . $name);

        return $name;
    }
}
