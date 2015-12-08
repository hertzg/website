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

            $title = htmlspecialchars($calculation->title);
            $title = preg_replace($regex, '<mark>$0</mark>', $title);

            $value = $calculation->value;
            if ($value === null) {
                $description =
                    '<span class="colorText red">Uncomputable.</span>';
            } else {
                $description = number_format($value, 2);
            }

            $items[] = \Page\imageArrowLinkWithDescription(
                $title, $description, $href, 'calculation', $options);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = \Page\info('No calculations found');
    }

}
