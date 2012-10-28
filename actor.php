<?php

// will be replacing this with the compiling class

$actor = array_key_exists('actor', $_GET) ? $_GET['actor'] : null;
$date = array_key_exists('date', $_GET) ? $_GET['date'] : null;
$date = substr($date, 8, 2) . '-' . substr($date, 5, 2);

// Connect to database
$m = new Mongo();
$db = $m->actor_birthdays;

// Get the collection
$actors = $db->actor_birthdays->actor_birthdays;

$data = array();

// Query
if ($actor) {
    $date = $actors->findOne(array('name' => $actor));

    $months = array('', 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

    $day = substr($date['date'], 0, 2);
    $month = (int) substr($date['date'], 3, 2);

    $data[] = "{$day} {$months[$month]}";
}
else {
    $actors_list = $actors->find(array('date' => $date));

    foreach ($actors_list as $actor) {
        $data[] = $actor['name'];
    }
}
