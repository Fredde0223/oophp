<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Initiate game, and play
 */
$app->router->get("dice/init", function () use ($app) {
    // init
    $_SESSION["dice"] = new Fredde\Dice\Game();

    return $app->response->redirect("dice/play");
});



/**
 * start
 */
$app->router->get("dice/play", function () use ($app) {
    $title = "Tärningsspel 100";

    $res = $_SESSION["res"] ?? null;
    $check = $_SESSION["check"] ?? null;
    $_SESSION["res"] = null;
    $_SESSION["check"] = null;

    $data = [
        "res" => $res,
        "check" => $check,
        "turnScore" => $_SESSION["dice"]->turnScore(),
        "score" => $_SESSION["dice"]->score(),
        "compScore" => $_SESSION["dice"]->compScore(),
    ];

    $app->page->add("dice/play", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});



/**
 * play game
 */
$app->router->post("dice/play", function () use ($app) {
    $title = "Tärningsspel 100";

    $rollDice = $_POST["rollDice"] ?? null;
    $endTurn = $_POST["endTurn"] ?? null;
    $restartGame = $_POST["restartGame"] ?? null;

    if ($rollDice) {
        $res = $_SESSION["dice"]->gameRoll();
        $check = $_SESSION["dice"]->checkWinner();

        $_SESSION["res"] = $res;
        $_SESSION["check"] = $check;
    } elseif ($endTurn) {
        $_SESSION["dice"]->endTurn();
        $check = $_SESSION["dice"]->checkWinner();

        $_SESSION["check"] = $check;
    } elseif ($restartGame) {
        $_SESSION = [];
        $_SESSION["dice"] = new Fredde\Dice\Game();
    }

    return $app->response->redirect("dice/play");
});
