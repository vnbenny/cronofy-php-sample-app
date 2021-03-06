<?php
include('../config.php');

if(!isset($_GET['calendarId'])){
  header('Location: ' . $GLOBALS['DOMAIN'] . '/profiles/');
  die;
}

$calendars = $cronofy->list_calendars()["calendars"];

for($i = 0; $i < count($calendars); $i++){
  if($calendars[$i]["calendar_id"] == $_GET['calendarId']){
    $calendar = $calendars[$i];
  }
}

if(!isset($calendar)){
  header('Location: ' . $GLOBALS['DOMAIN'] . '/profiles/');
  die;
}

$events = $cronofy->read_events(array("tzid" => "Etc/UTC", "include_managed" => true, "calendar_ids" => array($calendar["calendar_id"])));

include("../../header.php"); ?>

<div class="row">
  <div class="col-xs-8">
<h2><?= $calendar["calendar_name"] ?> - Events</h2>
</div>
<div class="col-xs-4 text-right">
  <a href="/service_account_users/events/new.php?email=<?= $_GET['email'] ?>&calendarId=<?= $calendar["calendar_id"] ?>" class="btn btn-primary">
    Create Event
  </a>
</div>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>Event Summary</th>
      <th>Start</th>
      <th>End</th>
    </tr>
  </thead>

  <tbody>
    <? foreach($events->each() as $event){ ?>
    <tr>
      <td>
        <?= $event["summary"] ?>
      </td>
      <td>
        <?= $event["start"] ?>
      </td>
      <td>
        <?= $event["end"] ?>
      </td>
    </tr>
    <? } ?>
  </tbody>
</table>

<?php include("../../footer.php"); ?>
