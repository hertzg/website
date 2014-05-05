#!/usr/bin/php
<?php

function render (&$content, $file, array $names) {
    $content .=
        join(',', array_map(function ($name) {
            return ".icon.$name";
        }, $names))
        ."{background-image:url(images/icons/$file.svg)}";
    $x = 0;
    foreach ($names as $name) {
        $content .= ".icon.$name{background-position:${x}px 0}";
        $x -= 32;
    }
}

include_once 'lib/require-cli.php';

$names = ['api-key', 'create-api-key', 'edit-api-key', 'api-keys'];
render($content, 'api-key', $names);

$names = ['bookmark', 'create-bookmark', 'edit-bookmark', 'bookmarks'];
render($content, 'bookmark', $names);

$names = ['channel', 'create-channel', 'edit-channel', 'locked-channel',
    'inactive-channel', 'create-inactive-channel', 'edit-inactive-channel',
    'locked-inactive-channel', 'channels'];
render($content, 'channel', $names);

$names = ['connection', 'create-connection', 'edit-connection', 'connections'];
render($content, 'connection', $names);

$names = ['contact', 'create-contact', 'edit-contact',
    'favorite-contact', 'contacts'];
render($content, 'contact', $names);

$names = ['event', 'create-event', 'edit-event', 'events'];
render($content, 'event', $names);

$names = ['note', 'create-note', 'edit-note', 'notes'];
render($content, 'note', $names);

$names = ['account', 'edit-profile', 'file', 'files',
    'create-file', 'folder', 'create-folder', 'parent-folder', 'download',
    'upload', 'feedback', 'yes', 'no',
    'notification', 'create-notification', 'old-notification', 'edit-password',
    'new-password', 'reset-password', 'randomize', 'rename', 'sign-out',
    'sign-in', 'trash-bin', 'calendar', 'arrow-right', 'arrow-left',
    'copy-file', 'move-file', 'copy-folder', 'move-folder', 'import-bookmark',
    'import-contact', 'import-file', 'import-note', 'import-task', 'search',
    'search-folder', 'birthday-cake', 'checkbox', 'checked-checkbox', 'help',
    'run', 'mail', 'send', 'receive', 'phone',
    'edit-home', 'move-up', 'move-to-top', 'move-down', 'move-to-bottom',
    'reorder', 'show-hide', 'restore-defaults',
    'forbid-notifications', 'receive-notifications', 'generic'];
render($content, 'other', $names);

$names = ['schedule', 'create-schedule', 'edit-schedule', 'schedules'];
render($content, 'schedule', $names);

$names = ['subscribed-channel', 'create-subscribed-channel',
    'inactive-subscribed-channel', 'subscribed-channels'];
render($content, 'subscribed-channel', $names);

$names = ['task', 'create-task', 'edit-task', 'task-top-priority', 'tasks'];
render($content, 'task', $names);

$names = ['blue-theme', 'green-theme', 'orange-theme', 'pink-theme',
    'edit-blue-theme', 'edit-green-theme', 'edit-orange-theme',
    'edit-pink-theme'];
render($content, 'theme', $names);

$names = ['token', 'create-token', 'tokens'];
render($content, 'token', $names);

$names = ['user', 'add-user', 'remove-user', 'users'];
render($content, 'user', $names);

file_put_contents(__DIR__.'/../icons.compressed.css', $content);
