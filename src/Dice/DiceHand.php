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
class DiceHand
{
    private array $dices;
    private int $sum = 0;
    private int $amount = 1;

    public function __construct(int $die=1)
    {
        $this->amount = $die;
        for ($i = 0; $i <= $this->amount; $i++) {
            $this->dices[$i] = new DiceGraphic();
        }
    }

    public function roll()
    {
        $len = count($this->dices);

        $this->sum = 0;
        for ($i = 0; $i <= $this->amount; $i++) {
            $this->sum += $this->dices[$i]->roll();
        }
    }

    public function getLastRoll(): string
    {
        $res = "";
        for ($i = 0; $i <= $this->amount; $i++) {
            $res .= $this->dices[$i]->getLastRoll() . ", ";
        }

        return $res . " = " . $this->sum;
    }

    public function getSum(): int
    {
        return $this->sum;
    }

    public function printRoll(): string
    {
        $res = "<p class='dice-utf8'>";
        for ($i = 0; $i <= $this->amount; $i++) {
            $res .= "<i class=" . $this->dices[$i]->graphic() . "></i>";
        }

        return $res . "</p>";
    }
}

class RoboHand
{
    private int $robSum = 0;
    public function curRoll(int $human = 1)
    {
        for ($i = 0; $i <= 0; $i++) {
            $this->dices[$i] = new DiceGraphic();
        }
        while ($this->robSum <= $human) {
            $this->robSum += $this->dices[0]->roll();
        }
    }

    public function roboSum()
    {
        return $this->robSum;
    }
}
