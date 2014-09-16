<?php

function create_new_task_button ($base = '') {

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/ItemList/escapedPageQuery.php";
    $href = "{$base}new/".ItemList\escapedPageQuery();

    include_once "$fnsDir/Page/newItemButton.php";
    return Page\newItemButton($href, 'New', 'Task');

}
