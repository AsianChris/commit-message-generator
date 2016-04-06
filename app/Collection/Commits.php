<?php
namespace App\Collection;

use App\Model\Commit;

class Commits
{
  private static $dataFile;

  private static $commits;

  public static function init() {
    self::$dataFile = dirname(__FILE__) . '/../../data/commit_messages.txt';

    self::openFile();
  }

  public static function getCommits() {
    return self::$commits;
  }

  public static function getRandomCommit() {
    $min = 0;
    $max = count(self::$commits);

    $randomIndex = rand($min, $max);

    return self::$commits[$randomIndex];
  }

  public static function getCommit($hash) {
    $return = null;

    foreach(self::$commits as $commit) {
      if($commit->hash === $hash) {
        $return = $commit;
        break;
      }
    }

    return $return;
  }

  private static function openFile() {
    $myfile = fopen( self::$dataFile, "r") or die("Unable to open file!");

    self::$commits = [];

    while(!feof($myfile)) {
      $msg = fgets($myfile);
      $msg = str_replace(array("\r", "\n"), '', $msg);

      if($msg !== '') {

        $commit = new Commit();
        $commit->message = $msg;
        $commit->hash = hash('md5', $msg);

        self::$commits[] = $commit;
      }

    }

    fclose($myfile);
  }
}


Commits::init();
