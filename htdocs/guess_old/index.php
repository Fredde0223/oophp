<?php
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");

session_name("guessGame");
session_start();

if (!isset($_SESSION["game"])) {
    $_SESSION["game"] = new Guess();
    $game = $_SESSION["game"];
    $game->random();
} else {
    $game = $_SESSION["game"];
}

$guess = $_POST["guess"] ?? null;
$doInit = $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;

if ($doInit) {
    $_SESSION = [];
    $_SESSION["game"] = new Guess();

    $game = $_SESSION["game"];
    $game->random();
} elseif ($doGuess) {
    $guessStr = $guess;
    $guess = intval($guess);

    try {
        $res = $game->makeGuess($guess);
    } catch (GuessException $guess) {
    }
}

include(__DIR__ . "/view/guess_post.php");
