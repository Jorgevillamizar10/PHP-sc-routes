<?php

  require_once __DIR__ . "/../controllers/UserController.php";

  header('Content-Type: application/json');

  $controller = new UserController();

  switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
      if (isset($_GET['id'])) {
        $controller->find($_GET['id']);
      } else {
        $controller->get();
      }
      break;
    case 'POST':
      $body = json_decode(file_get_contents('php://input'), true);
      $controller->create($body);
      break;
    case 'PUT':
      $body = json_decode(file_get_contents('php://input'), true);
      $controller->update($body);
      break;
    case 'DELETE':
      $controller->delete($_GET['id']);
      break;
  }
