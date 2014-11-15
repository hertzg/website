<?php

function get_busy_times ($mysqli, $id_users, $calendarStartTime,
    $monthStartTime, $nextMonthStartTime, $monthSelected, $yearSelected) {

    $fnsDir = __DIR__.'/../../fns';
    $calendarEndTime = $calendarStartTime + 6 * 7 * 24 * 60 * 60;
    $busyTimes = [];

    include_once "$fnsDir/Events/indexOnUserInTimeRange.php";
    $events = Events\indexOnUserInTimeRange($mysqli,
        $id_users, $calendarStartTime, $calendarEndTime);
    foreach ($events as $event) $busyTimes[$event->event_time] = true;

    include_once "$fnsDir/Tasks/indexOnUserInDeadlineRange.php";
    $tasks = Tasks\indexOnUserInDeadlineRange($mysqli,
        $id_users, $calendarStartTime, $calendarEndTime);
    foreach ($tasks as $task) $busyTimes[$task->deadline_time] = true;

    include_once __DIR__.'/get_ranges.php';
    $ranges = get_ranges($monthSelected, $calendarStartTime,
        $monthStartTime, $nextMonthStartTime);

    include_once "$fnsDir/Contacts/indexOnUserInBirthdayRanges.php";
    $contacts = Contacts\indexOnUserInBirthdayRanges(
        $mysqli, $id_users, $ranges);
    foreach ($contacts as $contact) {
        $month = $contact->birthday_month;
        $day = $contact->birthday_day;
        $busyTimes[mktime(0, 0, 0, $month, $day, $yearSelected)] = true;
    }

    return $busyTimes;

}
