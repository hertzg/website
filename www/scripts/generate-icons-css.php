#!/usr/bin/php
<?php

include_once 'lib/require-cli.php';

$names = ['blue-theme', 'green-theme', 'orange-theme', 'pink-theme',
    'edit-blue-theme', 'edit-green-theme', 'edit-orange-theme',
    'edit-pink-theme', 'bookmark', 'bookmarks', 'create-bookmark',
    'edit-bookmark', 'channel', 'edit-channel', 'locked-channel',
    'inactive-channel', 'edit-inactive-channel', 'locked-inactive-channel',
    'create-channel', 'channels', 'subscribed-channel',
    'inactive-subscribed-channel', 'create-subscribed-channel',
    'subscribed-channels', 'account', 'edit-profile', 'contact', 'contacts',
    'create-contact', 'edit-contact', 'favorite-contact', 'file', 'files',
    'create-file', 'folder', 'create-folder', 'parent-folder', 'note', 'notes',
    'create-note', 'edit-note', 'task', 'task-top-priority', 'tasks',
    'create-task', 'edit-task', 'download', 'upload', 'feedback', 'yes', 'no',
    'notification', 'create-notification', 'old-notification', 'edit-password',
    'new-password', 'reset-password', 'randomize', 'rename', 'sign-out',
    'sign-in', 'trash-bin', 'calendar', 'arrow-right', 'arrow-left',
    'copy-file', 'move-file', 'copy-folder', 'move-folder', 'import-bookmark',
    'import-contact', 'import-file', 'import-note', 'import-task', 'search',
    'search-folder', 'birthday-cake', 'events', 'event', 'create-event',
    'edit-event', 'checkbox', 'checked-checkbox', 'help',
    'run', 'mail', 'send', 'receive', 'phone',
    'edit-home', 'move-up', 'move-to-top', 'move-down', 'move-to-bottom',
    'reorder', 'show-hide', 'restore-defaults', 'connection',
    'create-connection', 'edit-connection', 'connections',
    'forbid-notifications', 'receive-notifications', 'user', 'add-user',
    'remove-user', 'users', 'api-keys', 'api-key', 'create-api-key',
    'edit-api-key', 'generic', 'schedule', 'create-schedule', 'edit-schedule',
    'schedules'];

$content = '';
$x = 0;
foreach ($names as $name) {
    $content .= ".icon.$name{background-position:{$x}px 0}";
    $x -= 32;
}

$names = ['token', 'create-token', 'tokens'];
$content .=
    join(',', array_map(function ($name) {
        return ".icon.$name";
    }, $names))
    .'{background-image:url(images/token-icons.svg)}';
$x = 0;
foreach ($names as $name) {
    $content .= ".icon.$name{background-position:${x}px 0}";
    $x -= 32;
}

file_put_contents(__DIR__.'/../icons.compressed.css', $content);
