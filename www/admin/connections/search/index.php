<?php

include_once '../../../../lib/defaults.php';

// TODO do not load this page if no connections are present

include_once '../../fns/require_admin.php';
$admin_user = require_admin();

include_once '../fns/unset_session_vars.php';
unset_session_vars();

$fnsDir = '../../../fns';

include_once "$fnsDir/request_valid_keyword_tag_offset.php";
list($keyword, $tag, $offset) = request_valid_keyword_tag_offset(
    $includes, $excludes);

include_once "$fnsDir/Paging/limit.php";
$limit = Paging\limit();

include_once "$fnsDir/AdminConnections/searchPage.php";
include_once '../../../lib/mysqli.php';
$connections = AdminConnections\searchPage($mysqli,
    $includes, $excludes, $offset, $limit, $total);

$params = ['keyword' => $keyword];

include_once "$fnsDir/check_offset_overflow.php";
check_offset_overflow($offset, $limit, $total, $params);

include_once "$fnsDir/SearchForm/content.php";
$content = SearchForm\content($keyword, 'Search connections...', '../');

include_once "$fnsDir/SearchForm/create.php";
$items = [SearchForm\create('./', $content)];

if ($connections) {

    include_once '../fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $params);

    include_once "$fnsDir/keyword_regex.php";
    $regex = keyword_regex($includes);

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/imageArrowLink.php";
    foreach ($connections as $connection) {
        $id = $connection->id;
        $title = htmlspecialchars($connection->address);
        $title = preg_replace($regex, '<mark>$0</mark>', $title);
        $href = '../view/'.ItemList\escapedItemQuery($id);
        $items[] = Page\imageArrowLink($title,
            $href, 'connection', ['id' => $id]);
    }

    include_once '../fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $params);

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No connections found');
}

include_once "$fnsDir/create_new_item_button.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
include_once "$fnsDir/Page/sessionMessages.php";
$content = Page\create(
    [
        'title' => 'Administration',
        'href' => '../../#connections',
    ],
    'Connections',
    Page\sessionErrors('admin/connections/errors')
    .Page\sessionMessages('admin/connections/messages')
    .join('<div class="hr"></div>', $items),
    create_new_item_button('Connection', '../')
);

include_once '../../fns/echo_admin_page.php';
include_once "$fnsDir/compressed_js_script.php";
echo_admin_page($admin_user, 'Connections', $content, '../../', [
    'scripts' => compressed_js_script('searchForm', '../../../'),
]);
