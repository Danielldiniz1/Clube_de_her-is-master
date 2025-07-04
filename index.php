<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

ob_start();

$route = new Router(url(), ":");

$route->namespace("Source\App");
// Rotas amigáveis da área pública
$route->get("/", "Web:home");
$route->get("/sobre", "Web:about");
$route->get("/contato", "Web:contact");
$route->get("/localizacao", "Web:location");
$route->get("/carrinho-compras","Web:cart");
$route->get("/servicos","Web:services");
$route->get("/faqs","Web:faqs");
$route->get("/login","Web:login");
$route->get("/cadastro","Web:register");

// Rotas amigáveis da área restrita
$route->group("/app");

$route->get("/", "App:home");
$route->get("/perfil", "App:profile");
$route->get("/carrinho", "App:cart");
$route->get("/listadedesejos", "App:wishlist");
$route->get("/meuclube", "App:myClub");
$route->get("/minhascompras", "App:myBuys");
$route->get("/produtos","App:products");

$route->group(null);

$route->group("/admin");

$route->get("/", "Admin:home");

$route->get("/manprodutos", "Admin:manageProducts");
$route->get("/manusuarios", "Admin:manageUsers");
$route->get("/manclubes", "Admin:manageClubs");

$route->group(null);

$route->get("/ops/{errcode}", "Web:error");

$route->group(null);

$route->dispatch();

if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();