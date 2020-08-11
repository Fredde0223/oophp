<?php

namespace Fredde\Dice;

use PHPUnit\Framework\TestCase;

class DiceTest extends TestCase
{
    public function testDiceClass()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Fredde\Dice\Dice", $dice);

        $exp = null;
        $val = $dice->diceValue();
        $this->assertEquals($exp, $val);

        $dice->diceRoll();
        $val = $dice->diceValue();
        $this->assertGreaterThan(0, $val);

        $this->assertLessThan(7, $val);
    }

    public function testHandClass()
    {
        $hand = new Hand();
        $this->assertInstanceOf("\Fredde\Dice\Hand", $hand);

        $exp = null;
        $val = $hand->handValue();
        $this->assertEquals($exp, $val);

        $hand->handRoll();
        $val = $hand->handValue();
        $this->assertGreaterThan(-1, $val);

        $this->assertLessThan(19, $val);
    }

    public function testTurnClass()
    {
        $turn = new Turn();
        $this->assertInstanceOf("\Fredde\Dice\Turn", $turn);

        $exp = 0;
        $val = $turn->turnValue();
        $this->assertEquals($exp, $val);

        $turn->turnRoll();
        $val = $turn->turnValue();
        $this->assertGreaterThan(-1, $val);

        $this->assertLessThan(19, $val);

        $turn = new Turn(15);
        $val = $turn->turnValue();
        $turn->turnRoll();
        $valTwo = $turn->turnValue();
        $this->assertNotEquals($val, $valTwo);

        $turn = new Turn(15);
        $turn->turnReset();
        $val = $turn->turnValue();
        $this->assertEquals($exp, $val);
    }

    public function testGameClass()
    {
        $game = new Game();
        $this->assertInstanceOf("\Fredde\Dice\Game", $game);

        $exp = 0;
        $val = $game->score();
        $this->assertEquals($exp, $val);

        $val = $game->compScore();
        $this->assertEquals($exp, $val);

        while ($game->compScore() == 0) {
            $game->compTurn();
            $val = $game->compScore();
            $this->assertLessThan(37, $val);
        }

        while ($game->compScore() != 0) {
            $game = new Game();
            $game->compTurn();
            $val = $game->compScore();
            $this->assertGreaterThan(-1, $val);
        }

        while ($game->turnScore() == 0) {
            $val = $game->gameRoll();
            $this->assertLessThan(19, $val);
        }

        while ($game->turnScore() != 0) {
            $val = $game->gameRoll();
            $this->assertGreaterThan(-1, $val);
        }

        $game = new Game(20, 0, 0);
        $exp = 20;
        $val = $game->turnScore();
        $this->assertEquals($exp, $val);

        $game->endTurn();
        $val = $game->score();
        $this->assertEquals($exp, $val);

        $exp = 0;
        $val = $game->turnScore();
        $this->assertEquals($exp, $val);

        $exp = null;
        $output = $game->checkWinner();
        $this->assertEquals($exp, $output);

        $game = new Game(0, 100, 0);
        $exp = "YOU WIN";
        $output = $game->checkWinner();
        $this->assertEquals($exp, $output);

        $game = new Game(0, 0, 100);
        $exp = "COMPUTER WINS";
        $output = $game->checkWinner();
        $this->assertEquals($exp, $output);

        $game = new Game(0, 100, 100);
        $exp = "IT'S A DRAW";
        $output = $game->checkWinner();
        $this->assertEquals($exp, $output);

        $game = new Game();
        $exp = null;
        $output = $game->checkWinner();
        $this->assertEquals($exp, $output);
    }
}
