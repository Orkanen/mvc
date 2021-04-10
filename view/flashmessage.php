<?php
/**
 * Generate a flashmessage on one page load , based on information in the
 * session, then remove the information from the session.
 */
//$status = "";
$message = $_SESSION["flashmessage"] ?? null;
$curRoll = $_SESSION["currentRoll"] ?? null;
$status = $_SESSION["status"] ?? null;
$rob = $_SESSION["roboRolls"] ?? null;
$comp = $_SESSION["compWin"] ?? null;
$human = $_SESSION["manWin"] ?? null;
$roboSum = $_SESSION["roboSum"] ?? null;
// Clear the message, it should only be used once
$_SESSION["flashmessage"] = null;
$_SESSION["status"] = null;
$_SESSION["roboSum"] = null;
//$_SESSION["victory"] = null;
//$_SESSION["loss"] = null;
// Return if no message

?><div class="flashmessage">
    <h2>Current Score:</h2>
    <p>Computer: <?= $comp?></p>
    <p>You: <?= $human?></p>
    <h2>Roll:</h2>
    <h3><?= $status ?></h3>
    <p><?= $message ?></p>
    <p><?= $curRoll ?></p>
    <h2>Computer:</h2>
    <p><?= $rob ?></p>
    <p><?= $roboSum ?></p>
</div>
