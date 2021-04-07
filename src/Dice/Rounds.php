<?php

declare(strict_types=1);

namespace Fian\Dice;

//use function Mos\Functions\{
//    destroySession,
//    redirectTo,
//    renderView,
//    renderTwigView,
//    sendResponse,
//    url
//};

/**
 * Class Dice.
 */
class Rounds
{
    private array $winners;
    private int $prevWin;
    private int $playerValue;
    private int $computerValue;
    private $series = [];

    public function newRound()
    {
        $this->playerValue = 0;
        $this->computerValue = 0;
    }

    public function game(int $dice=1)
    {
        $diceHand = new DiceHand($dice);
        $diceHand->roll();
        $this->playerValue = $diceHand->getSum();
        return $diceHand->printRoll() . $this->playerValue;
    }

    public function getWinners()
    {
        $this->winners[0] = "You";
        $res = "";
        for ($i = 0; $i <= count($this->winners)-1; $i++) {
            $res = $this->winners[$i] . ", ";
        }

        return $res;
    }

    public function setSeries($var)
    {
        array_push($this->series, $var);
    }

    public function getSeries()
    {
        $res = "";
        for ($i = 0; $i <= count($this->series)-1; $i++) {
            $res = $this->series[$i] . ", ";
        }
        return $res;
    }
}
