<?php

namespace Source\App;

use League\Plates\Engine;

class App
{
    private $view;

    public function __construct()
    {
        $this->view = new Engine(__DIR__ . "/../../themes/app","php");
    }

    public function home ()
    {
        //echo "<h1>Eu sou a Home...</h1>";
        echo $this->view->render("home",[]);
    }

    public function profile ()
    {
        echo $this->view->render("profile",[]);
    }

    public function cart (array $data)
    {
        echo $this->view->render("cart", []);
    }
    public function wishlist (array $data)
    {
        echo $this->view->render("wishlist", []);
    }
    public function myClub (array $data)
    {
        echo $this->view->render("myClub", []);
    }
    public function myBuys (array $data)
    {
        echo $this->view->render("myBuys", []);
    }
    public function products (array $data)
    {
        echo $this->view->render("products", []);
    }

}