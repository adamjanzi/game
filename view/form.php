<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

$header = $header ?? null;
$message = $message ?? null;
$action = $action ?? null;
$output = $output ?? null;

?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<form method="post" action="<?= $action ?>">
    <p>
        <input type="hidden" name="default" value="NULL" checked="checked">
        <input type="radio" name="content" value="4">4
        <input type="radio" name="content" value="6">6
        <input type="radio" name="content" value="8">8
        <input type="radio" name="content" value="10">10
        <input type="radio" name="content" value="12">12
        <input type="radio" name="content" value="20">20
    </p>

    <p>
        <input type="submit" value="Press me">
    </p>

    <?php if ($output !== null) : ?>
    <p>
        <output>You have chosen:<br>'<?= htmlentities($output); ?>'</output>
    </p>
    <?php endif; ?>
</form>
