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
include_once '../classes/Notifications.php';
include_once '../classes/Tab.php';
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

include_once '../fns/Bookmarks/countOnUser.php';
$numBookmarks = Bookmarks\countOnUser($mysqli, $idusers);

$title = 'Bookmarks';
$href = '../bookmarks/';
$icon = 'bookmarks';
if ($numBookmarks) {
    $description = "$numBookmarks total.";
    $items[] = Page::imageLinkWithDescription($title, $description, $href, $icon);
} else {
    $items[] = Page::imageLink($title, $href, $icon);
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
    $items[] = Page::imageLinkWithDescription($title, $description, $href, $icon);
} elseif ($numEventsTomorrow) {
    $description = n_events($numEventsTomorrow).' tomorrow.';
    $items[] = Page::imageLinkWithDescription($title, $description, $href, $icon);
} else {
    $items[] = Page::imageLink($title, $href, $icon);
}

include_once '../fns/Contacts/countOnUser.php';
$numContacts = Contacts\countOnUser($mysqli, $idusers);

$title = 'Contacts';
$href = '../contacts/';
$icon = 'contacts';
if ($numContacts) {
    $description = "$numContacts total.";
    $items[] = Page::imageLinkWithDescription($title, $description, $href, $icon);
} else {
    $items[] = Page::imageLink($title, $href, $icon);
}

$title = 'Files';
$href = '../files/';
$icon = 'files';
if ($user->storageused) {
    $description = bytestr($user->storageused).' used.';
    $items[] = Page::imageLinkWithDescription($title, $description, $href, $icon);
} else {
    $items[] = Page::imageLink($title, $href, $icon);
}

include_once '../fns/Notes/countOnUser.php';
$numNotes = Notes\countOnUser($mysqli, $idusers);

$title = 'Notes';
$href = '../notes/';
$icon = 'notes';
if ($numNotes) {
    $description = "$numNotes total.";
    $items[] = Page::imageLinkWithDescription($title, $description, $href, $icon);
} else {
    $items[] = Page::imageLink($title, $href, $icon);
}

$title = 'Notifications';
$href = '../notifications/';
$numNotifications = Notifications::countOnUser($idusers);
if ($numNotifications) {
    $description = '';
    $numNewNotifications = $user->numnotifications;
    if ($numNewNotifications) {
        $notifications = Page::warnings(array("$numNewNotifications new notifications."));
        $items[] = Page::imageLinkWithDescription(
            $title,
            "$numNewNotifications new. $numNotifications total.",
            $href,
            'notification'
        );
    } else {
        $notifications = '';
        $items[] = Page::imageLinkWithDescription(
            $title,
            "$numNotifications total.",
            $href,
            'old-notification'
        );
    }
} else {
    $notifications = '';
    $items[] = Page::imageLink($title, $href, 'old-notification');
}

include_once '../fns/Tasks/countOnUser.php';
$numTasks = Tasks\countOnUser($mysqli, $idusers);

$title = 'Tasks';
$href = '../tasks/';
$icon = 'tasks';
if ($numTasks) {
    $description = "$numTasks total.";
    $items[] = Page::imageLinkWithDescription($title, $description, $href, $icon);
} else {
    $items[] = Page::imageLink($title, $href, $icon);
}

if (array_key_exists('home/index_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['home/index_messages']);
} else {
    $pageMessages = '';
}

$page->base = $base;
$page->title = 'Home';
$page->finish(
    Tab::create(
        Tab::activeItem('Home'),
        $pageMessages
        .$notifications
        .join(Page::HR, $items)
    )
    .create_panel(
        'Options',
        Page::imageLink('Account', '../account/', 'account')
        .Page::HR
        .Page::imageLink('Help', '../help/', 'help')
        .Page::HR
        .Page::imageLink('Sign Out', '../submit-signout.php', 'sign-out')
    )
);
