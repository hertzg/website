#!/usr/bin/php
<?php

include_once 'lib/require-cli.php';

$names = ['blue-theme', 'green-theme', 'orange-theme', 'pink-theme',
    'edit-blue-theme', 'edit-green-theme', 'edit-orange-theme',
    'edit-pink-theme', 'bookmark', 'bookmarks', 'create-bookmark',
    'edit-bookmark', 'channel', 'locked-channel', 'inactive-channel',
    'locked-inactive-channel', 'create-channel', 'channels',
    'subscribed-channel', 'inactive-subscribed-channel',
    'create-subscribed-channel', 'subscribed-channels', 'account',
    'edit-profile', 'contact', 'contacts', 'create-contact', 'edit-contact',
    'favorite-contact', 'file', 'files', 'create-file', 'folder',
    'create-folder', 'parent-folder', 'note', 'notes', 'create-note',
    'edit-note', 'task', 'task-top-priority', 'tasks', 'create-task',
    'edit-task', 'download', 'upload', 'feedback', 'yes', 'no', 'notification',
    'create-notification', 'old-notification', 'edit-password', 'new-password',
    'reset-password', 'randomize', 'rename', 'sign-out', 'sign-in', 'trash-bin',
    'calendar', 'arrow-right', 'arrow-left', 'copy-file', 'move-file',
    'copy-folder', 'move-folder', 'import-bookmark', 'import-contact',
    'import-file', 'import-note', 'import-task', 'search', 'search-folder',
    'birthday-cake', 'events', 'event', 'create-event', 'edit-event',
    'checkbox', 'checked-checkbox', 'help', 'token', 'create-token', 'tokens',
    'run', 'mail', 'send', 'receive', 'phone', 'edit-home', 'move-up',
    'move-to-top', 'move-down', 'move-to-bottom', 'reorder', 'show-hide',
    'restore-defaults', 'connection', 'create-connection', 'edit-connection',
    'connections', 'forbid-notifications', 'receive-notifications', 'user',
    'add-user', 'remove-user', 'users', 'lock', 'unlock'];

$content = "/* auto-generated */\n";
$x = 0;
foreach ($names as $name) {
    $content .= ".icon.$name { background-position: {$x}px 0; }\n";
    $x -= 32;
}
file_put_contents(__DIR__.'/../icons.css', $content);
