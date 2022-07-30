<?php

  require_once __DIR__ . "/../models/Comment.php";

  class CommentController {
    public function find($id) {
      $comment = new Comment();

      $response = $comment->getComment($id);

      echo json_encode($response);
    }

    public function get() {
      $comment = new Comment();

      $response = $comment->getComments();

      echo json_encode($response);
    }

    public function create($data) {
      $comment = new Comment(
        $data['type'],
        $data['message'],
        $data['name'],
        $data['surname'],
        $data['email'],
        $data['phone'],
        isset($data['company']) ? $data['company'] : null,
      );

      $response = $comment->createComment();

      echo json_encode($response);
    }

    public function update($data) {
      $comment = new Comment();

      $comment = $comment->getComment($data['id']);

      $comment = new Comment(
        isset($data['type']) ? $data['type'] : $comment['type'],
        isset($data['message']) ? $data['message'] : $comment['message'],
        isset($data['name']) ? $data['name'] : $comment['name'],
        isset($data['surname']) ? $data['surname'] : $comment['surname'],
        isset($data['email']) ? $data['email'] : $comment['email'],
        isset($data['phone']) ? $data['phone'] : $comment['phone'],
        isset($data['company']) ? $data['company'] : $comment['company'],
      );

      $response = $comment->updateComment($data['id']);

      echo json_encode($response);
    }

    public function delete($id) {
      $comment = new Comment();

      $comment = $comment->deleteComment($id);

      echo json_encode(array( "deleted" => true ));
    }
  }