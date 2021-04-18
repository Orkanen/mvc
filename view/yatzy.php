<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

use function Fian\Functions\url;

$header = $header ?? null;
$message = $message ?? null;
$url = url("/yatzy/roll");
?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<a href="<?= $url ?>">Roll</a>
