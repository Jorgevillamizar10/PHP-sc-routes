<?php

  require_once __DIR__ . "/../models/Transport.php";

  class TransportController {
    public function find($id) {
      $transport = new Transport();

      $response = $transport->getTransport($id);

      echo json_encode($response);
    }

    public function get() {
      $transport = new Transport();

      $response = $transport->getTransports();

      echo json_encode($response);
    }

    public function filter($field, $value) {
      $transport = new Transport();

      switch ($field) {
        case 'start_address':
          $response = $transport->getTransportByStartAddress($value);
          break;
        case 'finish_address':
          $response = $transport->getTransportByFinishAddress($value);
          break;
        case 'addresses':
          $response = $transport->getTransportByAddresses($value);
          break;
        default:
          $response = [];
      }

      echo json_encode($response);
    }

    public function create($data) {
      $transport = new Transport(
        $data['price'],
        $data['start_address'],
        $data['finish_address'],
        json_encode($data['addresses']),
        isset($data['company']) ? $data['company'] : null,
      );

      $response = $transport->createTransport();

      echo json_encode($response);
    }

    public function update($data) {
      $transport = new Transport();

      $transport = $transport->getTransport($data['id']);

      $transport = new Transport(
        isset($data['price']) ? $data['price'] : $transport['price'],
        isset($data['start_address']) ? $data['start_address'] : $transport['start_address'],
        isset($data['finish_address']) ? $data['finish_address'] : $transport['finish_address'],
        isset($data['addresses']) ? json_encode($data['addresses']) : $transport['addresses'],
        isset($data['company']) ? $data['company'] : $transport['company'],
      );

      $response = $transport->updateTransport($data['id']);

      echo json_encode($response);
    }

    public function delete($id) {
      $transport = new Transport();

      $transport = $transport->deleteTransport($id);

      echo json_encode(array( "deleted" => true ));
    }
  }