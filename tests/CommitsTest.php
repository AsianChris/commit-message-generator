<?php

use App\Collection\Messages as Messages;
use App\Model\Message as Message;

class CommitsTest extends \PHPUnit_Framework_TestCase
{
  private $hash = "eef21272f08906e44c681b2820c88713";

  private $message = "Do things better, faster, stronger";

  public function testGetMessages()
  {
    $messages = Messages::getMessages();

    $this->assertGreaterThan(1, count($messages));
  }

  public function testGetRandomMessage()
  {
    $message = Messages::getRandomMessage();

    $this->assertInstanceOf('App\Model\Message', $message);
  }

  public function testGetMessage()
  {
    $hash = "eef21272f08906e44c681b2820c88713";
    $expectedMessage = "Do things better, faster, stronger";

    $message = Messages::getMessage($this->hash);

    $this->assertInstanceOf('App\Model\Message', $message);

    $this->assertEquals($this->message, $message->message);
  }
}
