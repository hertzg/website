<?php

// TODO do not load this page if no users are present

include_once '../../fns/require_admin.php';
require_admin();

include_once '../fns/unset_session_vars.php';
unset_session_vars();

$fnsDir = '../../../fns';

include_once "$fnsDir/request_valid_keyword_tag_offset.php";
list($keyword, $tag, $offset) = request_valid_keyword_tag_offset();

include_once "$fnsDir/Paging/limit.php";
$limit = Paging\limit();

include_once "$fnsDir/Users/OrderBy/get.php";
$order_by = Users\OrderBy\get();

include_once "$fnsDir/Users/searchPage.php";
include_once '../../../lib/mysqli.php';
$users = Users\searchPage($mysqli,
    $keyword, $offset, $limit, $total, $order_by);

$params = ['keyword' => $keyword];

include_once "$fnsDir/check_offset_overflow.php";
check_offset_overflow($offset, $limit, $total, $params);

include_once "$fnsDir/SearchForm/content.php";
$formContent = SearchForm\content($keyword, 'Search users...', '../');

include_once "$fnsDir/SearchForm/create.php";
$items = [SearchForm\create('./', $formContent)];

if ($users) {

    $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';

    include_once '../fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $params);

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    foreach ($users as $user) {

        $title = htmlspecialchars($user->username);
        $title = preg_replace($regex, '<mark>$0</mark>', $title);

        $id = $user->id_users;
        $items[] = Page\imageArrowLink($title,
            '../view/'.ItemList\escapedItemQuery($id), 'user', ['id' => $id]);

    }

    include_once '../fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $params);

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No users found');
}

include_once '../fns/sort_panel.php';
include_once "$fnsDir/create_new_item_button.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/sessionMessages.php";
$content = Page\create(
    [
        'title' => 'Administration',
        'href' => '../../#users',
    ],
    'Users',
    Page\sessionErrors('admin/users/errors')
    .Page\sessionMessages('admin/users/messages')
    .join('<div class="hr"></div>', $items)
    .sort_panel($order_by, $total, '../'),
    create_new_item_button('User', '../')
);

include_once '../../fns/echo_admin_page.php';
include_once "$fnsDir/compressed_js_script.php";
echo_admin_page('Users', $content, '../../', [
    'scripts' => compressed_js_script('searchForm', '../../../'),
]);
