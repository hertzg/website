<?php

namespace SearchPage;

function renderBars ($bars, &$items, $includes) {

    $fnsDir = __DIR__.'/../../../../fns';

    if ($bars) {

        include_once "$fnsDir/keyword_regex.php";
        $regex = keyword_regex($includes);

        include_once "$fnsDir/ItemList/escapedItemQuery.php";
        include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
        foreach ($bars as $bar) {

            $description = preg_replace($regex,
                '<mark>$0</mark>', htmlspecialchars($bar->label));

            $id = $bar->id;

            $escapedItemQuery = \ItemList\escapedItemQuery($id);

            $items[] = \Page\imageArrowLinkWithDescription(
                $bar->value, $description, "../view/$escapedItemQuery",
                'bar', ['id' => $id]);

        }

    } else {
        include_once "$fnsDir/Page/info.php";
        $items[] = \Page\info('No bars found');
    }

}
