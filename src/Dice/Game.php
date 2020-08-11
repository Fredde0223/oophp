<?php

namespace Fredde\Dice;

class Game
{
    /**
     * @var int $score      player's score
     * @var int $compScore  computer score
     */
    private $turnScore;
    private $score;
    private $compTurnScore;
    private $compScore;

    /**
     * Constructor to initiate the object with current game settings,
     * if available.
     *
     */
    public function __construct(int $turnScore = 0, int $score = 0, int $compScore = 0)
    {
        $this->turnScore = $turnScore;
        $this->score = $score;
        $this->compScore = $compScore;
    }

    /**
     * roll dice.
     *
     * @return int turn value
     */
    public function gameRoll()
    {
        $turn = new Turn();
        $turn->turnRoll();

        if ($turn->turnValue() == 0) {
            $this->turnScore = 0;
            $this->compTurn();
            return $turn->turnValue();
        } else {
            $this->turnScore += $turn->turnValue();
            return $turn->turnValue();
        }
    }

    /**
     * Retrun score.
     *
     * @return int turn score.
     */
    public function turnScore()
    {
        return $this->turnScore;
    }

    /**
     * End turn.
     *
     * @return void
     */
    public function endTurn()
    {
        $this->score += $this->turnScore;
        $this->turnScore = 0;
        $this->compTurn();
    }

    /**
     * Computer turn.
     *
     * @return void
     */
    public function compTurn()
    {
        $compTurn = new Turn();

        for ($i = 0; $i < 2; $i++) {
            $compTurn->turnRoll();

            if ($compTurn->turnValue() == 0) {
                $this->compTurnScore = 0;
                break;
            } else {
                $this->compTurnScore += $compTurn->turnValue();
                $compTurn->turnReset();
            }
        }
        $this->compScore += $this->compTurnScore;
        $this->compTurnScore = 0;
    }

    /**
     * Retrun score.
     *
     * @return int score.
     */
    public function score()
    {
        return $this->score;
    }

    /**
     * Retrun computer score.
     *
     * @return int computer score.
     */
    public function compScore()
    {
        return $this->compScore;
    }

    /**
     * Return if winner.
     *
     * @return string winner.
     */
    public function checkWinner()
    {
        if ($this->score >= 100 && $this->compScore >= 100) {
            return "IT'S A DRAW";
        } elseif ($this->score >= 100) {
            return "YOU WIN";
        } elseif ($this->compScore >= 100) {
            return "COMPUTER WINS";
        }
    }
}
