<?php
  class Database{

    private $db_host = "mysql";          
    private $db_name = "jorge_transport";
    private $db_user = "jorge";               
    private $db_password = "jorge";     

    //Variable que guardara la conexion a la Base de Datos
    protected $connection = null;

    public function __construct() {
      try {
        $this->connection = new mysqli($this->db_host, $this->db_user, $this->db_password, $this->db_name);
         
        if ( mysqli_connect_errno()) {
            throw new Exception("Could not connect to database.");   
        }
      } catch (Exception $e) {
        die("¡Error!: " . $e->getMessage());
      }
    }

    public function request($sql = "") {
      try {
        $query = $this->connection->prepare($sql);

        $query->execute();

        $result = $query->get_result();

        $query->close();

        return $result;
      } catch(Exception $e) {
        throw new Exception($e->getMessage());
      }
    }
  }