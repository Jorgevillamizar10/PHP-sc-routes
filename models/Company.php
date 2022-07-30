<?php

  require_once __DIR__ . "/Database.php";

  class Company extends Database {

    public $name = '';


    function __construct(
      $name = '',
    ) {
      parent::__construct();

      $this->name = $name;
    }

    public function getCompany($id) {

      $sql = "SELECT * FROM companies WHERE id = " . $id;

      $response = $this->request($sql);

      return $response->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function getCompanyByName($name) {

      $sql = "SELECT * FROM companies WHERE name = '".$name."'";

      $response = $this->request($sql);

      return $response->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function getCompanies() {

      $sql = "SELECT * FROM companies";

      $response = $this->request($sql);

      return $response->fetch_all(MYSQLI_ASSOC);
    }

    public function createCompany() {
      $sql = "INSERT INTO companies (name) values ('".$this->name."');";

      $this->request($sql);

      return $this->getCompany($this->connection->insert_id);
    }

    public function updateCompany($id) {
      $sql = "UPDATE companies SET name = '".$this->name."' WHERE id = " . $id;

      $this->request($sql);

      return $this->getCompany($id);
    }

    public function deleteCompany($id) {
      $sql = "DELETE FROM companies WHERE id = " . $id;

      $this->request($sql);

      return true;
    }
  }