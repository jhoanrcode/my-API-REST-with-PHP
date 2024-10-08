<?php

class User extends Database
{
  
  private $pdo;

  public function __construct() {
    $this->pdo = $this->getConnection();
  }

  public function getUsers() {
    try{
        $sql = $this->pdo->prepare("SELECT * FROM users");
        $sql->execute();
        if($sql->rowCount() > 0) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } else{
            return false;
        }
    } catch(PDOException $err) {
        return false;
    }
      
  }

  public function getUsersBy($id) {
    try {
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $sql->execute([$id]);
        if($sql->rowCount() > 0) {
            return $sql->fetch(PDO::FETCH_ASSOC);
        } else{
            return false;
        }
    } catch(PDOException $err) {
        return false;
    }
  }

  public function createUser($data) {
    try {
        $sql = $this->pdo->prepare("INSERT INTO users (name, email, phone, status) VALUES (?, ?, ?, 1)");
        $sql->execute([$data[0], $data[1], $data[2]]);
        return true;
    } catch(PDOException $err) {
        return false;
    }
  }

  public function emailAlreadyExists($email) {
    try {
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $sql->execute([$email]);
        if($sql->rowCount() > 0) { return true; } 
        else{ return false; }
    } catch(PDOException $err) {
        return false;
    }
  }

  public function updateUser($data) {
    try {
        $sql = $this->pdo->prepare("UPDATE users SET name = ?, phone = ?, status = ? WHERE id = ?");
        $sql->execute([$data[0], $data[1], $data[2], $data[3]]);
        if ($sql->rowCount() > 0) { return true; } 
        else { return false; }
    } catch (PDOException $err) {
        return false;
    }
  }

  public function removeUser($data) {
    try {
        $sql = $this->pdo->prepare("DELETE FROM users WHERE id = ?");
        $sql->execute([$data[0]]);
        if ($sql->rowCount() > 0) { return true; } 
        else { return false; }
    } catch (PDOException $err) {
        return false;
    }
  }

}