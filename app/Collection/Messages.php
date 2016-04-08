<?php
/**
* Messages Collection
*
* @author Chris Baptista
*/

namespace App\Collection;

use App\Model\Message;

/**
* Messages Collection
*
* @package App\Collection;
*/
class Messages
{
  /**
   * Data Directory
   * @var string $dataDir
   */
  private static $dataDir;

  /**
   * Commit Messages
   * @var array $messages
   */
  private static $messages;

  /**
   * Static Class Initialization
   */
  public static function init() {
    self::$dataDir =  dirname(__FILE__) . '/../../data/';

    self::setMessages();
  }

  /**
   * Get all Commit Messages
   *
   * @return array
   */
  public static function getMessages() {
    return self::$messages;
  }

  /**
   * Get a Random Commit Message
   *
   * @return Message
   */
  public static function getRandomMessage() {
    $min = 0;
    $max = count(self::$messages) - 1;

    $randomIndex = rand($min, $max);

    return self::$messages[$randomIndex];
  }

  /**
   * Get Commit Message
   *
   * @param string $hash
   *
   * @return Message
   */
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

  /**
   * Set Commit Messages
   */
  private static function setMessages() {
    self::$messages = [];

    $files = scandir(self::$dataDir);

    foreach($files as $file) {
      self::openFile($file);
    }
  }

  /**
   * Open File
   *
   * @param string $file File name
   */
  private static function openFile($file) {
    $myfile = fopen(self::$dataDir.$file, "r") or die("Unable to open file!");

    while(!feof($myfile)) {
      $msg = fgets($myfile);

      $msg = trim( str_replace(array("\r", "\n"), '', $msg) );

      if(!empty($msg)) {
        $message = new Message($msg);

        self::$messages[] = $message;
      }
    }

    fclose($myfile);
  }
}

//  Initialize Messages
Messages::init();
