<?php

namespace Fredde\Dice;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    // private $db = "not active"



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";
    //
    //     // Use $this->app to access the framework services.
    // }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return "Index route.";
    }



    /**
     * This is the index method action, it handles:
     * METHOD mountpoint/debug
     *
     * @return string
     */
    public function initAction() : object
    {
        // init
        $dice = new Game();
        $this->app->session->set("dice", $dice);

        return $this->app->response->redirect("dicegame/play");
    }



    /**
     * This is the index method action, it handles:
     * METHOD mountpoint/play
     *
     * @return string
     */
    public function playActionGet() : object
    {
        // play get
        $title = "Tärningsspel 100";

        $dice = $this->app->session->get("dice");
        $res = $this->app->session->get("res");
        $check = $this->app->session->get("check");
        $this->app->session->set("res", null);
        $this->app->session->set("check", null);

        $histogram = new Histogram();
        $histogram->injectData($dice);

        $data = [
            "res" => $res,
            "check" => $check,
            "turnScore" => $dice->turnScore(),
            "score" => $dice->score(),
            "compScore" => $dice->compScore(),
            "histogram" => $histogram->getAsText(),
        ];

        $this->app->page->add("dicegame/play", $data);

        return $this->app->page->render([
            "title" => $title,
        ]);
    }



    /**
     * This is the index method action, it handles:
     * METHOD mountpoint/play
     *
     * @return string
     */
    public function playActionPost() : object
    {
        // play post
        $dice = $this->app->session->get("dice");
        $rollDice = $this->app->request->getPost("rollDice");
        $endTurn = $this->app->request->getPost("endTurn");
        $restartGame = $this->app->request->getPost("restartGame");

        if ($rollDice) {
            $res = $dice->gameRoll();
            $check = $dice->checkWinner();

            $this->app->session->set("res", $res);
            $this->app->session->set("check", $check);
        } elseif ($endTurn) {
            $dice->endTurn();
            $check = $dice->checkWinner();

            $this->app->session->set("check", $check);
        } elseif ($restartGame) {
            $this->app->session->set("dice", null);
            $this->app->session->set("res", null);
            $this->app->session->set("check", null);
            $dice = new Game();
            $this->app->session->set("dice", $dice);
        }

        return $this->app->response->redirect("dicegame/play");
    }
}
