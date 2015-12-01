<?php

namespace SearchPage;

function renderCalculations ($calculations, &$items, $params, $keyword) {

    $fnsDir = __DIR__.'/../../../fns';

    if ($calculations) {

        $regex = '/('.preg_quote(htmlspecialchars($keyword), '/').')+/i';

        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($calculations as $calculation) {

            $id = $calculation->id;
            $options = ['id' => $id];
            $queryString = htmlspecialchars(
                http_build_query(
                    array_merge(['id' => $id], $params)
                )
            );
            $href = "../view/?$queryString";

            $expression = htmlspecialchars($calculation->expression);
            $title = htmlspecialchars($calculation->title);
            $title = preg_replace($regex, '<mark>$0</mark>', $title);
            $items[] = \Page\imageArrowLinkWithDescription(
                $title, $expression, $href, 'calculation', $options);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = \Page\info('No calculations found');
    }

}
