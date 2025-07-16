<?php

namespace Source\Models;

use PDOException;
use Source\Core\Connect;
use Source\Core\Model;

class User extends Model {
    private $id;
    private $idType;
    private $name;
    private $email;
    private $password;
    private $photo;
    private $message;

    public function __construct(
        int $id = null,
        int $idType = null,
        string $name = null,
        string $email = null,
        string $password = null,
        string $photo = null
    )
    {
        $this->id = $id;
        $this->idType = $idType;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->photo = $photo;
        $this->entity = "users";
    }

    // Getters e Setters
    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): void { $this->id = $id; }

    public function getIdType(): ?int { return $this->idType; }
    public function setIdType(?int $idType): void { $this->idType = $idType; }

    public function getName(): ?string { return $this->name; }
    public function setName(?string $name): void { $this->name = $name; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(?string $email): void { $this->email = $email; }

    public function getPassword(): ?string { return $this->password; }
    public function setPassword(?string $password): void { $this->password = $password; }

    public function getPhoto(): ?string { return $this->photo; }
    public function setPhoto(?string $photo): void { $this->photo = $photo; }

    public function getMessage(): ?string { return $this->message; }

    public function insert(): ?int
    {
        $conn = Connect::getInstance();

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->message = "E-mail inválido!";
            return false;
        }

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(":email", $this->email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $this->message = "E-mail já cadastrado!";
            return false;
        }

        $this->password = password_hash($this->password, PASSWORD_DEFAULT);


        $query = "INSERT INTO users (idType, name, email, password, photo) 
                VALUES (:idType, :name, :email, :password, :photo)";
        $stmt = $conn->prepare($query);
        $idType = $this->idType ?? 3;
        $stmt->bindParam(":idType", $idType);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":photo", $this->photo);

        try {
            $stmt->execute();
            $this->message = "Usuário cadastrado com sucesso!";
            return $conn->lastInsertId();
        } catch (PDOException $e) {
            $this->message = "Erro ao cadastrar usuário: " . $e->getMessage();
            return false;
        }
    }

    public function login(string $email, string $password): bool
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $conn = Connect::getInstance();
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch();

        if (!$result) {
            $this->message = "E-mail não cadastrado!";
            return false;
        }

        if (!password_verify($password, $result->password)) {
            $this->message = "Senha incorreta!";
            return false;
        }

        $this->id = $result->id;
        $this->idType = $result->idType;
        $this->name = $result->name;
        $this->email = $result->email;
        $this->photo = $result->photo;
        $this->message = "Usuário logado com sucesso!";
        return true;
    }

    public function update(): bool
    {
        $conn = Connect::getInstance();

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->message = "E-mail inválido!";
            return false;
        }

        $query = "SELECT * FROM users WHERE email = :email AND id != :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $this->message = "E-mail já cadastrado!";
            return false;
        }

        $query = "UPDATE users 
                  SET idType = :idType, name = :name, email = :email, photo = :photo 
                  WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":idType", $this->idType);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":photo", $this->photo);
        $stmt->bindParam(":id", $this->id);

        try {
            $stmt->execute();
            $this->message = "Usuário atualizado com sucesso!";
            return true;
        } catch (PDOException $exception) {
            $this->message = "Erro ao atualizar: " . $exception->getMessage();
            return false;
        }
    }

    public function updatePassword(string $currentPassword, string $newPassword, string $confirmPassword): bool
    {
        $conn = Connect::getInstance();

        $stmt = $conn->prepare("SELECT password FROM users WHERE id = :id");
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $result = $stmt->fetch();

        if (!$result || !password_verify($currentPassword, $result->password)) {
            $this->message = "Senha atual incorreta!";
            return false;
        }

        if ($newPassword !== $confirmPassword) {
            $this->message = "As senhas não conferem!";
            return false;
        }

        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->bindParam(":password", $newPasswordHash);
        $stmt->bindParam(":id", $this->id);

        try {
            $stmt->execute();
            $this->message = "Senha atualizada com sucesso!";
            return true;
        } catch (PDOException $exception) {
            $this->message = "Erro ao atualizar senha: " . $exception->getMessage();
            return false;}}
}