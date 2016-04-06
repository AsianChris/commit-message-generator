<?php
namespace App\Collection;

use App\Model\Commit;

class Commits
{
  private static $dataDir;
  private static $dataFiles;

  private static $commits;

  public static function init() {
    self::$dataDir =  dirname(__FILE__) . '/../../data/';

    self::setCommits();
  }

  public static function getCommits() {
    return self::$commits;
  }

  public static function getRandomCommit() {
    $min = 0;
    $max = count(self::$commits) - 1;

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

  private static function setCommits() {
    self::$commits = [];

    $files = scandir(self::$dataDir);

    foreach($files as $file) {
      self::openFile($file);
    }
  }

  private static function openFile($file) {
    $myfile = fopen(self::$dataDir.$file, "r") or die("Unable to open file!");

    while(!feof($myfile)) {
      $msg = fgets($myfile);

      $msg = str_replace(array("\r", "\n"), '', $msg);

      if(!empty($msg)) {
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
