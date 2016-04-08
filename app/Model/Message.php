<?php
/**
* Message Model
*
* @author Chris Baptista
*/

namespace App\Model;

/**
* Message Object Model
*
* @package App\Model;
*
*/
class Message
{
  /**
   * Message Hash
   * @var string $hash
   */
  public $hash;

  /**
   * Commit Message
   * @var string $message
   */
  public $message;

  /**
   * Class Constructor
   *
   * @param string $message
   */
  public function __construct( $message) {
    $this->setMessage($message);
  }

  /**
   * Set Message
   *
   * @param string $message Commit Message
   */
  public function setMessage( $message) {
    $this->message = $message;

    $this->setHash();
  }

  /**
   * Set Message Hash
   */
  private function setHash() {
    $this->hash = hash('md5', $this->message);
  }
}
