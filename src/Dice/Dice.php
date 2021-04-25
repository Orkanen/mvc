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
class Dice
{
    private int $faces = 6;

    private ?int $roll = null;

    public function roll(): int
    {
        $this->roll = rand(1, $this->faces);

        return $this->roll;
    }

    public function getLastRoll()
    {
        return $this->roll;
    }

    public function setFaces(int $face)
    {
        $this->faces = $face;
    }

    public function getFaces()
    {
        return $this->faces;
    }

}

class DiceGraphic extends Dice
{
    public function graphic()
    {
        return "dice-" . $this->getLastRoll();
    }
}
