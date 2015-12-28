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

render($content, 'api-doc.svg?1', ['api-namespace', 'api-method', 'api-doc']);

$names = ['api-key', 'create-api-key', 'edit-api-key', 'api-keys'];
render($content, 'api-key.svg?3', $names);

render($content, 'archive.svg?3', ['archive', 'unarchive', 'archive-file']);

$names = ['bar', 'create-bar', 'edit-bar', 'bars', 'duplicate-bar'];
render($content, 'bar.svg?3', $names);

$names = ['bar-chart', 'create-bar-chart', 'edit-bar-chart', 'bar-charts'];
render($content, 'bar-chart.svg?2', $names);

$names = ['bookmark', 'create-bookmark', 'edit-bookmark',
    'bookmarks', 'import-bookmark', 'duplicate-bookmark'];
render($content, 'bookmark.svg?5', $names);

$names = ['calculation', 'create-calculation', 'edit-calculation',
    'calculations', 'import-calculation', 'duplicate-calculation'];
render($content, 'calculation.svg', $names);

render($content, 'calendar.svg?1', ['calendar', 'calendar-jump']);

$names = ['channel', 'create-channel', 'edit-channel', 'locked-channel',
    'inactive-channel', 'create-inactive-channel', 'edit-inactive-channel',
    'locked-inactive-channel', 'channels'];
render($content, 'channel.svg?3', $names);

$names = ['connection', 'create-connection', 'edit-connection', 'connections'];
render($content, 'connection.svg?3', $names);

$names = ['contact', 'create-contact', 'edit-contact',
    'favorite-contact', 'contacts', 'import-contact', 'duplicate-contact'];
render($content, 'contact.svg?5', $names);

$names = ['edit-contact-photo', 'clear-contact-photo'];
render($content, 'contact-photo.svg?1', $names);

$names = ['rotate-image-cw', 'rotate-image-ccw'];
render($content, 'edit-image.svg?1', $names);

$names = ['event', 'create-event', 'edit-event', 'events', 'duplicate-event'];
render($content, 'event.svg?4', $names);

$names = ['unknown-file', 'audio-file', 'image-file', 'video-file',
    'text-file', 'files', 'copy-file', 'move-file', 'import-file'];
render($content, 'file.svg?7', $names);

$names = ['folder', 'create-folder',
    'copy-folder', 'move-folder', 'import-folder'];
render($content, 'folder.svg?7', $names);

$names = ['invitation', 'create-invitation', 'edit-invitation', 'invitations'];
render($content, 'invitation.svg?2', $names);

$names = ['password', 'edit-password', 'new-password', 'reset-password'];
render($content, 'key.svg?3', $names);

$names = ['move-up', 'move-to-top', 'move-down', 'move-to-bottom'];
render($content, 'move.svg?2', $names);

$names = ['note', 'create-note', 'edit-note',
    'encrypted-note', 'notes', 'import-note', 'duplicate-note'];
render($content, 'note.svg?6', $names);

$names = ['notification', 'create-notification', 'old-notification'];
render($content, 'notification.svg?1', $names);

$names = ['account', 'edit-profile', 'download', 'upload',
    'feedback', 'yes', 'no', 'rename', 'sign-in', 'sign-ins',
    'invalid-sign-in', 'invalid-sign-ins', 'arrow-right', 'arrow-left',
    'search', 'search-folder', 'birthday-cake', 'checkbox',
    'checked-checkbox', 'help', 'run', 'mail', 'sms', 'send',
    'send-sms', 'receive', 'phone', 'edit-home', 'reorder',
    'show-hide', 'restore-defaults', 'forbid-notifications',
    'receive-notifications', 'generic', 'zvini',
    'slideshow', 'locate', 'license'];
render($content, 'other.svg?26', $names);

$names = ['place', 'create-place', 'edit-place',
    'places', 'import-place', 'duplicate-place', 'place-on-earth'];
render($content, 'place.svg?4', $names);

$names = ['point', 'create-point', 'edit-point', 'points'];
render($content, 'point.svg?2', $names);

render($content, 'protocol.svg?1', ['protocol']);

$names = ['schedule', 'create-schedule', 'edit-schedule',
    'schedules', 'import-schedule', 'duplicate-schedule'];
render($content, 'schedule.svg?5', $names);

$names = ['sort-alphabetic', 'sort-time', 'sort-numeric'];
render($content, 'sort.svg?1', $names);

$names = ['subscribed-channel', 'create-subscribed-channel',
    'inactive-subscribed-channel', 'subscribed-channels'];
render($content, 'subscribed-channel.svg?3', $names);

$names = ['task', 'create-task', 'edit-task',
    'task-top-priority', 'tasks', 'import-task', 'duplicate-task'];
render($content, 'task.svg?5', $names);

$names = [
    'blue-light-theme', 'lime-light-theme',
    'orange-light-theme', 'pink-light-theme',
    'cyan-light-theme', 'violet-light-theme',
    'blue-dark-theme', 'lime-dark-theme',
    'orange-dark-theme', 'pink-dark-theme',
    'cyan-dark-theme', 'violet-dark-theme',
    'blue-auto-theme', 'lime-auto-theme', 'orange-auto-theme',
    'pink-auto-theme', 'cyan-auto-theme',
    'violet-auto-theme', 'edit-blue-light-theme',
    'edit-lime-light-theme', 'edit-orange-light-theme',
    'edit-pink-light-theme', 'edit-cyan-light-theme', 'edit-violet-light-theme',
    'edit-blue-dark-theme', 'edit-lime-dark-theme',
    'edit-orange-dark-theme', 'edit-pink-dark-theme',
    'edit-cyan-dark-theme', 'edit-violet-dark-theme',
    'edit-blue-auto-theme', 'edit-lime-auto-theme',
    'edit-orange-auto-theme', 'edit-pink-auto-theme',
    'edit-cyan-auto-theme', 'edit-violet-auto-theme'];
render($content, 'theme.svg?8', $names);

$names = ['token', 'create-token', 'tokens'];
render($content, 'token.svg?3', $names);

$names = ['transaction', 'create-transaction',
    'edit-transaction', 'transactions', 'duplicate-transaction'];
render($content, 'transaction.svg?3', $names);

$names = ['trash-bin', 'empty-trash', 'purge'];
render($content, 'trash.svg?1', $names);

$names = ['user', 'add-user', 'remove-user', 'users'];
render($content, 'user.svg?3', $names);

$names = ['wallet', 'create-wallet',
    'edit-wallet', 'wallets', 'transfer-amount'];
render($content, 'wallet.svg?3', $names);

file_put_contents(__DIR__.'/compressed.css', $content);
