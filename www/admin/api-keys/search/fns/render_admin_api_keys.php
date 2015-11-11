<?php

function render_admin_api_keys ($keyword, $apiKeys, &$items) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/time_today.php";
    $time_today = time_today();

    $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';

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
