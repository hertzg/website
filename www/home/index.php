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
include_once '../classes/Bookmarks.php';
include_once '../classes/Contacts.php';
include_once '../classes/Events.php';
include_once '../classes/Notes.php';
include_once '../classes/Notifications.php';
include_once '../classes/Tab.php';
include_once '../classes/Tasks.php';
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

$numBookmarks = Bookmarks::countOnUser($idusers);
if ($numBookmarks) {
    $items[] = Page::imageLinkWithDescription(
        'Bookmarks',
        "$numBookmarks total.",
        'bookmarks/',
        'bookmarks'
    );
} else {
    $items = Page::imageLink('Bookmarks', 'bookmarks/', 'bookmarks');
}

$timeNow = time();
$dayToday = date('j', $timeNow);
$monthToday = date('n', $timeNow);
$yearToday = date('Y', $timeNow);
$timeToday = mktime(0, 0, 0, $monthToday, $dayToday, $yearToday);
$timeTomorrow = mktime(0, 0, 0, $monthToday, $dayToday + 1, $yearToday);
$numEventsToday = Events::countOnTime($idusers, $timeToday);
$numEventsTomorrow = Events::countOnTime($idusers, $timeTomorrow);
if ($numEventsToday) {
    if ($numEventsTomorrow) {
        $items[] = Page::imageLinkWithDescription(
            'Calendar',
            n_events($numEventsToday).' today. '.n_events($numEventsTomorrow).' tomorrow.',
            'calendar/',
            'calendar'
        );
    } else {
        $items[] = Page::imageLinkWithDescription(
            'Calendar',
            n_events($numEventsToday).' today.',
            'calendar/',
            'calendar'
        );
    }
} elseif ($numEventsTomorrow) {
    $items[] = Page::imageLinkWithDescription(
        'Calendar',
        n_events($numEventsTomorrow).' tomorrow.',
        'calendar/',
        'calendar'
    );
} else {
    $items[] = Page::imageLink('Calendar', 'calendar/', 'calendar');
}

$numContacts = Contacts::countOnUser($idusers);
if ($numContacts) {
    $items[] = Page::imageLinkWithDescription('Contacts', "$numContacts total.", 'contacts/', 'contacts');
} else {
    $items[] = Page::imageLink('Contacts', 'contacts/', 'contacts');
}

if ($user->storageused) {
    $items[] = Page::imageLinkWithDescription('Files', bytestr($user->storageused).' used.', 'files/', 'files');
} else {
    $items[] = Page::imageLink('Files', 'files/', 'files');
}

$numNotes = Notes::countOnUser($idusers);
if ($numNotes) {
    $items[] = Page::imageLinkWithDescription(
        'Notes',
        "$numNotes total.",
        'notes/',
        'notes'
    );
} else {
    $items[] = Page::imageLink('Notes', 'notes/', 'notes');
}

$numNotifications = Notifications::countOnUser($idusers);
if ($numNotifications) {
    $description = '';
    $numNewNotifications = $user->numnotifications;
    if ($numNewNotifications) {
        $notifications = Page::warnings(array("$numNewNotifications new notifications."));
        $items[] = Page::imageLinkWithDescription(
            'Notifications',
            "$numNewNotifications new. $numNotifications total.",
            'notifications/',
            'notification'
        );
    } else {
        $notifications = '';
        $items[] = Page::imageLinkWithDescription(
            'Notifications',
            "$numNotifications total.",
            'notifications/',
            'old-notification'
        );
    }
} else {
    $notifications = '';
    $items[] = Page::imageLink(
        'Notifications',
        'notifications/',
        'old-notification'
    );
}

$numTasks = Tasks::countOnUser($idusers);
if ($numTasks) {
    $items[] = Page::imageLinkWithDescription(
        'Tasks',
        "$numTasks total.",
        'tasks/',
        'tasks'
    );
} else {
    $items[] = Page::imageLink('Tasks', 'tasks/', 'tasks');
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
        Page::imageLink('Account', 'account/', 'account')
        .Page::HR
        .Page::imageLink('Help', 'help/', 'help')
        .Page::HR
        .Page::imageLink('Sign Out', 'submit-signout.php', 'signout')
    )
);
