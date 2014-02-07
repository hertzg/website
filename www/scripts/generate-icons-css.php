#!/usr/bin/php
<?php

include_once 'lib/require-cli.php';

$names = array(
    'blue-theme', 'green-theme', 'orange-theme', 'pink-theme',
    'edit-blue-theme', 'edit-green-theme', 'edit-orange-theme',
    'edit-pink-theme', 'bookmark', 'bookmarks', 'create-bookmark',
    'edit-bookmark', 'channel', 'create-channel', 'channels', 'account',
    'edit-profile', 'contact', 'contacts', 'create-contact', 'edit-contact',
    'file', 'files', 'create-file', 'folder', 'create-folder', 'parent-folder',
    'note', 'notes', 'create-note', 'edit-note', 'task', 'task-done', 'tasks',
    'create-task', 'edit-task', 'download', 'upload', 'feedback', 'yes', 'no',
    'notification', 'old-notification', 'edit-password', 'new-password',
    'reset-password', 'randomize', 'rename', 'sign-out', 'sign-in', 'trash-bin',
    'calendar', 'arrow-right', 'arrow-left', 'copy-file', 'move-file',
    'copy-folder', 'move-folder', 'search', 'event', 'create-event',
    'edit-event', 'checkbox', 'checked-checkbox', 'help', 'token',
    'create-token', 'tokens');

$content = "/* auto-generated */\n";
$x = 0;
foreach ($names as $name) {
    $content .= ".icon.$name { background-position: {$x}px 0; }\n";
    $x -= 32;
}
file_put_contents(__DIR__.'/../icons.css', $content);
