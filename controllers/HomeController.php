<?php

namespace Controllers;

use dibi;

class HomeController
{
    public function index()
    {
        $users = dibi::query('SELECT * FROM users')->fetchAll();

        return json_response(['users' => $users], 404);
    }
}
