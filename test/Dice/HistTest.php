<?php

namespace Fredde\Dice;

use PHPUnit\Framework\TestCase;

class HistTest extends TestCase
{
    public function testHistogramTrait()
    {
        $game = new Game();
        $this->assertInstanceOf("\Fredde\Dice\Game", $game);

        $exp = 1;
        $val = $game->getHistogramMin();
        $this->assertEquals($exp, $val);

        $exp = 6;
        $val = $game->getHistogramMax();
        $this->assertEquals($exp, $val);

        $obj = $game->getHistogramSerie();
        $this->assertIsArray($obj);
    }

    public function testHistogram()
    {
        $histogram = new Histogram();
        $this->assertInstanceOf("\Fredde\Dice\Histogram", $histogram);

        $game = new Game();
        $histogram->injectData($game);

        $obj = $histogram->getSerie();
        $this->assertIsArray($obj);

        $str = $histogram->getAsText();
        $this->assertIsString($str);
    }
}
