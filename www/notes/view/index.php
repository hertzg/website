<?php

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id) = require_note($mysqli);

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tags.php';
include_once '../../fns/date_ago.php';
include_once '../../fns/render_external_links.php';
include_once '../../lib/page.php';

if (array_key_exists('notes/view/index_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['notes/view/index_messages']);
} else {
    $pageMessages = '';
}

unset(
    $_SESSION['notes/edit_errors'],
    $_SESSION['notes/edit_lastpost'],
    $_SESSION['notes/index_messages']
);

$inserttime = $note->inserttime;
$updatetime = $note->updatetime;
$notetext = $note->notetext;

include_once '../../fns/NoteTags/indexOnNote.php';
$tags = NoteTags\indexOnNote($mysqli, $id);

$base = '../../';

include_once '../../fns/create_tabs.php';

$page->base = $base;
$page->title = "Note #$id";
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Notes',
                'href' => '..',
            ),
        ),
        "Note #$id",
        $pageMessages
        .Page::text(
            nl2br(
                render_external_links(htmlspecialchars($notetext), $base)
            )
        )
        .create_tags('../', $tags)
        .Page::HR
        .Page::text(
            '<div>Note created '.date_ago($inserttime).'.</div>'
            .($inserttime != $updatetime ? '<div>Last modified '.date_ago($updatetime).'.</div>' : '')
        )
    )
    .create_panel(
        'Options',
        Page::imageArrowLink('Edit Note', "../edit/?id=$id", 'edit-note')
        .Page::HR
        .Page::imageArrowLink('Delete Note', "../delete/?id=$id", 'trash-bin')
    )
);
