<?php

namespace ViewPage;

function authsPanel ($mysqli, $connection, &$scripts) {

    if ($connection->access_time === null) return;

    $limit = 6;
    $id = $connection->id;
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/AdminConnectionAuths/indexOnAdminConnection.php";
    $auths = \AdminConnectionAuths\indexOnAdminConnection($mysqli, $id, $limit);

    $items = [];
    $hasMore = false;
    if ($auths) {
        include_once "$fnsDir/create_image_text.php";
        include_once "$fnsDir/export_date_ago.php";
        foreach ($auths as $i => $auth) {

            if ($i == $limit - 1) {
                $hasMore = true;
                break;
            }

            $text =
                htmlspecialchars($auth->remote_address)." $auth->method"
                .'<div class="imageText-description">'
                    .export_date_ago($auth->insert_time, true)
                .'</div>';
            $items[] = create_image_text($text, 'sign-in');

        }
    }

    if ($hasMore) {

        include_once "$fnsDir/SearchForm/emptyContent.php";
        $content = "<input type=\"hidden\" name=\"id\" value=\"$id\" />"
            .\SearchForm\emptyContent('Search authentications...');

        include_once "$fnsDir/SearchForm/create.php";
        $content = \SearchForm\create('../all-auths/search/', $content);

        array_unshift($items, $content);

        include_once "$fnsDir/compressed_js_script.php";
        $scripts .= compressed_js_script('searchForm', '../../../');

        include_once "$fnsDir/Page/imageArrowLink.php";
        $items[] = \Page\imageArrowLink('Full Authentication History',
            "../all-auths/?id=$id", 'sign-ins', ['id' => 'all-auths']);

    } else {

        include_once "$fnsDir/auth_expire_days.php";
        $expire_time = auth_expire_days() * 24 * 60 * 60;

        if ($connection->insert_time < time() - $expire_time) {
            include_once "$fnsDir/Page/info.php";
            $items[] = \Page\info('Older data not available');
        }

    }

    $content = join('<div class="hr"></div>', $items);

    include_once "$fnsDir/Page/panel.php";
    return \Page\panel('Authentication History', $content);

}
