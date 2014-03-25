<?php

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);

unset(
    $_SESSION['notes/edit/index_errors'],
    $_SESSION['notes/edit/index_values'],
    $_SESSION['notes/index_errors'],
    $_SESSION['notes/index_messages']
);

$base = '../../';

$items = array();

include_once '../../fns/render_external_links.php';
include_once '../../fns/Page/text.php';
$items[] = Page\text(
    nl2br(
        render_external_links(htmlspecialchars($note->notetext), $base)
    )
);

include_once '../../fns/NoteTags/indexOnNote.php';
$tags = NoteTags\indexOnNote($mysqli, $id);
if ($tags) {
    include_once '../../fns/create_tags.php';
    $items[] = create_tags('../', $tags);
}

$insert_time = $note->insert_time;
$update_time = $note->update_time;
include_once '../../fns/date_ago.php';
$text = '<div>Note created '.date_ago($insert_time).'.</div>';
if ($insert_time != $update_time) {
    $text .= '<div>Last modified '.date_ago($update_time).'.</div>';
}
$items[] = Page\text($text);

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../../home/',
            ),
            array(
                'title' => 'Notes',
                'href' => '..',
            ),
        ),
        "Note #$id",
        Page\sessionMessages('notes/view/index_messages')
        .join('<div class="hr"></div>', $items)
    )
    .create_panel(
        'Options',
        Page\imageArrowLink('Edit Note', "../edit/?id=$id", 'edit-note')
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Delete Note', "../delete/?id=$id", 'trash-bin')
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Note #$id", $content, $base);
