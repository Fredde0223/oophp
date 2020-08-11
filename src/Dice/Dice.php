<?php

namespace Fredde\Dice;

class Dice
{
    /**
     * @var int $sides   Sides of a dice.
     * @var int $value   Value of dice.
     */
    private $sides;
    private $value;

    /**
     * Constructor to initiate the object with current game settings,
     * if available. Use 6 sides if no value is sent in.
     *
     * @param int $sides Sides of a dice, default 6 sides.
     */
    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }

    /**
     * Roll dice.
     *
     * @return void
     */
    public function diceRoll()
    {
        $this->value = rand(1, $this->sides);
    }

    /**
     * Retrun value.
     *
     * @return int Dice value.
     */
    public function diceValue()
    {
        return $this->value;
    }
}
