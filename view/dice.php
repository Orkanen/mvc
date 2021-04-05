<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;

use Fian\Dice\Dice;
use Fian\Dice\DiceHand;

$die = new Dice();
$die->roll();

$diceHand = new DiceHand();
$diceHand->roll();


?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<p><?= $die->getLastRoll() ?></p>

<p>DiceHand</p>

<p><?= $diceHand->getLastRoll() ?></p>