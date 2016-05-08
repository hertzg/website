<?php

namespace ViewPage;

function optionsPanel ($typeName, $id) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/Page/imageLink.php";
    $purgeLink = \Page\imageLink('Purge',
        "../purge/?id=$id", 'purge', ['id' => 'purge']);

    $restoreLink = \Page\imageLink('Restore',
        "../submit-restore.php?id=$id", 'restore-defaults');

    include_once "$fnsDir/Page/staticTwoColumns.php";
    $optionsContent = \Page\staticTwoColumns($restoreLink, $purgeLink);

    include_once "$fnsDir/Page/panel.php";
    return \Page\panel("$typeName Options", $optionsContent);

}
