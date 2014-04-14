<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../../fns/require_user.php';
$user = require_user('../../../');

include_once '../../../fns/request_strings.php';
list($bookmarks, $new_bookmark, $calendar, $contacts, $new_contact, $files,
    $notes, $new_note, $notifications, $tasks, $new_task) = request_strings(
    'bookmarks', 'new_bookmark', 'calendar', 'contacts', 'new_contact', 'files',
    'notes', 'new_note', 'notifications', 'tasks', 'new_task');

$bookmarks = (bool)$bookmarks;
$new_bookmark = (bool)$new_bookmark;
$calendar = (bool)$calendar;
$contacts = (bool)$contacts;
$new_contact = (bool)$new_contact;
$files = (bool)$files;
$notes = (bool)$notes;
$new_note = (bool)$new_note;
$notifications = (bool)$notifications;
$tasks = (bool)$tasks;
$new_task = (bool)$new_task;

include_once '../../../fns/Users/showHomeItems.php';
include_once '../../../lib/mysqli.php';
Users\showHomeItems($mysqli, $user->id_users, $bookmarks, $new_bookmark,
    $calendar, $contacts, $new_contact, $files, $notes, $new_note,
    $notifications, $tasks, $new_task);

$_SESSION['home/customize/show-hide/messages'] = ['Changes have been saved.'];

include_once '../../../fns/redirect.php';
redirect();
