<?php

namespace Source\App\Api;

use Source\Core\JWTToken;
use Source\Models\User;

class Users extends Api
{
    public function __construct()
    {
        parent::__construct();
    }

    public function listUsers()
    {
        $user = new User();
        $this->call(200, "success", "Lista de usuários recuperada", "success")->back($user->selectAll());
    }

    public function insertUser(array $data)
    {
        $idType = $data["idType"] ?? null;

        $user = new User(
            null,
            $idType,
            $data["name"],
            $data["email"],
            $data["password"],
            $data["photo"] ?? null
        );

        $insert = $user->insert();

        if (!$insert) {
            $this->call(400, "error", $user->getMessage() ?? "Erro na requisição", "error")->back();
            return;
        }

        $this->call(201, "success", "Usuário cadastrado com sucesso", "success")->back([
            "user" => [
                "id" => $insert,
                "idType" => $user->getIdType(),
                "name" => $user->getName(),
                "email" => $user->getEmail(),
                "photo" => $user->getPhoto()
            ]
        ]);
    }

    public function loginUser(array $data)
    {
        $user = new User();

        if (!$user->login($data["email"], $data["password"])) {
            $this->call(401, "error", $user->getMessage() ?? "Credenciais inválidas", "error")->back();
            return;
        }

        $token = new JWTToken();
        $this->call(200, "success", $user->getMessage(), "success")->back([
            "user" => [
                "id" => $user->getId(),
                "idType" => $user->getIdType(),
                "name" => $user->getName(),
                "email" => $user->getEmail(),
                "photo" => $user->getPhoto(),
                "token" => $token->create([
                    "id" => $user->getId(),
                    "name" => $user->getName(),
                    "email" => $user->getEmail(),
                    "idType" => $user->getIdType()
                ])
            ]
        ]);
    }

    public function updateUser(array $data)
    {
        if (!$this->userAuth) {
            $this->call(401, "error", "Você não pode estar aqui..", "error")->back();
            return;
        }

        $user = new User(
            $this->userAuth->id,
            $data["idType"] ?? $this->userAuth->idType,
            $data["name"] ?? null,
            $data["email"] ?? null,
            null,
            $data["photo"] ?? null
        );

        if (!$user->update()) {
            $this->call(400, "error", $user->getMessage(), "error")->back();
            return;
        }

        $this->call(200, "success", $user->getMessage(), "success")->back([
            "user" => [
                "id" => $user->getId(),
                "idType" => $user->getIdType(),
                "name" => $user->getName(),
                "email" => $user->getEmail(),
                "photo" => $user->getPhoto()
            ]
        ]);
    }

    public function setPassword(array $data)
    {
        $this->auth();

        if (!$this->userAuth) {
            $this->call(401, "error", "Você não pode estar aqui..", "error")->back();
            return;
        }

        $user = new User($this->userAuth->id);

        if (!$user->updatePassword($data["password"], $data["newPassword"], $data["confirmNewPassword"])) {
            $this->call(400, "error", $user->getMessage(), "error")->back();
            return;
        }

        $this->call(200, "success", $user->getMessage(), "success")->back();}
}