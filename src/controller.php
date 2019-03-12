<?php

/**
 * @param string $date
 * @return false|string
 */
function format_date(string $date)
{
    $date = strtotime($date);
    return date("d.m.Y H : i : s", $date);
}

// Model
require __DIR__ . '/model.php';

// Form handler
require __DIR__ . '/form_handler.php';

// Get feedback
$items = read($db);

// View
require __DIR__ . '/view.php';
