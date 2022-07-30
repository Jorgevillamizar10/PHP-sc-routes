<?php

  require_once __DIR__ . "/../models/Company.php";

  class CompanyController {
    public function find($id) {
      $company = new Company();

      $response = $company->getCompany($id);

      echo json_encode($response);
    }

    public function get() {
      $company = new Company();

      $response = $company->getCompanies();

      echo json_encode($response);
    }

    public function create($data) {
      $company = new Company(
        $data['name'],
      );

      $response = $company->createCompany();

      echo json_encode($response);
    }

    public function update($data) {
      $company = new Company();

      $company = $company->getCompany($data['id']);

      $company = new Company(
        isset($data['name']) ? $data['name'] : $company['name'],
      );

      $response = $company->updateCompany($data['id']);

      echo json_encode($response);
    }

    public function delete($id) {
      $company = new Company();

      $company = $company->deleteCompany($id);

      echo json_encode(array( "deleted" => true ));
    }
  }