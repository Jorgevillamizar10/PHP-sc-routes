<?php

  require_once __DIR__ . "/../controllers/TransportController.php";

  header('Content-Type: application/json');

  $controller = new TransportController();

  switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
      if (isset($_GET['id'])) {
        $controller->find($_GET['id']);
      } else if (isset($_GET['start_address'])) {
        $controller->filter('start_address', $_GET['start_address']);
      } else if (isset($_GET['finish_address'])) {
        $controller->filter('finish_address', $_GET['finish_address']);
      } else if (isset($_GET['addresses'])) {
        $controller->filter('addresses', $_GET['addresses']);
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
