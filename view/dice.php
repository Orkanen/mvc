<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Fian\Functions\url;

$url = url("/dice/destroy");

var_dump($_SESSION);

$header = $header ?? null;
$message = $message ?? null;

use Fian\Dice\Dice;
use Fian\Dice\DiceHand;
use Fian\Dice\DiceGraphic;
use Fian\Dice\Rounds;

$die = new Dice();

$dice = new DiceGraphic();
$dice->roll();

$diceHand = new DiceHand(1);

$round = new Rounds();
$round->setSeries(1);
$round->setSeries(2);

?>
<h1><?= $header ?></h1>

<p><?= $message ?></p>

<p>DiceHand</p>
<form action=<?=$diceHand->roll()?> >
    <input type="submit" value="Roll" />
</form>
<p><?= $diceHand->getLastRoll() ?></p>
<?= $diceHand->printRoll() ?>

<p><?= $_SESSION["currentRoll"] = $diceHand->getSum() + ($_SESSION["currentRoll"] ?? 0) ?></p>

<form action=<?= $url; ?>>
    <input type="submit" value="Reset" />
</form>
