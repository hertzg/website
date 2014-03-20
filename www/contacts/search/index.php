<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);
$idusers = $user->idusers;

include_once '../../fns/request_strings.php';
list($keyword, $tag, $offset) = request_strings(
    'keyword', 'tag', 'offset');

if ($keyword === '') {
    $url = '../';
    if ($tag !== '') $url .= '?tag='.rawurlencode($tag);
    include_once '../../fns/redirect.php';
    redirect($url);
}

$items = array();

include_once '../../fns/SearchForm/content.php';
include_once '../../fns/SearchForm/create.php';
include_once '../../lib/mysqli.php';

$searchAction = './';
$searchPlaceholder = 'Search contacts...';

$offset = abs((int)$offset);

include_once '../../fns/Paging/limit.php';
$limit = Paging\limit();

if ($tag === '') {

    $filterMessage = '';

    include_once '../../fns/Contacts/search.php';
    $contacts = Contacts\search($mysqli, $idusers, $keyword,
        $offset, $limit, $total);

    $formContent = SearchForm\content($keyword, $searchPlaceholder, '..');
    $items[] = SearchForm\create($searchAction, $formContent);

    if ($total > 1) {

        include_once '../../fns/ContactTags/indexOnUser.php';
        $tags = ContactTags\indexOnUser($mysqli, $idusers);

        if ($tags) {
            include_once '../../fns/create_tag_filter_bar.php';
            $filterMessage = create_tag_filter_bar($tags, array(
                'keyword' => $keyword,
            ));
        }

    }

} else {

    include_once '../../fns/ContactTags/searchOnTagName.php';
    $contacts = ContactTags\searchOnTagName($mysqli, $idusers, $keyword, $tag,
        $offset, $limit, $total);

    $clearHref = '../?tag='.rawurlencode($tag);
    $formContent = SearchForm\content($keyword, $searchPlaceholder, $clearHref)
        .'<input type="hidden" name="tag" value="'.htmlspecialchars($tag).'" />';
    $items[] = SearchForm\create($searchAction, $formContent);

    $clearHref = '?'.htmlspecialchars(
        http_build_query(array('keyword' => $keyword))
    );
    include_once '../../fns/create_clear_filter_bar.php';
    $filterMessage = create_clear_filter_bar($tag, $clearHref);

}

include_once 'fns/render_prev_button.php';
render_prev_button($offset, $limit, $items, $keyword, $tag);

include_once '../fns/render_contacts.php';
render_contacts($contacts, $items, 'No contacts found.', '../');

include_once 'fns/render_next_button.php';
render_next_button($offset, $limit, $total, $items, $keyword, $tag);

unset(
    $_SESSION['contacts/new/index_errors'],
    $_SESSION['contacts/new/index_lastpost'],
    $_SESSION['contacts/view/index_messages'],
    $_SESSION['home/index_messages']
);

include_once '../fns/create_options_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '../../home/',
            ),
        ),
        'Contacts',
        Page\sessionMessages('contacts/index_messages')
        .$filterMessage.join('<div class="hr"></div>', $items)
    )
    .create_options_panel($user, '../');

include_once '../../fns/echo_page.php';
echo_page($user, 'Contacts', $content, $base);
