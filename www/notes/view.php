<?php

include_once 'lib/require-note.php';
include_once '../fns/date_ago.php';
include_once '../fns/ifset.php';
include_once '../fns/render_external_links.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

unset(
    $_SESSION['notes/edit_errors'],
    $_SESSION['notes/index_messages']
);

$inserttime = $note->inserttime;
$updatetime = $note->updatetime;
$notetext = $note->notetext;

$modified = $inserttime != $updatetime;

$base = '../';

$page->base = $base;
$page->title = htmlspecialchars(mb_substr($notetext, 0, 20, 'UTF-8'));
$page->finish(
    Tab::create(
        Tab::item('Home', '../home.php')
        .Tab::item('Notes', 'index.php')
        .Tab::activeItem('View')
    )
    .Page::messages(ifset($_SESSION['notes/view_messages']))
    .Page::text(
        nl2br(
            render_external_links(htmlspecialchars($notetext), $base)
        )
    )
    .Page::HR
    .Page::text(
        '<div>Note created '.date_ago($inserttime).'.</div>'
        .($modified ? '<div>Last modified '.date_ago($updatetime).'.</div>' : '')
    )
    .Tab::create(
        Tab::activeItem('Options')
    )
    .Page::imageLink('Edit Note', "edit.php?id=$id", 'edit-note')
    .Page::HR
    .Page::imageLink('Delete Note', "delete.php?id=$id", 'trash-bin')
);
