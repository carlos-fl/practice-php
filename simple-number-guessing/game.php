<?php
require_once "user.php";

class Game {
  private int $maxTries;
  private int $randomValue;
  private int $minValue;
  private int $maxValue;

  public function __construct(int $tries, int $min, int $max) {
    $this->maxTries = $tries;
    $this->minValue = $min;
    $this->maxValue = $max;
  }

  public function init(): void {
    // set the random value
    $num = rand($this->minValue, $this->maxValue);
    $this->setRandomValue($num);
    // read player name
    $playerName = $this->readPlayerInfo();
    // create player
    $triesAccepted = $this->maxTries;
    $player = new Player($playerName, $triesAccepted);
    
    $this->play($player); 
  }

  private function play(Player $player) {
    while ($player->canPlay()) {
      $this->showMessage($this->minValue, $this->maxValue);
      $playerInput = $player->getUserInput();
      if ($playerInput == $this->randomValue) {
        $this->printWinMessage($player->getName());
        $this->setNextSteps($player);
      } elseif ($player->getLifes() == 1) {
        $this->printLooseMessage();
        $this->setNextSteps($player);
      } else {
        $player->setLifesAfterFail();
      }
    }
    $this->printGoodByMessage($player->getName());
  }

  private function printGoodByMessage($name): void {
    $capitalizeName = strtoupper($name);
    echo "THANKS FOR PLAYING $capitalizeName.. HAVE A GOOD DAY!\n";
  }

  private function setNextSteps(Player $player): void {
    $this->showMenu();
    $option = $this->getPlayerSelection();
    if ($option == 1) {
      $this->restart($player);
    } else {
      $this->end($player);
    }
  }

  private function end(Player $player): void {
    $player->setLifes(0);
  }

  private function setRandomValue(int $randomNumber): void {
    $this->randomValue = $randomNumber;
  }

  private function showMessage(int $minValue, int $maxValue): void {
    echo "Choose a number between $minValue and $maxValue: ";
  }

  private function showMenu(): void {
    echo "What do you want to do next? \n1.Keep playing\n2.Stop playing\n";
  }

  private function getPlayerSelection(): int {
    $selectedOption = (int) trim(fgets(STDIN));
    return $selectedOption;
  }

  private function printWinMessage($name): void {
    echo "CONGRATS $name, YOU HAVE WON!!!!\n";
  }

  private function printLooseMessage(): void {
    echo "YOU LOST :( the number was $this->randomValue. Try Again\n";
  }

  private function readPlayerInfo(): string {
    // only needs player name
    echo "Enter player name: ";
    $name = trim(fgets(STDIN));
    return $name;
  }

  private function restart(Player $player): void {
    $player->setLifes($this->maxTries);
    $num = rand($this->minValue, $this->maxValue);
    $this->setRandomValue($num);
  }

}

?>