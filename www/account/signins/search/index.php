<?php

include_once '../../../../lib/defaults.php';

include_once '../../fns/require_user_with_password.php';
$user = require_user_with_password('../../');

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/request_valid_keyword_tag_offset.php";
request_valid_keyword_tag_offset($keyword, $tag, $offset, $includes, $excludes);

include_once "$fnsDir/Paging/limit.php";
$limit = Paging\limit();

include_once '../fns/unset_session_vars.php';
unset_session_vars();

include_once "$fnsDir/Signins/searchPageOnUser.php";
include_once '../../../lib/mysqli.php';
$signins = Signins\searchPageOnUser($mysqli, $user->id_users,
    $includes, $excludes, $offset, $limit, $total);

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

    include_once "$fnsDir/keyword_regex.php";
    $regex = keyword_regex($includes);

    $replace = '<mark>$0</mark>';

    include_once "$fnsDir/create_image_text.php";
    include_once "$fnsDir/export_date_ago.php";
    foreach ($signins as $signin) {

        $user_agent = $signin->user_agent;
        if ($user_agent === null) $user_agent_html = '';
        else {
            $user_agent_html = '<br />'
                .preg_replace($regex, $replace, htmlspecialchars($user_agent));
        }

        $text =
            preg_replace($regex, $replace,
                htmlspecialchars($signin->remote_address))
            .$user_agent_html
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

include_once "$fnsDir/auth_expire_days.php";
$auth_expire_days = auth_expire_days();

if ($offset + $limit >= $total &&
    $user->insert_time < time() - $auth_expire_days * 24 * 60 * 60) {

    include_once "$fnsDir/Page/info.php";
    $items[] = Page\info('Older data not available');

}

include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/infoText.php";
$content = Page\create(
    [
        'title' => 'Account',
        'href' => '../../#signins',
    ],
    'Authentication History',
    join('<div class="hr"></div>', $items)
    .Page\infoText(
        "Authentications older than $auth_expire_days"
        .' days are automatically deleted.'
    )
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Authentication History', $content, $base, [
    'scripts' => $scripts,
]);
