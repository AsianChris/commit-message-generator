<?php
namespace App\Model;

class Message
{
  public $hash;

  public $message;

  public function __construct($message) {
    $this->setMessage($message);
  }

  public function setMessage($message) {
    $this->message = $message;

    $this->setHash();
  }

  private function setHash() {
    $this->hash = hash('md5', $this->message);
  }
}
