<?php

function n_events ($n) {
    if ($n == 1) return '1 event';
    return "$n events";
}

$base = '../';

include_once '../fns/require_user.php';
require_user($base);

include_once '../fns/bytestr.php';
include_once '../fns/create_panel.php';
include_once '../fns/create_search_form_empty_content.php';
include_once '../lib/mysqli.php';
include_once '../lib/page.php';

unset(
    $_SESSION['account/index_messages'],
    $_SESSION['bookmarks/index_messages'],
    $_SESSION['calendar/index_messages'],
    $_SESSION['contacts/index_messages'],
    $_SESSION['files/index_messages'],
    $_SESSION['help/index_messages'],
    $_SESSION['notes/index_messages'],
    $_SESSION['notifications/index_messages'],
    $_SESSION['tasks/index_messages']
);

$items = array();

$items[] =
    '<form action="../search/" style="height: 48px; position: relative">'
        .create_search_form_empty_content('Search...')
    .'</form>';

$num_bookmarks = $user->num_bookmarks;
$title = 'Bookmarks';
$href = '../bookmarks/';
$icon = 'bookmarks';
if ($num_bookmarks) {
    $description = "$num_bookmarks total.";
    $items[] = Page::imageArrowLinkWithDescription($title, $description, $href, $icon);
} else {
    $items[] = Page::imageArrowLink($title, $href, $icon);
}

$timeNow = time();
$dayToday = date('j', $timeNow);
$monthToday = date('n', $timeNow);
$yearToday = date('Y', $timeNow);
$timeToday = mktime(0, 0, 0, $monthToday, $dayToday, $yearToday);
$timeTomorrow = mktime(0, 0, 0, $monthToday, $dayToday + 1, $yearToday);

include_once '../fns/Events/countOnTime.php';
$numEventsToday = Events\countOnTime($mysqli, $idusers, $timeToday);
$numEventsTomorrow = Events\countOnTime($mysqli, $idusers, $timeTomorrow);

$title = 'Calendar';
$href = '../calendar/';
$icon = 'calendar';
if ($numEventsToday) {
    if ($numEventsTomorrow) {
        $description =
            n_events($numEventsToday).' today. '
            .n_events($numEventsTomorrow).' tomorrow.';
    } else {
        $description = n_events($numEventsToday).' today.';
    }
    $items[] = Page::imageArrowLinkWithDescription($title, $description, $href, $icon);
} elseif ($numEventsTomorrow) {
    $description = n_events($numEventsTomorrow).' tomorrow.';
    $items[] = Page::imageArrowLinkWithDescription($title, $description, $href, $icon);
} else {
    $items[] = Page::imageArrowLink($title, $href, $icon);
}

$num_contacts = $user->num_contacts;
$title = 'Contacts';
$href = '../contacts/';
$icon = 'contacts';
if ($num_contacts) {
    $description = "$num_contacts total.";
    $items[] = Page::imageArrowLinkWithDescription($title, $description, $href, $icon);
} else {
    $items[] = Page::imageArrowLink($title, $href, $icon);
}

$title = 'Files';
$href = '../files/';
$icon = 'files';
if ($user->storageused) {
    $description = bytestr($user->storageused).' used.';
    $items[] = Page::imageArrowLinkWithDescription($title, $description, $href, $icon);
} else {
    $items[] = Page::imageArrowLink($title, $href, $icon);
}

$num_notes = $user->num_notes;
$title = 'Notes';
$href = '../notes/';
$icon = 'notes';
if ($num_notes) {
    $description = "$num_notes total.";
    $items[] = Page::imageArrowLinkWithDescription($title, $description, $href, $icon);
} else {
    $items[] = Page::imageArrowLink($title, $href, $icon);
}

$num_notifications = $user->num_notifications;
$title = 'Notifications';
$href = '../notifications/';
if ($num_notifications) {
    $description = '';
    $num_new_notifications = $user->num_new_notifications;
    if ($num_new_notifications) {
        $notifications = Page::warnings(array("$num_new_notifications new notifications."));
        $items[] = Page::imageArrowLinkWithDescription(
            $title,
            "$num_new_notifications new. $num_notifications total.",
            $href,
            'notification'
        );
    } else {
        $notifications = '';
        $items[] = Page::imageArrowLinkWithDescription(
            $title,
            "$num_notifications total.",
            $href,
            'old-notification'
        );
    }
} else {
    $notifications = '';
    $items[] = Page::imageArrowLink($title, $href, 'old-notification');
}

$num_tasks = $user->num_tasks;
$title = 'Tasks';
$href = '../tasks/';
$icon = 'tasks';
if ($num_tasks) {
    $description = "$num_tasks total.";
    $items[] = Page::imageArrowLinkWithDescription($title, $description, $href, $icon);
} else {
    $items[] = Page::imageArrowLink($title, $href, $icon);
}

if (array_key_exists('home/index_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['home/index_messages']);
} else {
    $pageMessages = '';
}

include_once '../fns/create_tabs.php';

$page->base = $base;
$page->title = 'Home';
$page->finish(
    create_tabs(array(), 'Home', $pageMessages.$notifications.join(Page::HR, $items))
    .create_panel(
        'Options',
        Page::imageArrowLink('Account', '../account/', 'account')
        .Page::HR
        .Page::imageArrowLink('Help', '../help/', 'help')
        .Page::HR
        .Page::imageLink('Sign Out', '../submit-signout.php', 'sign-out')
    )
);
