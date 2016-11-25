<?php

include("../globals.php");

$cronofy->upsert_event(Array(
  "tzid" => "Etc/UTC",
  "event_id" => $_POST['event']['event_id'],
  "calendar_id" => $_POST['event']['calendar_id'],
  "summary" => $_POST['event']['summary'],
  "description" => $_POST['event']['description'],
  "start" => date('c', strtotime($_POST['event']['start'])),
  "end" => date('c', strtotime($_POST['event']['end'])),
));

header('Location: ' . $GLOBALS['DOMAIN'] . '/events/show.php?calendarId=' . $_POST['event']['calendar_id'] . '&eventUid=' . $_POST['event']['event_uid']);
exit;

?>