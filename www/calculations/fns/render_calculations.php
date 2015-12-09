<?php

function render_calculations ($calculations, &$items, $params, $base = '') {

    $fnsDir = __DIR__.'/../../fns';

    if ($calculations) {
        include_once __DIR__.'/create_description.php';
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

            $title = $calculation->title;
            if ($title === '') $title = $calculation->expression;
            $title = htmlspecialchars($title);

            $description = create_description($calculation);

            $items[] = Page\imageArrowLinkWithDescription(
                $title, $description, $href, $icon, $options);

        }
    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = Page\info('No calculations');
    }

}
