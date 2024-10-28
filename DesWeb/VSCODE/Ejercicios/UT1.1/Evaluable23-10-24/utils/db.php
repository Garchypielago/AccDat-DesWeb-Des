<?php 

require_once __DIR__ . '/../data-access/CalendarDataAccess.php';

$dbFile = __DIR__ . '/calendar.db';
$calendarDataAccess = new CalendarDataAccess($dbFile);

?>