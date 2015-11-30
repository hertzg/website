<?php

function render_calculations ($calculations, &$items, $params, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    if ($calculations) {

        include_once "$fnsDir/Page/imageArrowLink.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";

        $icon = 'calculation';
        foreach ($calculations as $calculation) {

            $id = $calculation->id;
            $options = ['id' => $id];
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );
            $href = "{$base}view/?$queryString";

            $escapedUrl = htmlspecialchars($calculation->url);
            $title = $calculation->title;
            if ($title === '') {
                $items[] = Page\imageArrowLink(
                    $escapedUrl, $href, $icon, $options);
            } else {
                $title = htmlspecialchars($title);
                $items[] = Page\imageArrowLinkWithDescription($title,
                    $escapedUrl, $href, $icon, $options);
            }

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No calculations');
    }

}
