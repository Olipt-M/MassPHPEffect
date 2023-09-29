<?php
  class Character
  {
    private int $id;
    private string $name;
    private int $puissance;
    private array $attacks;
    private string $type;
    private int $health = 100;

    public function __construct(int $id, string $name, int $puissance, array $attacks, string $type)
    {
      $this->id = $id;
      $this->name = $name;
      $this->puissance = $puissance;
      $this->attacks = $attacks;
      $this->type = $type;
    }

    public function getName() : string
    {
      return $this->name;
    }

    public function getID() : string
    {
      return $this->id;
    }

    public function getPuissance() : string
    {
      return $this->puissance;
    }

    public function getType() : string
    {
      return $this->type;
    }

    public function getAttacksList() : array
    {
      return $this->attacks;
    }

    public function getHealth() : int
    {
      return $this->health;
    }

    public function setHealth(int $damage) : int
    {
      return $this->health -= $damage;
    }
  }
?>