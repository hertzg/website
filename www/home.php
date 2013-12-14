<?php

function n_events ($n) {
    if ($n == 1) return '1 event';
    return "$n events";
}

include_once 'lib/require-user.php';
include_once 'fns/bytestr.php';
include_once 'fns/create_panel.php';
include_once 'fns/ifset.php';
include_once 'classes/Bookmarks.php';
include_once 'classes/Contacts.php';
include_once 'classes/Events.php';
include_once 'classes/Notes.php';
include_once 'classes/Notifications.php';
include_once 'classes/Page.php';
include_once 'classes/Tab.php';
include_once 'classes/Tasks.php';

setcookie('username', $user->username, time() + 7 * 25 * 60 * 60);

unset(
    $_SESSION['account_messages'],
    $_SESSION['bookmarks/index_messages'],
    $_SESSION['calendar/index_messages'],
    $_SESSION['contacts/index_messages'],
    $_SESSION['notes/index_messages'],
    $_SESSION['notifications_messages'],
    $_SESSION['feedback_errors'],
    $_SESSION['feedback_lastpost'],
    $_SESSION['files/index_messages'],
    $_SESSION['tasks/index_messages']
);

$numContacts = Contacts::countOnUser($idusers);
$numNotifications = Notifications::countOnUser($idusers);
$numNewNotifications = $user->numnotifications;

$numBookmarks = Bookmarks::countOnUser($idusers);
if ($numBookmarks) {
    $bookmarksLink = Page::imageLinkWithDescription('Bookmarks', "$numBookmarks total.", 'bookmarks/index.php', 'bookmarks');
} else {
    $bookmarksLink = Page::imageLink('Bookmarks', 'bookmarks/index.php', 'bookmarks');
}

$numNotes = Notes::countOnUser($idusers);
if ($numNotes) {
    $notesLink = Page::imageLinkWithDescription('Notes', "$numNotes total.", 'notes/index.php', 'notes');
} else {
    $notesLink = Page::imageLink('Notes', 'notes/index.php', 'notes');
}

$numTasks = Tasks::countOnUser($idusers);
if ($numTasks) {
    $tasksLink = Page::imageLinkWithDescription('Tasks', "$numTasks total.", 'tasks/index.php', 'tasks');
} else {
    $tasksLink = Page::imageLink('Tasks', 'tasks/index.php', 'tasks');
}

if ($numNotifications) {
    $description = '';
    if ($numNewNotifications) {
        $notifications = Page::warnings(array("$numNewNotifications new notifications."));
        $notificationsLink = Page::imageLinkWithDescription(
            'Notifications',
            "$numNewNotifications new. $numNotifications total.",
            'notifications.php',
            'notification'
        );
    } else {
        $notifications = '';
        $notificationsLink = Page::imageLinkWithDescription(
            'Notifications',
            "$numNotifications total.",
            'notifications.php',
            'old-notification'
        );
    }
} else {
    $notifications = '';
    $notificationsLink = Page::imageLink('Notifications', 'notifications.php', 'old-notification');
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
        $calendarLink = Page::imageLinkWithDescription('Calendar', n_events($numEventsToday).' today. '.n_events($numEventsTomorrow).' tomorrow.', 'calendar/index.php', 'calendar');
    } else {
        $calendarLink = Page::imageLinkWithDescription('Calendar', n_events($numEventsToday).' today.', 'calendar/index.php', 'calendar');
    }
} elseif ($numEventsTomorrow) {
    $calendarLink = Page::imageLinkWithDescription('Calendar', n_events($numEventsTomorrow).' tomorrow.', 'calendar/index.php', 'calendar');
} else {
    $calendarLink = Page::imageLink('Calendar', 'calendar/index.php', 'calendar');
}

$page->title = 'Home';
$page->finish(
    Tab::create(
        Tab::activeItem('Home'),
        Page::messages(ifset($_SESSION['home_messages']))
        .$notifications
        .$bookmarksLink
        .Page::HR
        .$calendarLink
        .Page::HR
        .($numContacts ? Page::imageLinkWithDescription('Contacts', "$numContacts total.", 'contacts/index.php', 'contacts') : Page::imageLink('Contacts', 'contacts/index.php', 'contacts'))
        .Page::HR
        .($user->storageused ? Page::imageLinkWithDescription('Files', bytestr($user->storageused).' used.', 'files/index.php', 'files') : Page::imageLink('Files', 'files/index.php', 'files'))
        .Page::HR
        .$notesLink
        .Page::HR
        .$notificationsLink
        .Page::HR
        .$tasksLink
    )
    .create_panel(
        'Options',
        Page::imageLink('Account', 'account.php', 'account')
        .Page::HR
        .Page::imageLink('Leave Feedback', 'feedback.php', 'feedback')
        .Page::HR
        .Page::imageLink('Sign Out', 'submit-signout.php', 'signout')
    )
);
