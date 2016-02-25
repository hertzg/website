<?php

include_once '../../../../lib/defaults.php';

// TODO do not load this page if no invalid signins are present

include_once '../../fns/require_admin.php';
$admin_user = require_admin();

include_once '../fns/unset_session_vars.php';
unset_session_vars();

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/request_valid_keyword_tag_offset.php";
list($keyword, $tag, $offset) = request_valid_keyword_tag_offset();

include_once "$fnsDir/Paging/limit.php";
$limit = Paging\limit();

include_once "$fnsDir/InvalidSignins/searchPage.php";
include_once '../../../lib/mysqli.php';
$invalidSignins = InvalidSignins\searchPage(
    $mysqli, $keyword, $offset, $limit, $total);

$params = ['keyword' => $keyword];

include_once "$fnsDir/check_offset_overflow.php";
check_offset_overflow($offset, $limit, $total, $params);

include_once "$fnsDir/SearchForm/content.php";
$content = SearchForm\content($keyword, 'Search signins...', '../');

include_once "$fnsDir/SearchForm/create.php";
$items = [SearchForm\create('./', $content)];

include_once "$fnsDir/compressed_js_script.php";
$scripts = compressed_js_script('searchForm', $base);

if ($invalidSignins) {

    $scripts .= compressed_js_script('dateAgo', $base);

    include_once '../fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $params);

    $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';

    include_once "$fnsDir/create_image_text.php";
    include_once "$fnsDir/export_date_ago.php";
    foreach ($invalidSignins as $invalidSignin) {
        $username = htmlspecialchars($invalidSignin->username);
        $address = htmlspecialchars($invalidSignin->remote_address);
        $text =
            preg_replace($regex, '<mark>$0</mark>', $username).'<br />'
            .'From '.preg_replace($regex, '<mark>$0</mark>', $address)
            .'<div class="imageText-description">'
                .export_date_ago($invalidSignin->insert_time, true)
            .'</div>';
        $items[] = create_image_text($text, 'invalid-sign-in');
    }

    include_once '../fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $params);

} else {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No signins found');
}

if ($offset + $limit >= $total) {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('Older data not available');
}

include_once "$fnsDir/auth_expire_days.php";
include_once "$fnsDir/Page/infoText.php";
include_once "$fnsDir/Page/create.php";
$content = Page\create(
    [
        'title' => 'Administration',
        'href' => '../../#invalid-signins',
    ],
    'Invalid Signins',
    join('<div class="hr"></div>', $items)
    .Page\infoText(
        'Signins older than '.auth_expire_days()
        .' days are automatically deleted.'
    )
);

include_once '../../fns/echo_admin_page.php';
echo_admin_page($admin_user, 'Invalid Signins',
    $content, '../../', ['scripts' => $scripts]);
