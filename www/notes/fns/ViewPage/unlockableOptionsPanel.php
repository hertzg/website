<?php

namespace ViewPage;

function unlockableOptionsPanel ($note) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ItemList/escapedItemQuery.php";
    $escapedItemQuery = \ItemList\escapedItemQuery($note->id);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $unlockLink = \Page\imageArrowLink('Unlock',
        "../unlock/$escapedItemQuery", 'password', []);

    include_once "$fnsDir/Page/imageLink.php";
    $deleteLink = \Page\imageLink('Delete',
        "../delete/$escapedItemQuery", 'trash-bin', ['id' => 'delete']);

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $content = \Page\staticTwoColumns($unlockLink, $deleteLink);

    include_once "$fnsDir/Page/panel.php";
    return \Page\panel('Note Options', $content);

}
