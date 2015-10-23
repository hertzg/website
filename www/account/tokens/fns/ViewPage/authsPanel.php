<?php

namespace ViewPage;

function authsPanel ($mysqli, $id) {

    $limit = 6;
    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/TokenAuths/indexOnToken.php";
    $auths = \TokenAuths\indexOnToken($mysqli, $id, $limit);

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
                htmlspecialchars($auth->remote_address)
                .'<div class="imageText-description">'
                    .export_date_ago($auth->insert_time, true)
                .'</div>';
            $items[] = create_image_text($text, 'sign-in');

        }
    }

    if ($hasMore) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items[] = \Page\imageArrowLink('Full Authentication History',
            "../all-auths/?id=$id", 'sign-ins', ['id' => 'all-auths']);
    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = \Page\info('Older data not available');
    }

    $content = join('<div class="hr"></div>', $items);

    include_once "$fnsDir/create_panel.php";
    return create_panel('Authentication History', $content);

}
