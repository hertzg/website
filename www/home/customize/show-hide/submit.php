<?php

$dir = '../../../';

include_once "$dir/fns/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$dir/fns/require_user.php";
$user = require_user('../../../');

include_once "$dir/fns/request_strings.php";
list($bar_charts, $new_bar_chart, $bookmarks, $new_bookmark,
    $calendar, $new_event, $contacts, $new_contact, $files,
    $upload_files, $notes, $new_note, $notifications,
    $post_notification, $places, $new_place, $schedules,
    $new_schedule, $tasks, $new_task, $wallets, $new_wallet,
    $new_transaction, $transfer_amount, $trash) = request_strings(
    'bar_charts', 'new_bar_chart', 'bookmarks', 'new_bookmark',
    'calendar', 'new_event', 'contacts', 'new_contact', 'files',
    'upload_files', 'notes', 'new_note', 'notifications',
    'post_notification', 'places', 'new_place', 'schedules',
    'new_schedule', 'tasks', 'new_task', 'wallets', 'new_wallet',
    'new_transaction', 'transfer_amount', 'trash');

$bar_charts = (bool)$bar_charts;
$new_bar_chart = (bool)$new_bar_chart;
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
$post_notification = (bool)$post_notification;
$places = (bool)$places;
$new_place = (bool)$new_place;
$schedules = (bool)$schedules;
$new_schedule = (bool)$new_schedule;
$tasks = (bool)$tasks;
$new_task = (bool)$new_task;
$wallets = (bool)$wallets;
$new_wallet = (bool)$new_wallet;
$new_transaction = (bool)$new_transaction;
$transfer_amount = (bool)$transfer_amount;
$trash = (bool)$trash;

include_once "$dir/fns/Users/Home/editVisibilities.php";
include_once "$dir/lib/mysqli.php";
Users\Home\editVisibilities($mysqli, $user,
    $bar_charts, $new_bar_chart, $bookmarks, $new_bookmark,
    $calendar, $new_event, $contacts, $new_contact, $files,
    $upload_files, $notes, $new_note, $notifications,
    $post_notification, $places, $new_place, $schedules,
    $new_schedule, $tasks, $new_task, $wallets, $new_wallet,
    $new_transaction, $transfer_amount, $trash, $changed);

if ($changed) $message = 'Changes have been saved.';
else $message = 'No changes to be saved.';
$_SESSION['home/customize/show-hide/messages'] = [$message];

include_once "$dir/fns/redirect.php";
redirect();
