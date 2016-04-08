<?php

use App\Model\Message as Message;

class CommitTest extends \PHPUnit_Framework_TestCase
{
  private $hash = "eef21272f08906e44c681b2820c88713";

  private $message = "Do things better, faster, stronger";

  public function testMessage()
  {
    $message = new Message();

    $this->assertInstanceOf('App\Model\Message', $message);

  }

  public function testNewMessage()
  {
    $message = new Message($this->message);

    $this->assertInstanceOf('App\Model\Message', $message);

    $this->assertEquals($this->message, $message->message);
    $this->assertEquals($this->hash, $message->hash);
  }

  public function testSetMessage()
  {
    $message = new Message();

    $message->setMessage($this->message);

    $this->assertInstanceOf('App\Model\Message', $message);

    $this->assertEquals($this->message, $message->message);
    $this->assertEquals($this->hash, $message->hash);
  }

}
