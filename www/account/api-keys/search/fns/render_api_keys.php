<?php

function render_api_keys ($user, $includes, $apiKeys, &$items) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/user_time_today.php";
    $time_today = user_time_today($user);

    include_once "$fnsDir/keyword_regex.php";
    $regex = keyword_regex($includes);

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    foreach ($apiKeys as $apiKey) {

        $access_time = $apiKey->access_time;
        $descriptions = [];

        $expire_time = $apiKey->expire_time;
        if ($expire_time !== null && $expire_time < $time_today) {
            $descriptions[] = 'Expired.';
        }

        if ($access_time === null) $descriptions[] = 'Never accessed.';
        else {
            include_once "$fnsDir/export_date_ago.php";
            $descriptions[] = 'Last accessed '
                .export_date_ago($access_time).'.';
        }
        $description = join(' ', $descriptions);

        $title = htmlspecialchars($apiKey->name);
        $title = preg_replace($regex, '<mark>$0</mark>', $title);

        $id = $apiKey->id;
        $items[] = Page\imageArrowLinkWithDescription($title,
            $description, '../view/'.ItemList\escapedItemQuery($id),
            'api-key', ['id' => $id]);

    }

}
