<?php

class Player {
  private int $lifes;
  private string $name;

  public function __construct(string $userName, int $tries) {
    $this->name = $userName;
    $this->lifes = $tries;
  }

  public function getLifes(): int {
    return $this->lifes;
  }

  public function getName(): string {
    return $this->name;
  }

  public function canPlay(): bool {
    return $this->lifes > 0;
  }

  private function readUserGuessedNumber(): int {
    $userInput = (int) trim(fgets(STDIN)); 
    return $userInput;
  }

  public function setLifesAfterFail(): void {
    if ($this->lifes > 0) {
      $this->lifes--;
    }
  }

  public function setLifes(int $totalLifes): void {
    $this->lifes = $totalLifes;
  }

  public function getUserInput(): int {
    return $this->readUserGuessedNumber();
  }

}

?>