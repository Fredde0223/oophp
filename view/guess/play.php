<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());



?><h1>Guess my number</h1>

<p>Guess a number between 1 and 100, you have <?= $tries ?> left.</p>

<form method="post">
    <input type="text" name="guess">
    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doInit" value="Start from beginning">
    <input type="submit" name="doCheat" value="Cheat">
</form>

<?php if ($res && is_int($guess)) : ?>
    <p>Your guess "<?= $guessStr ?>" is <?= $res ?>.</p>
<?php endif; ?>

<?php if ($res && !is_int($guess)) : ?>
    <p><?= $err ?></p>
<?php endif; ?>

<?php if ($cheat) : ?>
    <p>CHEAT: Current number is <?= $number ?>.</b></p>
<?php endif; ?>
