<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Initiate game, and play
 */
$app->router->get("guess/init", function () use ($app) {
    // init
    $_SESSION["game"] = new Fredde\Guess\Guess();
    $_SESSION["game"]->random();

    return $app->response->redirect("guess/play");
});



/**
 * Play
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Spela spelet";

    $res = $_SESSION["res"] ?? null;
    $err = $_SESSION["err"] ?? null;
    $cheat = $_SESSION["cheat"] ?? null;
    $guess = $_SESSION["guess"] ?? null;
    $guessStr = $_SESSION["guessStr"] ?? null;
    $_SESSION["res"] = null;
    $_SESSION["err"] = null;
    $_SESSION["cheat"] = null;
    $_SESSION["guess"] = null;
    $_SESSION["guessStr"] = null;

    $data = [
        "guess" => $guess,
        "guessStr" => $guessStr,
        "res" => $res,
        "err" => $err,
        "cheat" => $cheat,
        "tries" => $_SESSION["game"]->tries(),
        "number" => $_SESSION["game"]->number(),
    ];

    $app->page->add("guess/play", $data);
    $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * guess
 */
$app->router->post("guess/play", function () use ($app) {
    $title = "Spela spelet";

    $guess = $_POST["guess"] ?? null;
    $doInit = $_POST["doInit"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;

    if ($doGuess) {
        $guessStr = $guess;
        $guess = intval($guess);

        try {
            $res = $_SESSION["game"]->makeGuess($guess);
        } catch (GuessException $guess) {
            $err = $guess->getMessage();
        }

        $_SESSION["res"] = $res;
        $_SESSION["err"] = $err;
        $_SESSION["guess"] = $guess;
        $_SESSION["guessStr"] = $guessStr;
    } elseif ($doInit) {
        $_SESSION = [];
        $_SESSION["game"] = new Fredde\Guess\Guess();
        $_SESSION["game"]->random();
    } elseif ($doCheat) {
        $_SESSION["cheat"] = "cheat";
    }

    return $app->response->redirect("guess/play");
});
