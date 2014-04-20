<?php

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id, $user) = require_note($mysqli);

unset(
    $_SESSION['notes/edit/errors'],
    $_SESSION['notes/edit/values'],
    $_SESSION['notes/errors'],
    $_SESSION['notes/messages'],
    $_SESSION['notes/send/errors'],
    $_SESSION['notes/send/values']
);

$base = '../../';

$items = [];

include_once '../../fns/render_external_links.php';
include_once '../../fns/Page/text.php';
$items[] = Page\text(
    nl2br(
        render_external_links(htmlspecialchars($note->text), $base)
    )
);

include_once '../../fns/NoteTags/indexOnNote.php';
$tags = NoteTags\indexOnNote($mysqli, $id);
if ($tags) {
    include_once '../../fns/Page/tags.php';
    $items[] = Page\tags('../', $tags);
}

$insert_time = $note->insert_time;
$update_time = $note->update_time;
include_once '../../fns/date_ago.php';
$text = '<div>Note created '.date_ago($insert_time).'.</div>';
if ($insert_time != $update_time) {
    $text .= '<div>Last modified '.date_ago($update_time).'.</div>';
}
include_once '../../fns/Page/infoText.php';
$items[] = Page\infoText($text);

include_once 'fns/create_options_panel.php';
include_once '../../fns/ItemList/listHref.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../../home/',
            ],
            [
                'title' => 'Notes',
                'href' => ItemList\listHref(),
            ],
        ],
        "Note #$id",
        Page\sessionMessages('notes/view/messages')
        .join('<div class="hr"></div>', $items)
    )
    .create_options_panel($id);

include_once '../../fns/echo_page.php';
echo_page($user, "Note #$id", $content, $base);
