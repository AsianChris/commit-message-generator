<?php
namespace App\Collection;

use App\Model\Message;

class Messages
{
  private static $dataDir;
  private static $dataFiles;

  private static $messages;

  public static function init() {
    self::$dataDir =  dirname(__FILE__) . '/../../data/';

    self::setMessages();
  }

  public static function getMessages() {
    return self::$messages;
  }

  public static function getRandomMessage() {
    $min = 0;
    $max = count(self::$messages) - 1;

    $randomIndex = rand($min, $max);

    return self::$messages[$randomIndex];
  }

  public static function getMessage($hash) {
    $return = null;

    foreach(self::$messages as $message) {
      if($message->hash === $hash) {
        $return = $message;
        break;
      }
    }

    return $return;
  }

  private static function setMessages() {
    self::$messages = [];

    $files = scandir(self::$dataDir);

    foreach($files as $file) {
      self::openFile($file);
    }
  }

  private static function openFile($file) {
    $myfile = fopen(self::$dataDir.$file, "r") or die("Unable to open file!");

    while(!feof($myfile)) {
      $msg = fgets($myfile);

      $msg = trim( str_replace(array("\r", "\n"), '', $msg) );

      if(!empty($msg)) {
        $message = new Message();
        $message->message = $msg;
        $message->hash = hash('md5', $msg);

        self::$messages[] = $message;
      }

    }

    fclose($myfile);
  }
}


Messages::init();
