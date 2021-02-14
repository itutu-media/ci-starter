<?php

namespace IM\CI\Controllers;

use CodeIgniter\RESTful\ResourceController;

class ApiController extends ResourceController
{
  protected $format    = 'json';

  protected function render($status = TRUE, $message = 'Connection Successfully', $data = NULL, $additional = [])
  {
    $this->data = [
      'status'  => $status,
      'message' => $message,
      'data'    => $data
    ];
    
    if ($additional)
      $this->data = array_merge($this->data, $additional);

    return $this->respond($this->data);
  }
}
