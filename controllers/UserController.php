<?php

  require_once __DIR__ . "/../models/User.php";

  class UserController {
    public function find($id) {
      $user = new User();

      $response = $user->getUser($id);

      echo json_encode($response);
    }

    public function get() {
      $user = new User();

      $response = $user->getUsers();

      echo json_encode($response);
    }

    public function create($data) {
      $user = new User(
        $data['fullname'],
        $data['email'],
        $data['password'],
      );

      $response = $user->createUser();

      echo json_encode($response);
    }

    public function update($data) {
      $user = new User();

      $user = $user->getUser($data['id']);

      $user = new User(
        isset($data['fullname']) ? $data['fullname'] : $user['fullname'],
        isset($data['email']) ? $data['email'] : $user['email'],
        isset($data['password']) ? $data['password'] : $user['password'],
        isset($data['password']) ? true : false
      );

      $response = $user->updateUser($data['id']);

      echo json_encode($response);
    }

    public function delete($id) {
      $user = new User();

      $user = $user->deleteUser($id);

      echo json_encode(array( "deleted" => true ));
    }
  }