<?php

namespace Fredde\Dice;

class Hand
{
    /**
     * @var int $number  Number of dices.
     * @var int $value   Value of rolled dices
     */
    private $number;
    private $value;

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

            if ($dice->diceValue() == 1) {
                $this->value = 0;
                break;
            } else {
                $this->value += $dice->diceValue();
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
}
