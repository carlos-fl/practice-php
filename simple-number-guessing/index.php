<?php
require_once "game.php";

define("MAX_TRIES", 3);
define("MAX_VALUE", 200);
define("MIN_VALUE", 0);

function main() {
  $game = new Game(MAX_TRIES, MIN_VALUE, MAX_VALUE);
  $game->init();
}

main();

?>