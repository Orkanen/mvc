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
    private array $dices;
    private int $sum = 0;
    private int $amount = 0;

    public function __construct()
    {
        $this->dices[0] = new Dice();
    }

    public function roboRoll()
    {
        $this->sum += $this->dices[0]->roll();
    }

    public function curRoll(int $human=0)
    {
        for($this->sum; $this->sum <= $human;)
        {
            if ($this->sum >= 21){
                break;
            } else {
                $this->sum += $this->dices[0]->roll();
            };
        };
    }

    public function roboSum()
    {
        return $this->sum;
    }


}
