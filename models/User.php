<?php

  require_once __DIR__ . "/Database.php";

  class User extends Database {

    public $fullname = '';
    public $email = '';
    public $password = '';


    function __construct(
      $fullname = '',
      $email = '',
      $password = '',
      $encrypt_password = true,
    ) {
      parent::__construct();

      $this->fullname = $fullname;
      $this->email = $email;
      $this->password = $encrypt_password ? password_hash($password, PASSWORD_DEFAULT) : $password;
    }

    public function getUser($id) {

      $sql = "SELECT * FROM users WHERE id = " . $id;

      $response = $this->request($sql);

      return $response->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function getUsers() {

      $sql = "SELECT * FROM users";

      $response = $this->request($sql);

      return $response->fetch_all(MYSQLI_ASSOC);
    }

    public function createUser() {
      $sql = "INSERT INTO users (fullname, email, password) values ('".$this->fullname."', '".$this->email."', '".$this->password."');";

      $this->request($sql);

      return $this->getUser($this->connection->insert_id);
    }

    public function updateUser($id) {
      $sql = "UPDATE users SET fullname = '".$this->fullname."', email = '".$this->email."', password = '".$this->password."' WHERE id = " . $id;

      $this->request($sql);

      return $this->getUser($id);
    }

    public function deleteUser($id) {
      $sql = "DELETE FROM users WHERE id = " . $id;

      $this->request($sql);

      return true;
    }
  }