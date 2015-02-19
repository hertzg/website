<?php

$dir = '../../../';

include_once "$dir/fns/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$dir/fns/require_user.php";
$user = require_user('../../../');

include_once "$dir/fns/request_strings.php";
list($bookmarks, $new_bookmark, $calendar, $new_event, $contacts,
    $new_contact, $files, $upload_files, $notes, $new_note,
    $notifications, $places, $new_place, $schedules, $tasks,
    $new_task, $wallets, $new_wallet, $trash) = request_strings(
    'bookmarks', 'new_bookmark', 'calendar', 'new_event', 'contacts',
    'new_contact', 'files', 'upload_files', 'notes', 'new_note',
    'notifications', 'places', 'new_place', 'schedules', 'tasks',
    'new_task', 'wallets', 'new_wallet', 'trash');

$bookmarks = (bool)$bookmarks;
$new_bookmark = (bool)$new_bookmark;
$calendar = (bool)$calendar;
$new_event = (bool)$new_event;
$contacts = (bool)$contacts;
$new_contact = (bool)$new_contact;
$files = (bool)$files;
$upload_files = (bool)$upload_files;
$notes = (bool)$notes;
$new_note = (bool)$new_note;
$notifications = (bool)$notifications;
$places = (bool)$places;
$new_place = (bool)$new_place;
$schedules = (bool)$schedules;
$tasks = (bool)$tasks;
$new_task = (bool)$new_task;
$wallets = (bool)$wallets;
$new_wallet = (bool)$new_wallet;
$trash = (bool)$trash;

include_once "$dir/fns/Users/Home/editVisibilities.php";
include_once "$dir/lib/mysqli.php";
Users\Home\editVisibilities($mysqli, $user->id_users, $bookmarks,
    $new_bookmark, $calendar, $new_event, $contacts, $new_contact,
    $files, $upload_files, $notes, $new_note, $notifications, $places,
    $new_place, $schedules, $tasks, $new_task, $wallets, $new_wallet, $trash);

$_SESSION['home/customize/show-hide/messages'] = ['Changes have been saved.'];

include_once "$dir/fns/redirect.php";
redirect();
