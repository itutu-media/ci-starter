<?php

namespace IM\CI\Libraries;

class IM_Message
{
  protected $messageTypes = [
    'primary' => [
      '<div class="alert alert-primary" role="alert">', '</div>'
    ],
    'secondary' =>
    [
      '<div class="alert alert-secondary" role="alert">', '</div>'
    ],
    'success' =>
    [
      '<div class="alert alert-success" role="alert">', '</div>'
    ],
    'danger' =>
    [
      '<div class="alert alert-danger" role="alert">', '</div>'
    ],
    'warning' =>
    [
      '<div class="alert alert-warning" role="alert">', '</div>'
    ],
    'info' =>
    [
      '<div class="alert alert-info" role="alert">', '</div>'
    ],
    'light' =>
    [
      '<div class="alert alert-light" role="alert">', '</div>'
    ],
    'dark' =>
    [
      '<div class="alert alert-dark" role="alert">', '</div>'
    ],
  ];

  public function add(string $messageType, $message, array $attributes = NULL)
  {
    $messages = [];
    if (session('msg') && is_array(session('msg')))
      $messages = session('msg');

    if (is_a($message, 'Exception')) {
      $message = $message->getMessage();
      $messageType = 'danger';
    }

    if (is_array($message)) {
      $strMsg = '<ul>';
      foreach ($message as $msg) {
        $strMsg .= '<li>' . $msg . '</li>';
      }
      $strMsg = '</ul>';
      $message = $strMsg;
    }

    if ((!isset($messages[$messageType]) || !in_array($message, $messages[$messageType])) && is_string($message) && $message) {
      $messages[$messageType][] = $message;
    }
    session()->set('msg', $messages);
  }

  public function get($messageType = NULL, $asArray = FALSE)
  {
    if (is_array($messageType)) {
      foreach ($messageType as $type) {
        $this->get($type, $asArray);
      }
    }

    $messages = [];
    if (session('msg') && is_array(session('msg')))
      $messages = session('msg');

    if (empty($messages))
      return FALSE;

    $output = ($asArray === TRUE) ? [] : '';

    if (is_null($messageType)) {
      foreach ($this->messageTypes as $type => $delimiters) {
        if (array_key_exists($type, $messages)) {
          foreach ($messages[$type] as $message) {
            if ($asArray === TRUE) {
              $output[$type][] = $message;
            } else {
              $output .= $this->messageTypes[$type][0];
              $output .= $message;
              $output .= $this->messageTypes[$type][1];
            }
          }
          $this->clear($type);
        }
      }
    } else {
      if (array_key_exists($messageType, $messages)) {
        foreach ($messages[$messageType] as $message) {
          if ($asArray) {
            $output[] = $message;
          } else {
            $output .= $this->messageTypes[$messageType][0] . $message . $this->messageTypes[$messageType][1];
          }
        }
        $this->clear($messageType);
      }
    }
    return $output;
  }

  public function clear($messageType = null)
  {
    if (!empty($messageType)) {
      $messages = [];
      if (session('msg') && is_array(session('msg'))) {
        $messages = session('msg');
      }

      if (array_key_exists($messageType, $messages)) {
        unset($messages[$messageType]);
        session()->set('msg', $messages);
      }
    } else {
      session()->set('msg', array());
    }
  }
}
