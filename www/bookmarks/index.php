<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);
$idusers = $user->idusers;

include_once '../fns/request_strings.php';
list($tag) = request_strings('tag');

$items = array();

include_once '../lib/mysqli.php';

$placeholder = 'Search bookmarks...';

if ($tag === '') {

    $filterMessage = '';

    include_once '../fns/Bookmarks/indexOnUser.php';
    $bookmarks = Bookmarks\indexOnUser($mysqli, $idusers);

    if (count($bookmarks) > 1) {

        include_once '../fns/create_search_form_empty_content.php';
        $formContent = create_search_form_empty_content($placeholder);

        include_once '../fns/create_search_form.php';
        $items[] = create_search_form('search/', $formContent);

        include_once '../fns/BookmarkTags/indexOnUser.php';
        $tags = BookmarkTags\indexOnUser($mysqli, $idusers);
        if ($tags) {
            include_once '../fns/create_tag_filter_bar.php';
            $filterMessage = create_tag_filter_bar($tags, array());
        }

    }

} else {

    include_once '../fns/BookmarkTags/indexOnTagName.php';
    $bookmarks = BookmarkTags\indexOnTagName($mysqli, $idusers, $tag);

    if (count($bookmarks) > 1) {

        include_once '../fns/create_search_form_empty_content.php';
        $formContent = create_search_form_empty_content($placeholder)
            .'<input type="hidden" name="tag" value="'.htmlspecialchars($tag).'" />';

        include_once '../fns/create_search_form.php';
        $items[] = create_search_form('search/', $formContent);
    }

    include_once '../fns/create_clear_filter_bar.php';
    $filterMessage = create_clear_filter_bar($tag, './');

}

include_once 'fns/render_bookmarks.php';
render_bookmarks($bookmarks, $items);

unset(
    $_SESSION['bookmarks/new/index_errors'],
    $_SESSION['bookmarks/new/index_lastpost'],
    $_SESSION['bookmarks/view/index_messages'],
    $_SESSION['home/index_messages']
);

include_once 'fns/create_options_panel.php';
include_once '../fns/create_tabs.php';
include_once '../fns/Page/sessionErrors.php';
include_once '../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '..',
            ),
        ),
        'Bookmarks',
        Page\sessionErrors('bookmarks/index_errors')
        .Page\sessionMessages('bookmarks/index_messages')
        .$filterMessage.join('<div class="hr"></div>', $items)
    )
    .create_options_panel($user);

include_once '../fns/echo_page.php';
echo_page($user, 'Bookmarks', $content, $base);
