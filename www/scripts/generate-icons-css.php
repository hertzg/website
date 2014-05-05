#!/usr/bin/php
<?php

function render (&$content, $file, array $names) {
    $content .=
        join(',', array_map(function ($name) {
            return ".icon.$name";
        }, $names))
        ."{background-image:url(images/icons/$file)}";
    $x = 0;
    foreach ($names as $name) {
        $content .= ".icon.$name{background-position:${x}px 0}";
        $x -= 32;
    }
}

include_once 'lib/require-cli.php';

$names = ['api-key', 'create-api-key', 'edit-api-key', 'api-keys'];
render($content, 'api-key.svg?1', $names);

$names = ['bookmark', 'create-bookmark', 'edit-bookmark', 'bookmarks'];
render($content, 'bookmark.svg?1', $names);

$names = ['channel', 'create-channel', 'edit-channel', 'locked-channel',
    'inactive-channel', 'create-inactive-channel', 'edit-inactive-channel',
    'locked-inactive-channel', 'channels'];
render($content, 'channel.svg?1', $names);

$names = ['connection', 'create-connection', 'edit-connection', 'connections'];
render($content, 'connection.svg?1', $names);

$names = ['contact', 'create-contact', 'edit-contact',
    'favorite-contact', 'contacts'];
render($content, 'contact.svg?1', $names);

$names = ['event', 'create-event', 'edit-event', 'events'];
render($content, 'event.svg?1', $names);

$names = ['file', 'create-file', 'files'];
render($content, 'file.svg?2', $names);

$names = ['move-up', 'move-to-top', 'move-down', 'move-to-bottom'];
render($content, 'move.svg?1', $names);

$names = ['note', 'create-note', 'edit-note', 'notes'];
render($content, 'note.svg?1', $names);

$names = ['account', 'edit-profile', 'folder', 'create-folder',
    'parent-folder', 'download', 'upload', 'feedback', 'yes', 'no',
    'notification', 'create-notification', 'old-notification', 'edit-password',
    'new-password', 'reset-password', 'randomize', 'rename', 'sign-out',
    'sign-in', 'trash-bin', 'calendar', 'arrow-right', 'arrow-left',
    'copy-file', 'move-file', 'copy-folder', 'move-folder', 'import-bookmark',
    'import-contact', 'import-file', 'import-note', 'import-task', 'search',
    'search-folder', 'birthday-cake', 'checkbox', 'checked-checkbox', 'help',
    'run', 'mail', 'send', 'receive', 'phone',
    'edit-home', 'reorder', 'show-hide', 'restore-defaults',
    'forbid-notifications', 'receive-notifications', 'generic'];
render($content, 'other.svg?2', $names);

$names = ['schedule', 'create-schedule', 'edit-schedule', 'schedules'];
render($content, 'schedule.svg?1', $names);

$names = ['subscribed-channel', 'create-subscribed-channel',
    'inactive-subscribed-channel', 'subscribed-channels'];
render($content, 'subscribed-channel.svg?1', $names);

$names = ['task', 'create-task', 'edit-task', 'task-top-priority', 'tasks'];
render($content, 'task.svg?1', $names);

$names = ['blue-theme', 'green-theme', 'orange-theme', 'pink-theme',
    'edit-blue-theme', 'edit-green-theme', 'edit-orange-theme',
    'edit-pink-theme'];
render($content, 'theme.svg?1', $names);

$names = ['token', 'create-token', 'tokens'];
render($content, 'token.svg?1', $names);

$names = ['user', 'add-user', 'remove-user', 'users'];
render($content, 'user.svg?1', $names);

file_put_contents(__DIR__.'/../icons.compressed.css', $content);
