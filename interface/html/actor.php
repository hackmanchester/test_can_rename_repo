<?php

if (!array_key_exists('actor', $_GET)) {
    header ("Location: index.php");
    exit;
}

$actor = $_GET['actor'];

// Connect to database
$m = new Mongo();
$db = $m->actor_birthdays;

// Get the collection
$actors = $db->actor_birthdays->actor_birthdays;

// Create the filter
$args = array('name' => $actor);

// Query
$date = $actors->findOne($args);

$months = array('', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

$day = substr($date['date'], 0, 2);
$month = (int) substr($date['date'], 3, 2);

echo "{$day} {$months[$month]}";
