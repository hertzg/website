#!/usr/bin/php
<?php

function render (&$content, $file, $names) {
    $content .=
        join(',', array_map(function ($name) {
            return ".icon.$name";
        }, $names))
        ."{background-image:url(../../images/iconsets/$file)}";
    $x = 0;
    foreach ($names as $name) {
        $content .= ".icon.$name{background-position:${x}px 0}";
        $x -= 32;
    }
}

chdir(__DIR__);
include_once '../../../lib/cli.php';

$names = ['api-key', 'create-api-key', 'edit-api-key', 'api-keys'];
render($content, 'api-key.svg?2', $names);

$names = ['bar', 'create-bar', 'edit-bar', 'bars', 'duplicate-bar'];
render($content, 'bar.svg?2', $names);

$names = ['bar-chart', 'create-bar-chart', 'edit-bar-chart', 'bar-charts'];
render($content, 'bar-chart.svg?1', $names);

$names = ['bookmark', 'create-bookmark', 'edit-bookmark',
    'bookmarks', 'import-bookmark', 'duplicate-bookmark'];
render($content, 'bookmark.svg?4', $names);

render($content, 'calendar.svg?1', ['calendar', 'calendar-jump']);

$names = ['channel', 'create-channel', 'edit-channel', 'locked-channel',
    'inactive-channel', 'create-inactive-channel', 'edit-inactive-channel',
    'locked-inactive-channel', 'channels'];
render($content, 'channel.svg?2', $names);

$names = ['connection', 'create-connection', 'edit-connection', 'connections'];
render($content, 'connection.svg?2', $names);

$names = ['contact', 'create-contact', 'edit-contact',
    'favorite-contact', 'contacts', 'import-contact', 'duplicate-contact'];
render($content, 'contact.svg?4', $names);

$names = ['event', 'create-event', 'edit-event', 'events', 'duplicate-event'];
render($content, 'event.svg?3', $names);

$names = ['unknown-file', 'audio-file', 'image-file', 'video-file',
    'text-file', 'files', 'copy-file', 'move-file', 'import-file'];
render($content, 'file.svg?7', $names);

$names = ['folder', 'create-folder',
    'copy-folder', 'move-folder', 'import-folder'];
render($content, 'folder.svg?6', $names);

$names = ['invitation', 'create-invitation', 'edit-invitation', 'invitations'];
render($content, 'invitation.svg?1', $names);

$names = ['move-up', 'move-to-top', 'move-down', 'move-to-bottom'];
render($content, 'move.svg?2', $names);

$names = ['note', 'create-note', 'edit-note',
    'encrypted-note', 'notes', 'import-note', 'duplicate-note'];
render($content, 'note.svg?5', $names);

$names = ['place', 'create-place', 'edit-place',
    'places', 'import-place', 'duplicate-place', 'place-on-earth'];
render($content, 'place.svg?3', $names);

$names = ['point', 'create-point', 'edit-point', 'points'];
render($content, 'point.svg?1', $names);

$names = ['account', 'edit-profile', 'download', 'upload', 'feedback',
    'yes', 'no', 'notification', 'create-notification', 'old-notification',
    'edit-password', 'new-password', 'reset-password', 'rename',
    'sign-in', 'sign-ins', 'arrow-right', 'arrow-left',
    'search', 'search-folder', 'birthday-cake', 'checkbox',
    'checked-checkbox', 'help', 'run', 'mail', 'sms', 'send',
    'send-sms', 'receive', 'phone', 'edit-home', 'reorder',
    'show-hide', 'restore-defaults', 'forbid-notifications',
    'receive-notifications', 'generic', 'slideshow', 'locate'];
render($content, 'other.svg?17', $names);

$names = ['schedule', 'create-schedule',
    'edit-schedule', 'schedules', 'duplicate-schedule'];
render($content, 'schedule.svg?3', $names);

$names = ['subscribed-channel', 'create-subscribed-channel',
    'inactive-subscribed-channel', 'subscribed-channels'];
render($content, 'subscribed-channel.svg?2', $names);

$names = ['task', 'create-task', 'edit-task',
    'task-top-priority', 'tasks', 'import-task', 'duplicate-task'];
render($content, 'task.svg?4', $names);

$names = ['blue-theme', 'green-theme', 'orange-theme', 'pink-theme',
    'edit-blue-theme', 'edit-green-theme', 'edit-orange-theme',
    'edit-pink-theme'];
render($content, 'theme.svg?2', $names);

$names = ['token', 'create-token', 'tokens'];
render($content, 'token.svg?2', $names);

$names = ['user', 'add-user', 'remove-user', 'users'];
render($content, 'user.svg?2', $names);

$names = ['archive', 'unarchive', 'archive-file'];
render($content, 'archive.svg?3', $names);

$names = ['trash-bin', 'empty-trash', 'purge'];
render($content, 'trash.svg?1', $names);

$names = ['edit-contact-photo', 'clear-contact-photo'];
render($content, 'contact-photo.svg?1', $names);

$names = ['rotate-image-cw', 'rotate-image-ccw'];
render($content, 'edit-image.svg?1', $names);

$names = ['wallet', 'create-wallet',
    'edit-wallet', 'wallets', 'transfer-amount'];
render($content, 'wallet.svg?2', $names);

$names = ['transaction', 'create-transaction',
    'edit-transaction', 'transactions', 'duplicate-transaction'];
render($content, 'transaction.svg?2', $names);

render($content, 'protocol.svg?1', ['protocol']);

file_put_contents(__DIR__.'/compressed.css', $content);
