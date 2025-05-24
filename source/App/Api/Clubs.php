<?php

namespace Source\App\Api;

use Source\Models\Club;

class Clubs extends Api
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getClub()
    {
        $this->auth();

        $clubs = new Club();
        $userClubs = $clubs->selectByUserId($this->userAuth->id);

        $this->back([
            "tipo" => "successo",
            "mensagem" => "Clubes do usuário",
            "clubs" => $userClubs
        ]);
    }

    public function listClubs()
    {
        $clubs = new Club();
        $allClubs = $clubs->selectAll();

        // Filtrar apenas clubes ativos
        $activeClubs = array_filter($allClubs, function($club) {
            return $club->is_active == 1;
        });

        $this->back([
            "tipo" => "successo",
            "mensagem" => "Lista de clubes",
            "clubs" => array_values($activeClubs)
        ]);
    }

    public function createClub(array $data)
    {
        if(in_array("", [$data["club_name"] ?? ""])) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "Nome do clube é obrigatório"
            ]);
            return;
        }

        if(empty($data["user_id"])) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "ID do usuário é obrigatório"
            ]);
            return;
        }

        $club = new Club(
            null,
            $data["user_id"],
            $data["club_name"],
            $data["description"] ?? null
        );

        $insertClub = $club->insert();

        if(!$insertClub){
            $this->back([
                "tipo" => "error",
                "mensagem" => $club->getMessage()
            ]);
            return;
        }

        $this->back([
            "tipo" => "successo",
            "mensagem" => "Clube cadastrado com sucesso!",
            "club_id" => $insertClub
        ]);
    }

    public function updateClub(array $data)
    {
        if(empty($data["id"])) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "ID do clube é obrigatório"
            ]);
            return;
        }

        // Verificar se o clube existe
        $clubs = new Club();
        $clubData = $clubs->selectById($data["id"]);

        if(!$clubData) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "Clube não encontrado"
            ]);
            return;
        }

        if(empty($data["club_name"])) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "Nome do clube é obrigatório"
            ]);
            return;
        }

        $club = new Club(
            $data["id"],
            $clubData->user_id,
            $data["club_name"],
            $data["description"] ?? $clubData->description,
            isset($data["is_active"]) ? (bool)$data["is_active"] : $clubData->is_active
        );

        if(!$club->update()){
            $this->back([
                "tipo" => "error",
                "mensagem" => $club->getMensagem()
            ]);
            return;
        }

        $this->back([
            "tipo" => "successo",
            "mensagem" => $club->getMessage(),
            "club" => [
                "id" => $club->getId(),
                "club_name" => $club->getClubName(),
                "description" => $club->getDescription(),
                "is_active" => $club->getIsActive()
            ]
        ]);
    }

    public function getClubById(array $data)
    {
        if(empty($data["id"])) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "ID do clube é obrigatório"
            ]);
            return;
        }

        $clubs = new Club();
        $club = $clubs->selectById($data["id"]);

        if(!$club || !$club->is_active) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "Clube não encontrado"
            ]);
            return;
        }

        $this->back([
            "tipo" => "successo",
            "mensagem" => "Dados do clube",
            "club" => $club
        ]);
    }

    public function deleteClub(array $data)
    {
        if(empty($data["id"])) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "ID do clube é obrigatório"
            ]);
            return;
        }

        // Verificar se o clube existe
        $clubs = new Club();
        $clubData = $clubs->selectById($data["id"]);

        if(!$clubData) {
            $this->back([
                "tipo" => "error",
                "mensagem" => "Clube não encontrado"
            ]);
            return;
        }

        // Hard delete - remover completamente do banco
        $club = new Club($data["id"]);

        if(!$club->delete()){
            $this->back([
                "tipo" => "error",
                "mensagem" => $club->getMessage()
            ]);
            return;
        }

        $this->back([
            "tipo" => "successo",
            "mensagem" => "Clube removido com sucesso!"
        ]);
    }
}
