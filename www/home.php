<?php

function n_events ($n) {
    if ($n == 1) return '1 event';
    return "$n events";
}

include_once 'lib/require-user.php';
include_once 'fns/bytestr.php';
include_once 'fns/create_panel.php';
include_once 'classes/Bookmarks.php';
include_once 'classes/Contacts.php';
include_once 'classes/Events.php';
include_once 'classes/Notes.php';
include_once 'classes/Notifications.php';
include_once 'classes/Tab.php';
include_once 'classes/Tasks.php';
include_once 'lib/page.php';

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

$numContacts = Contacts::countOnUser($idusers);
$numNotifications = Notifications::countOnUser($idusers);
$numNewNotifications = $user->numnotifications;

$numBookmarks = Bookmarks::countOnUser($idusers);
if ($numBookmarks) {
    $bookmarksLink = Page::imageLinkWithDescription(
        'Bookmarks',
        "$numBookmarks total.",
        'bookmarks/',
        'bookmarks'
    );
} else {
    $bookmarksLink = Page::imageLink('Bookmarks', 'bookmarks/', 'bookmarks');
}

$numNotes = Notes::countOnUser($idusers);
if ($numNotes) {
    $notesLink = Page::imageLinkWithDescription(
        'Notes',
        "$numNotes total.",
        'notes/',
        'notes'
    );
} else {
    $notesLink = Page::imageLink('Notes', 'notes/', 'notes');
}

$numTasks = Tasks::countOnUser($idusers);
if ($numTasks) {
    $tasksLink = Page::imageLinkWithDescription(
        'Tasks',
        "$numTasks total.",
        'tasks/',
        'tasks'
    );
} else {
    $tasksLink = Page::imageLink('Tasks', 'tasks/', 'tasks');
}

if ($numNotifications) {
    $description = '';
    if ($numNewNotifications) {
        $notifications = Page::warnings(array("$numNewNotifications new notifications."));
        $notificationsLink = Page::imageLinkWithDescription(
            'Notifications',
            "$numNewNotifications new. $numNotifications total.",
            'notifications/',
            'notification'
        );
    } else {
        $notifications = '';
        $notificationsLink = Page::imageLinkWithDescription(
            'Notifications',
            "$numNotifications total.",
            'notifications/',
            'old-notification'
        );
    }
} else {
    $notifications = '';
    $notificationsLink = Page::imageLink(
        'Notifications',
        'notifications/',
        'old-notification'
    );
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
        $calendarLink = Page::imageLinkWithDescription(
            'Calendar',
            n_events($numEventsToday).' today. '.n_events($numEventsTomorrow).' tomorrow.',
            'calendar/',
            'calendar'
        );
    } else {
        $calendarLink = Page::imageLinkWithDescription(
            'Calendar',
            n_events($numEventsToday).' today.',
            'calendar/',
            'calendar'
        );
    }
} elseif ($numEventsTomorrow) {
    $calendarLink = Page::imageLinkWithDescription(
        'Calendar',
        n_events($numEventsTomorrow).' tomorrow.',
        'calendar/',
        'calendar'
    );
} else {
    $calendarLink = Page::imageLink('Calendar', 'calendar/', 'calendar');
}

if (array_key_exists('home_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['home_messages']);
} else {
    $pageMessages = '';
}

$page->title = 'Home';
$page->finish(
    Tab::create(
        Tab::activeItem('Home'),
        $pageMessages
        .$notifications
        .$bookmarksLink
        .Page::HR
        .$calendarLink
        .Page::HR
        .($numContacts ? Page::imageLinkWithDescription('Contacts', "$numContacts total.", 'contacts/', 'contacts') : Page::imageLink('Contacts', 'contacts/', 'contacts'))
        .Page::HR
        .($user->storageused ? Page::imageLinkWithDescription('Files', bytestr($user->storageused).' used.', 'files/', 'files') : Page::imageLink('Files', 'files/', 'files'))
        .Page::HR
        .$notesLink
        .Page::HR
        .$notificationsLink
        .Page::HR
        .$tasksLink
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
