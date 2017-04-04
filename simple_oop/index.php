<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
spl_autoload_register(function($class_name) {
  $class_name = strtolower($class_name);
  include "class/class_".$class_name . '.php';
});


$mysqli = new mysqli("localhost", "runm17.wi4", "4ykpk3p2", "runm17_wi4_sde_dk");
if ($mysqli->connect_errno) {
  die("Couldn't connect to". $this->mysqli->connect_errno ." ". $this->mysqli->connect_error);
}
if (!$mysqli->set_charset("utf8")) {
  echo printf("Error couldn't load character set utf8: %s\n", $this->mysqli->error);
  exit();
}

try {
echo "<br><h2>Betatester</h2><br>";

$betatester = new Betatester($mysqli);
$betatester->setId(1);
$betatester->getPlayerById();

echo "<pre>";
print_r($betatester);
echo "</pre>";
}
catch (exception $e) {
  echo "An error occured: ".$e->getMessage();
}

try {
  echo "<br><h2>DEVELOPER</h2><br>";

  $developer = new Developer($mysqli);
  $developer->setId(1);
  $developer->getDeveloperById();

  echo "<pre>";
  print_r($developer);
  echo "</pre>";

} catch (exception $e) {
  echo "An error occured: ".$e->getMessage();
}



try {
  echo "<br><h2>Game</h2><br>";

  $game = new Game($mysqli);
  $game->setId(1);
  $game->getGameById();
  echo "<pre>";
  print_r($game);
  echo "</pre>";


} catch (exception $e) {
  echo "An error occured: ".$e->getMessage();
}

 ?>
