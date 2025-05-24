<?php

namespace Source\App\Api;

use Source\Models\Product;
use Source\Models\Club;

class Products extends Api
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getProduct()
    {
        $this->auth();

        // Buscar produtos dos clubes do usuário
        $club = new Club();
        $userClubs = $club->selectByUserId($this->userAuth->id);
        
        $allProducts = [];
        foreach($userClubs as $userClub) {
            $product = new Product();
            $clubProducts = $product->selectByClubId($userClub->id);
            $allProducts = array_merge($allProducts, $clubProducts);
        }

        $this->back([
            "tipo" => "success",
            "mensagem" => "Produtos dos seus clubes",
            "products" => $allProducts
        ]);
    }

    public function listProducts()
    {
        $products = new Product();
        $allProducts = $products->selectAll();

        // Filtrar apenas produtos ativos
        $activeProducts = array_filter($allProducts, function($product) {
            return $product->is_active == 1;
        });

        $this->back([
            "tipo" => "success",
            "mensagem" => "Lista de produtos",
            "products" => array_values($activeProducts)
        ]);
    }

    public function listProductsByClub(array $data)
    {
        if(empty($data["club_id"])) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "ID do clube é obrigatório"
            ]);
            return;
        }

        $product = new Product();
        $clubProducts = $product->selectByClubId($data["club_id"]);

        $this->back([
            "tipo" => "success",
            "mensagem" => "Produtos do clube",
            "products" => $clubProducts
        ]);
    }

    public function createProduct(array $data)
    {
        // Validar campos obrigatórios
        $requiredFields = ["club_id", "name", "price"];
        foreach($requiredFields as $field) {
            if(empty($data[$field])) {
                $this->back([
                    "tipo" => "error",
                    "mensagem" => "Campo {$field} é obrigatório"
                ]);
                return;
            }
        }

        // Verificar se o clube existe
        $club = new Club();
        $clubData = $club->selectById($data["club_id"]);

        if(!$clubData) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "Clube não encontrado"
            ]);
            return;
        }

        $product = new Product(
            null,
            $data["club_id"],
            $data["name"],
            $data["description"] ?? null,
            (float)$data["price"],
            (int)($data["stock"] ?? 0),
            !empty($data["category_id"]) ? (int)$data["category_id"] : null,
            $data["fandom"] ?? null,
            $data["rarity"] ?? 'common',
            $data["sku"] ?? null,
            isset($data["is_physical"]) ? (bool)$data["is_physical"] : true,
            isset($data["subscription_only"]) ? (bool)$data["subscription_only"] : false,
            !empty($data["weight_grams"]) ? (int)$data["weight_grams"] : null,
            $data["dimensions_cm"] ?? null,
            $data["image_url"] ?? null
        );

        $insertProduct = $product->insert();

        if(!$insertProduct){
            $this->back([
                "tipo" => "error",
                "mensagem" => $product->getMessage()
            ]);
            return;
        }

        $this->back([
            "tipo" => "success",
            "mensagem" => "Produto cadastrado com sucesso!",
            "product_id" => $insertProduct
        ]);
    }

    public function updateProduct(array $data)
    {
        if(empty($data["id"])) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "ID do produto é obrigatório"
            ]);
            return;
        }

        // Verificar se o produto existe
        $products = new Product();
        $productData = $products->selectById($data["id"]);

        if(!$productData) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "Produto não encontrado"
            ]);
            return;
        }

        // Validar campos obrigatórios
        if(empty($data["name"])) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "Nome do produto é obrigatório"
            ]);
            return;
        }

        if(empty($data["price"]) || $data["price"] < 0) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "Preço é obrigatório e deve ser maior que zero"
            ]);
            return;
        }

        $product = new Product(
            $data["id"],
            $productData->club_id,
            $data["name"],
            $data["description"] ?? $productData->description,
            (float)$data["price"],
            isset($data["stock"]) ? (int)$data["stock"] : $productData->stock,
            isset($data["category_id"]) ? (int)$data["category_id"] : $productData->category_id,
            $data["fandom"] ?? $productData->fandom,
            $data["rarity"] ?? $productData->rarity,
            $data["sku"] ?? $productData->sku,
            isset($data["is_physical"]) ? (bool)$data["is_physical"] : $productData->is_physical,
            isset($data["subscription_only"]) ? (bool)$data["subscription_only"] : $productData->subscription_only,
            isset($data["weight_grams"]) ? (int)$data["weight_grams"] : $productData->weight_grams,
            $data["dimensions_cm"] ?? $productData->dimensions_cm,
            $data["image_url"] ?? $productData->image_url,
            isset($data["is_active"]) ? (bool)$data["is_active"] : $productData->is_active
        );

        if(!$product->update()){
            $this->back([
                "tipo" => "error",
                "mensagem" => $product->getMessage()
            ]);
            return;
        }

        $this->back([
            "tipo" => "success",
            "mensagem" => $product->getMessage(),
            "product" => [
                "id" => $product->getId(),
                "name" => $product->getName(),
                "description" => $product->getDescription(),
                "price" => $product->getPrice(),
                "stock" => $product->getStock(),
                "is_active" => $product->getIsActive()
            ]
        ]);
    }

    public function getProductById(array $data)
    {
        if(empty($data["id"])) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "ID do produto é obrigatório"
            ]);
            return;
        }

        $products = new Product();
        $product = $products->selectById($data["id"]);

        if(!$product || !$product->is_active) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "Produto não encontrado"
            ]);
            return;
        }

        $this->back([
            "tipo" => "success",
            "mensagem" => "Dados do produto",
            "product" => $product
        ]);
    }

    public function updateStock(array $data)
    {
        $this->auth();

        if(empty($data["id"]) || !isset($data["stock"])) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "ID do produto e quantidade em estoque são obrigatórios"
            ]);
            return;
        }

        // Verificar se o produto existe e pertence a um clube do usuário
        $products = new Product();
        $productData = $products->selectById($data["id"]);

        if(!$productData) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "Produto não encontrado"
            ]);
            return;
        }

        // Verificar se o clube do produto pertence ao usuário autenticado
        $club = new Club();
        $clubData = $club->selectById($productData->club_id);

        if(!$clubData || $clubData->user_id != $this->userAuth->id) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "Você não tem permissão para atualizar o estoque deste produto"
            ]);
            return;
        }

        $product = new Product($data["id"]);
        
        if(!$product->updateStock((int)$data["stock"])){
            $this->back([
                "tipo" => "error",
                "mensagem" => $product->getMessage()
            ]);
            return;
        }

        $this->back([
            "tipo" => "success",
            "mensagem" => $product->getMessage(),
            "new_stock" => (int)$data["stock"]
        ]);
    }

    public function deleteProduct(array $data)
    {
        if(empty($data["id"])) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "ID do produto é obrigatório"
            ]);
            return;
        }

        // Verificar se o produto existe
        $products = new Product();
        $productData = $products->selectById($data["id"]);

        if(!$productData) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "Produto não encontrado"
            ]);
            return;
        }

        // Hard delete - remover completamente do banco
        $product = new Product($data["id"]);

        if(!$product->delete()){
            $this->back([
                "tipo" => "error",
                "mensagem" => $product->getMessage()
            ]);
            return;
        }

        $this->back([
            "tipo" => "success",
            "mensagem" => "Produto removido com sucesso!"
        ]);
    }
}
