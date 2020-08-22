<?php

namespace Fredde\Dice;

class Hand
{
    /**
     * @var int $number  Number of dices.
     * @var int $value   Value of rolled dices
     * @var array $serie Series of dice values
     */
    private $number;
    private $value;
    private $serie = [];

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Use 5 dice if no value is sent in.
     *
     * @param int $number Number of dice.
     */
    public function __construct(int $number = 3)
    {
        $this->number = $number;
    }

    /**
     * Roll dices.
     *
     * @return void
     */
    public function handRoll()
    {
        $dice = new Dice();

        for ($i = 0; $i < $this->number; $i++) {
            $dice->diceRoll();
            $this->serie[] = $dice->diceValue();
        }

        for ($i = 0; $i < $this->number; $i++) {
            if ($this->serie[$i] == 1) {
                $this->value = 0;
                break;
            } else {
                $this->value += $this->serie[$i];
            }
        }
    }

    /**
     * Retrun value.
     *
     * @return int Dices value.
     */
    public function handValue()
    {
        return $this->value;
    }

    /**
     * Retrun serie.
     *
     * @return array returns serie.
     */
    public function handSerie()
    {
        return $this->serie;
    }
}
