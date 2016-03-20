<?php

function events_panel ($mysqli, $user, $day, $month, $year, $timeToday) {

    if ($day === null) return;

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../fns';

    $timeSelected = mktime(0, 0, 0, $month, $day, $year);
    $yearSelected = date('Y', $timeSelected);
    $monthSelected = date('n', $timeSelected);
    $daySelected = date('j', $timeSelected);

    include_once "$fnsDir/Contacts/indexBirthdays.php";
    $contacts = Contacts\indexBirthdays($mysqli,
        $id_users, $daySelected, $monthSelected, $yearSelected);

    include_once "$fnsDir/Tasks/indexOnUserAndDeadline.php";
    $tasks = Tasks\indexOnUserAndDeadline($mysqli, $id_users, $timeSelected);

    if (!$contacts && !$tasks && !$user->num_events) return;

    include_once "$fnsDir/Events/indexOnUserAndTime.php";
    $events = Events\indexOnUserAndTime($mysqli, $id_users, $timeSelected);

    include_once 'fns/render_events.php';
    render_events($contacts, $tasks, $events,
        $yearSelected, $timeSelected, $timeToday, $items);

    if (count($events) < $user->num_events) {
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        $items[] = Page\imageArrowLinkWithDescription('All Events',
            "$user->num_events total.", 'all-events/', 'events',
            ['id' => 'all-events']);
    }

    $content = join('<div class="hr"></div>', $items);

    $dayText = date('F', $timeSelected)." $daySelected";
    if ($yearSelected != date('Y', $timeToday)) {
        $dayText .= ", $yearSelected";
    }

    include_once "$fnsDir/Page/panel.php";
    return Page\panel("Events on $dayText", $content);

}
