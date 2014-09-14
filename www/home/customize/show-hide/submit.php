<?php

$dir = '../../../';

include_once "$dir/fns/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$dir/fns/require_user.php";
$user = require_user('../../../');

include_once "$dir/fns/request_strings.php";
list($bookmarks, $new_bookmark, $calendar, $contacts,
    $new_contact, $files, $notes, $new_note, $notifications,
    $schedules, $tasks, $new_task, $trash) = request_strings(
    'bookmarks', 'new_bookmark', 'calendar', 'contacts',
    'new_contact', 'files', 'notes', 'new_note', 'notifications',
    'schedules', 'tasks', 'new_task', 'trash');

$bookmarks = (bool)$bookmarks;
$new_bookmark = (bool)$new_bookmark;
$calendar = (bool)$calendar;
$contacts = (bool)$contacts;
$new_contact = (bool)$new_contact;
$files = (bool)$files;
$notes = (bool)$notes;
$new_note = (bool)$new_note;
$notifications = (bool)$notifications;
$schedules = (bool)$schedules;
$tasks = (bool)$tasks;
$new_task = (bool)$new_task;
$trash = (bool)$trash;

include_once "$dir/fns/Users/Home/editVisibilities.php";
include_once "$dir/lib/mysqli.php";
Users\Home\editVisibilities($mysqli, $user->id_users, $bookmarks,
    $new_bookmark, $calendar, $contacts, $new_contact, $files, $notes,
    $new_note, $notifications, $schedules, $tasks, $new_task, $trash);

$_SESSION['home/customize/show-hide/messages'] = ['Changes have been saved.'];

include_once "$dir/fns/redirect.php";
redirect();
