<?php

namespace Fredde\Dice;

class Turn
{
    /**
     * @var int $value   Value of current turn
     * @var array $serie Series of rolls
     */
    private $value;
    private $serie = [];

    /**
     * Constructor to initiate the object with current game settings,
     * if available.
     *
     */
    public function __construct(int $value = 0)
    {
        $this->value = $value;
    }

    /**
     * Check hand.
     *
     * @return void
     */
    public function turnRoll()
    {
        $hand = new Hand();
        $hand->handRoll();
        $this->serie = array_merge($this->serie, $hand->handSerie());

        if ($hand->handValue() == 0) {
            $this->value = 0;
        } else {
            $this->value += $hand->handValue();
        }
    }

    /**
     * Reset turn value.
     *
     * @return void
     */
    public function turnReset()
    {
        $this->value = 0;
    }

    /**
     * Retrun value.
     *
     * @return int Hand value.
     */
    public function turnValue()
    {
        return $this->value;
    }

    /**
     * Retrun serie.
     *
     * @return array Hand serie.
     */
    public function turnSerie()
    {
        return $this->serie;
    }
}
