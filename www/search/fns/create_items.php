<?php

function create_items ($bar_charts, $num_bar_charts,
    $bookmarks, $num_bookmarks, $contacts, $num_contacts,
    $files, $num_files, $folders, $num_folders, $notes,
    $num_notes, $places, $num_places, $tasks, $num_tasks,
    $wallets, $num_wallets, $keyword, $user, $groupLimit) {

    include_once __DIR__.'/../../fns/resolve_theme.php';
    resolve_theme($user, $theme_color, $theme_brightness);

    $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';
    $encodedKeyword = rawurlencode($keyword);

    $items = [];

    if ($num_bar_charts) {
        include_once __DIR__.'/render_bar_charts.php';
        render_bar_charts($theme_brightness, $bar_charts,
            $num_bar_charts, $groupLimit, $items, $regex, $encodedKeyword);
    }

    if ($num_bookmarks) {
        include_once __DIR__.'/render_bookmarks.php';
        render_bookmarks($bookmarks, $num_bookmarks,
            $groupLimit, $items, $regex, $encodedKeyword);
    }

    if ($num_contacts) {
        include_once __DIR__.'/render_contacts.php';
        render_contacts($contacts, $num_contacts,
            $groupLimit, $items, $regex, $encodedKeyword);
    }

    if ($num_notes) {
        include_once __DIR__.'/render_notes.php';
        render_notes($theme_brightness, $notes, $num_notes,
            $groupLimit, $items, $regex, $encodedKeyword);
    }

    if ($num_places) {
        include_once __DIR__.'/render_places.php';
        render_places($theme_brightness, $places, $num_places,
            $groupLimit, $items, $regex, $encodedKeyword);
    }

    if ($num_tasks) {
        include_once __DIR__.'/render_tasks.php';
        render_tasks($theme_brightness, $tasks, $num_tasks,
            $groupLimit, $items, $regex, $encodedKeyword, $user);
    }

    if ($num_wallets) {
        include_once __DIR__.'/render_wallets.php';
        render_wallets($wallets, $num_wallets,
            $groupLimit, $items, $regex, $encodedKeyword);
    }

    if ($num_folders + $num_files) {
        include_once __DIR__.'/render_folders_and_files.php';
        render_folders_and_files($folders, $num_folders, $files,
            $num_files, $groupLimit, $items, $regex, $encodedKeyword);
    }

    return $items;

}
