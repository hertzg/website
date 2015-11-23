<?php

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once "$fnsDir/request_valid_keyword_tag_offset.php";
list($keyword, $tag, $offset) = request_valid_keyword_tag_offset();

include_once "$fnsDir/Paging/limit.php";
$limit = Paging\limit();

include_once '../fns/unset_session_vars.php';
unset_session_vars();

include_once "$fnsDir/Signins/searchPageOnUser.php";
include_once '../../../lib/mysqli.php';
$signins = Signins\searchPageOnUser($mysqli,
    $user->id_users, $keyword, $offset, $limit, $total);

include_once "$fnsDir/check_offset_overflow.php";
check_offset_overflow($offset, $limit, $total);

include_once "$fnsDir/SearchForm/content.php";
$content = SearchForm\content($keyword, 'Search authentications...', '../');

include_once "$fnsDir/SearchForm/create.php";
$items = [SearchForm\create('./', $content)];

if ($signins) {

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('dateAgo', $base)
        .compressed_js_script('searchForm', $base);

    $params = ['keyword' => $keyword];
    if ($offset) $params['offset'] = $offset;

    include_once '../fns/render_prev_button.php';
    render_prev_button($offset, $limit, $total, $items, $params);

    $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';

    include_once "$fnsDir/create_image_text.php";
    include_once "$fnsDir/export_date_ago.php";
    foreach ($signins as $signin) {
        $address = htmlspecialchars($signin->remote_address);
        $text =
            preg_replace($regex, '<mark>$0</mark>', $address)
            .'<div class="imageText-description">'
                .export_date_ago($signin->insert_time, true)
            .'</div>';
        $items[] = create_image_text($text, 'sign-in');
    }

    include_once '../fns/render_next_button.php';
    render_next_button($offset, $limit, $total, $items, $params);

} else {
    $scripts = '';
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('No authentications found');
}

if ($offset + $limit >= $total) {
    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('Older data not available');
}

include_once "$fnsDir/auth_expire_days.php";
include_once "$fnsDir/Page/infoText.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Account',
            'href' => '../../#signins',
        ],
    ],
    'Authentication History',
    join('<div class="hr"></div>', $items)
    .Page\infoText(
        'Authentications older than '.auth_expire_days()
        .' days are automatically deleted.'
    )
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Authentication History', $content, $base, [
    'scripts' => $scripts,
]);
