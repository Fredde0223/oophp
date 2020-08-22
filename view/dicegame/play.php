<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());



?><h1>Tärningsspel 100 (controller)</h1>

<p>Tryck på knapparna för att spela spelet.</p>

<p>Knappen "Roll dice" kastar 3 tärningar, om ingen av tärningarna slår en etta räknas poängen ihop. DU kan fortsätta att kasta tills en tärning visar en etta, då du förlorar alla poäng. För att spara poäng tryck "End your turn". Efter att din tur går över antingen via knappen eller att du slår en etta spelar datorn sin tur. Först till 100 vinner.</p>

<?php if (!$check) : ?>
    <form method="post">
        <input type="submit" name="rollDice" value="Roll dice">
        <input type="submit" name="endTurn" value="End your turn">
        <input type="submit" name="restartGame" value="Restart game">
    </form>

    <p>Your roll was: <?= $res ?></p>
    <p>This turn's score is <?= $turnScore ?>.</p>
    <p>Your total score is <?= $score ?>.</p>
    <p>Computer score is <?= $compScore ?>.</p>
    <pre><?= $histogram ?></pre>
<?php endif ?>

<?php if ($check) : ?>
    <form method="post">
        <input type="submit" name="restartGame" value="Restart game">
    </form>

    <p><?= $check ?></p>
    <p>Final score: <?= $score ?> - <?= $compScore ?> (You - Computer)</p>
<?php endif ?>
