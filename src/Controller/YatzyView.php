<?php

declare(strict_types=1);

namespace Fian\Controller;

use Psr\Http\Message\ResponseInterface;
use Fian\Dice\Dice;
use Fian\Dice\DiceHand;
use Fian\Dice\DiceGraphic;
use Fian\Dice\Rounds;

use function Fian\Functions\renderTwigView;
use function Fian\Functions\{
    destroySession,
    renderView,
    url,
    getRoutePath,
    objectCreator,
    yatzy,
    gameOver
};

class YatzyView
{
    use ControllerTrait;

    public function index(): ResponseInterface
    {
        $url = url("/yatzy/firstRoll");
        $data = [
            "header" => "Yatzy page",
            "message" => "YATZY!.",
            "rollDice" => "<a href=$url>Roll</a>"
        ];

        $body = renderView("layout/yatzy.php", $data);

        return $this->response($body);
    }

    public function firstRoll(): ResponseInterface
    {

        $_SESSION["gameCounter"] = 1;
        objectCreator();
        //$objectHold = $_SESSION['diceHand'];
        //$_SESSION["diceHand"] = $diceHand;
        $tempHolder = "roll";
        yatzy($tempHolder);

        $form = "<input type='checkbox' name='amount1' value='0'> Roll Dice 1<br>
                <input type='checkbox' name='amount2' value='1'> Roll Dice 2<br>
                <input type='checkbox' name='amount3' value='2'> Roll Dice 3<br>
                <input type='checkbox' name='amount4' value='3'> Roll Dice 4<br>
                <input type='checkbox' name='amount5' value='4'> Roll Dice 5<br>
                <input type='submit' name='submit' value='Roll'/>";

        $url = url("/yatzy/roll");

        $data = [
            "header" => "Yatzy page",
            "message" => "A ROLL WAS MADE",
            "dice" => $_SESSION["testing"],
            "form" => $form,
            "url" => $url
        ];

        $body = renderView("layout/yatzy.php", $data);
        //return $this->redirect(url("/yatzy"));
        return $this->response($body);
    }

    public function reRoll(): ResponseInterface
    {

        $_SESSION["gameCounter"] += 1;
        $dice1 = $_POST["amount1"] ?? null;
        $dice2 = $_POST["amount2"] ?? null;
        $dice3 = $_POST["amount3"] ?? null;
        $dice4 = $_POST["amount4"] ?? null;
        $dice5 = $_POST["amount5"] ?? null;
        $reRollDice = [$dice1, $dice2, $dice3, $dice4, $dice5];

        $tempHolder = "none";

        yatzy($tempHolder, $reRollDice);
        $url = url("/yatzy/roll");
        $form = "<input type='checkbox' name='amount1' value='0'> Roll Dice 1<br>
                <input type='checkbox' name='amount2' value='1'> Roll Dice 2<br>
                <input type='checkbox' name='amount3' value='2'> Roll Dice 3<br>
                <input type='checkbox' name='amount4' value='3'> Roll Dice 4<br>
                <input type='checkbox' name='amount5' value='4'> Roll Dice 5<br>
                <input type='submit' name='submit' value='Roll'>";

        $data = [
            "header" => "Yatzy page",
            "message" => "Re-rolled",
            "dice" => $_SESSION["testing2"],
            "form" => $form,
            "url" => $url
        ];
        if ($_SESSION["gameCounter"] == 4) {
            $url = url("/yatzy");
            $gameOver = gameOver();
            $data = [
                "header" => "Yatzy page",
                "message" => "Game Over",
                "dice" => $gameOver,
                "form" => null,
                "url" => $url
            ];
        }


        $body = renderView("layout/yatzy.php", $data);
        return $this->response($body);
    }
}
