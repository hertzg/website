<?php

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id) = require_note($mysqli);

include_once '../../fns/Page/sessionMessages.php';
$pageMessages = Page\sessionMessages('notes/view/index_messages');

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

include_once '../../fns/render_external_links.php';
include_once '../../fns/Page/text.php';
$text = Page\text(
    nl2br(
        render_external_links(htmlspecialchars($notetext), $base)
    )
);

include_once '../../fns/date_ago.php';
$datesText = '<div>Note created '.date_ago($inserttime).'.</div>';
if ($inserttime != $updatetime) {
    $datesText .= '<div>Last modified '.date_ago($updatetime).'.</div>';
}
$datesText = Page\text($datesText);
        
include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/create_tags.php';
include_once '../../fns/Page/imageArrowLink.php';
$content =
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
        $pageMessages.$text.create_tags('../', $tags).'<div class="hr"></div>'.$datesText
    )
    .create_panel(
        'Options',
        Page\imageArrowLink('Edit Note', "../edit/?id=$id", 'edit-note')
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Delete Note', "../delete/?id=$id", 'trash-bin')
    );

include_once '../../fns/echo_page.php';
echo_page($user, "Note #$id", $content, $base);
