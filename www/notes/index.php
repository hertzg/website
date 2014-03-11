<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);
$idusers = $user->idusers;

include_once '../fns/request_strings.php';
list($tag) = request_strings('tag');

$items = array();

include_once '../lib/mysqli.php';

if ($tag === '') {

    $filterMessage = '';

    include_once '../fns/Notes/indexOnUser.php';
    $notes = Notes\indexOnUser($mysqli, $idusers);

    if (count($notes) > 1) {

        include_once 'fns/create_search_form.php';
        include_once '../fns/create_search_form_empty_content.php';
        $items[] = create_search_form(
            create_search_form_empty_content('Search notes...')
        );

        include_once '../fns/NoteTags/indexOnUser.php';
        $tags = NoteTags\indexOnUser($mysqli, $idusers);
        if ($tags) {
            include_once '../fns/create_tag_filter_bar.php';
            $filterMessage = create_tag_filter_bar($tags, array());
        }

    }

} else {

    include_once '../fns/NoteTags/indexOnTagName.php';
    $notes = NoteTags\indexOnTagName($mysqli, $idusers, $tag);

    if (count($notes) > 1) {
        include_once 'fns/create_search_form.php';
        include_once '../fns/create_search_form_empty_content.php';
        $items[] = create_search_form(
            create_search_form_empty_content('Search notes...')
            .'<input type="hidden" name="tag" value="'.htmlspecialchars($tag).'" />'
        );
    }

    include_once '../fns/create_clear_filter_bar.php';
    $filterMessage = create_clear_filter_bar($tag, './');

}

include_once 'fns/render_notes.php';
render_notes($notes, $items);

unset(
    $_SESSION['home/index_messages'],
    $_SESSION['notes/new/index_errors'],
    $_SESSION['notes/new/index_lastpost'],
    $_SESSION['notes/view/index_messages']
);

include_once 'fns/create_options_panel.php';
include_once '../fns/create_tabs.php';
include_once '../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '..',
            ),
        ),
        'Notes',
        Page\sessionMessages('notes/index_messages')
        .$filterMessage.join('<div class="hr"></div>', $items)
    )
    .create_options_panel($user);

include_once '../fns/echo_page.php';
echo_page($user, 'Notes', $content, $base);
