<?php
  class Character
  {
    private int $id;
    private string $name;
    private int $puissance;
    private array $attacks;
    private string $type;

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

    // public function getAttackName() : string
    // {
    //   return $this->name;
    // }

    // public function getAtatckDamage() : int
    // {
    //   return $this->name;
    // }
  }
?>