<?php

include_once 'lib/require-user.php';
include_once '../fns/create_panel.php';
include_once '../fns/ifset.php';
include_once '../fns/request_strings.php';
include_once '../classes/Notes.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

list($keyword) = request_strings('keyword');

$items = array();

if ($keyword === '') {
    $notes = Notes::index($idusers);
    if (count($notes) > 1) {
        $items[] =
            '<form action="index.php" style="background: #fff; height: 48px; position: relative">'
                .'<div style="position: absolute; top: 0; right: 48px; bottom: 0; left: 0">'
                    .'<input type="text" name="keyword" value="'.htmlspecialchars($keyword).'"'
                    .' placeholder="Search notes..." style="padding: 0 12px; width: 100%; height: 100%; cursor: text" />'
                .'</div>'
                .'<button class="clickable" style="position: absolute; top: 0; right: 0; bottom: 0; width: 48px; text-align: center">'
                    .'<span class="icon search"></span>'
                .'</button>'
            .'</form>';
    }
} else {
    $notes = Notes::search($idusers, $keyword);
    $items[] =
        '<form action="index.php" style="background: #fff; height: 48px; position: relative">'
            .'<div style="position: absolute; top: 0; right: 96px; bottom: 0; left: 0">'
                .'<input type="text" name="keyword" value="'.htmlspecialchars($keyword).'"'
                .' placeholder="Search notes..." style="padding: 0 12px; width: 100%; height: 100%; cursor: text" />'
            .'</div>'
            .'<button class="clickable" style="position: absolute; top: 0; right: 48px; bottom: 0; width: 48px; text-align: center">'
                .'<span class="icon search"></span>'
            .'</button>'
            .'<a href="index.php" class="clickable" style="position: absolute; top: 0; right: 0; bottom: 0; width: 48px; text-align: center; line-height: 48px">'
                .'<div class="icon no" style="vertical-align: middle"></div>'
            .'</a>'
        .'</form>';
}

if ($notes) {
    foreach ($notes as $note) {
        $items[] = Page::imageLink(htmlspecialchars($note->notetext), "view.php?id=$note->idnotes", 'note');
    }
} else {
    $items[] = Page::info('No notes.');
}

unset(
    $_SESSION['home_messages'],
    $_SESSION['notes/add_errors'],
    $_SESSION['notes/edit_errors'],
    $_SESSION['notes/view_messages']
);

$page->base = '../';
$page->title = 'Notes';
$page->finish(
    Tab::create(
        Tab::activeItem('Notes')
    )
    .Page::messages(ifset($_SESSION['notes/index_messages']))
    .join(Page::HR, $items)
    .create_panel(
        'Options',
        Page::imageLink('New Note', 'add.php', 'create-note')
    )
);
