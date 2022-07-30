<?php

  require_once __DIR__ . "/Database.php";
  require_once __DIR__ . "/Company.php";

  class Comment extends Database {

    public $type = '';
    public $message = '';
    public $name = '';
    public $surname = '';
    public $email = '';
    public $phone = '';
    public $company = 0;

    function __construct(
      $type = '',
      $message = '',
      $name = '',
      $surname = '',
      $email = '',
      $phone = '',
      $company = '',
    ) {
      parent::__construct();

      $this->type = $type;
      $this->message = $message;
      $this->name = $name;
      $this->surname = $surname;
      $this->email = $email;
      $this->phone = $phone;

      if ($company != '') {
        $company_data = new Company();
        $company_data = $company_data->getCompanyByName($company);
        if(isset($company_data['id'])){
          $this->company = $company_data['id'];
        } else {
          $this->company = null;
        }
      } else {
        $this->company = null;
      }      
    }

    public function getComment($id) {

      $sql = "SELECT * FROM comments WHERE id = " . $id;

      $response = $this->request($sql);

      return $response->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function getComments() {

      $sql = "SELECT * FROM comments";

      $response = $this->request($sql);

      return $response->fetch_all(MYSQLI_ASSOC);
    }

    public function createComment() {
      $sql = "INSERT INTO comments (type, message, name, surname, email, phone".(isset($this->company) ? ", company_id" : "").") values ('".$this->type."', '".$this->message."', '".$this->name."', '".$this->surname."', '".$this->email."', '".$this->phone."'".(isset($this->comapny) ? ", '".$this->company."'" : "").");";

      $this->request($sql);

      return $this->getComment($this->connection->insert_id);
    }

    public function updateComment($id) {
      $sql = "UPDATE comments SET type = '".$this->type."', message = '".$this->message."', name = '".$this->name."', surname = '".$this->surname."', email = '".$this->email."', phone = '".$this->phone."', company_id = '".$this->company."' WHERE id = " . $id;

      $this->request($sql);

      return $this->getComment($id);
    }

    public function deleteComment($id) {
      $sql = "DELETE FROM comments WHERE id = " . $id;

      $this->request($sql);

      return true;
    }
  }