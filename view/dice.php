<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;

use Fian\Dice\Dice;
use Fian\Dice\DiceHand;
use Fian\Dice\DiceGraphic;

$die = new Dice();

$dice = new DiceGraphic();
$dice->roll();

$diceHand = new DiceHand(3);
$diceHand->roll();

?>
<h1><?= $header ?></h1>

<p><?= $message ?></p>

<p>DiceHand</p>

<p><?= $diceHand->getLastRoll() ?></p>

<?= $dice->roll(); ?>
<?= $dice->graphic(); ?>

<p><?= $diceHand->printRoll() ?></p>
