<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Fian\Functions\url;

$url = url("/dice/destroy");
$url2 = url("/dice/info");
//var_dump($_SESSION);
$sess = isset($_SESSION['currentRoll']) ? $_SESSION['currentRoll'] : null;
$header = $header ?? null;
$message = $message ?? null;

use Fian\Dice\Dice;
use Fian\Dice\DiceHand;
use Fian\Dice\DiceGraphic;
use Fian\Dice\Rounds;

require __DIR__ . "/flashmessage.php";

$testing = ($_SESSION["object"] ?? null);
if ($testing != null) {
    $rollValue = $testing->roll();
}

?>

<form action="<?= $url2; ?>" method="post">

    <fieldset>
        <legend>Game of Dice</legend>

        <p><label><br>
            <input type="radio" name="amount" value="dice1" checked> Roll 1 dice<br>
            <input type="radio" name="amount" value="dice2"> Roll 2 dice <br>
            <input type="radio" name="amount" value="stop"> Hold <br>
        </label></p>

        <input type="submit" name="submit">

    </fieldset>

</form>

<form action=<?= $url; ?>>
    <input type="submit" name="reset" />
</form>

<a href=<?= $url2; ?>> TEST </a>
