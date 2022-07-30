<?php

  require_once __DIR__ . "/Database.php";
  require_once __DIR__ . "/Company.php";

  class Transport extends Database {

    public $price = 0;
    public $start_address = '';
    public $finish_address = '';
    public $addresses = '';
    public $company = '';

    function __construct(
      $price = 0,
      $start_address = '',
      $finish_address = '',
      $addresses = '',
      $company = '',
    ) {
      parent::__construct();

      $this->price = $price;
      $this->start_address = $start_address;
      $this->finish_address = $finish_address;
      $this->addresses = $addresses;

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

    public function getTransport($id) {

      $sql = "SELECT * FROM transports WHERE id = " . $id;

      $response = $this->request($sql);

      return $response->fetch_all(MYSQLI_ASSOC)[0];
    }

    public function getTransportByStartAddress($address) {

      $sql = "SELECT * FROM transports WHERE start_address LIKE '%".$address."%'";

      $response = $this->request($sql);

      return $response->fetch_all(MYSQLI_ASSOC);
    }

    public function getTransportByFinishAddress($address) {

      $sql = "SELECT * FROM transports WHERE finish_address LIKE '%".$address."%'";

      $response = $this->request($sql);

      return $response->fetch_all(MYSQLI_ASSOC);
    }

    public function getTransportByAddresses($address) {

      $sql = "SELECT * FROM transports WHERE addresses LIKE '%".$address."%'";

      $response = $this->request($sql);

      return $response->fetch_all(MYSQLI_ASSOC);
    }

    public function getTransports() {

      $sql = "SELECT * FROM transports";

      $response = $this->request($sql);

      return $response->fetch_all(MYSQLI_ASSOC);
    }

    public function createTransport() {
      $sql = "INSERT INTO transports (price, start_address, finish_address, addresses, company_id) values ('".$this->price."', '".$this->start_address."', '".$this->finish_address."', '".$this->addresses."', '".$this->company."');";

      $this->request($sql);

      return $this->getTransport($this->connection->insert_id);
    }

    public function updateTransport($id) {
      $sql = "UPDATE transports SET price = '".$this->price."', start_address = '".$this->start_address."', finish_address = '".$this->finish_address."', addresses = '".$this->addresses."', company_id = '".$this->company."' WHERE id = " . $id;

      $this->request($sql);

      return $this->getTransport($id);
    }

    public function deleteTransport($id) {
      $sql = "DELETE FROM transports WHERE id = " . $id;

      $this->request($sql);

      return true;
    }
  }