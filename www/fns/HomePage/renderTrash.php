<?php

namespace HomePage;

function renderTrash ($user, &$items) {

    if (!$user->show_trash) return;

    $num_deleted_items = $user->num_deleted_items;
    if ($num_deleted_items) $description = "$num_deleted_items total.";
    else $description = 'Empty';

    include_once __DIR__.'/../../fns/Page/thumbnailLinkWithDescription.php';
    $items['trash'] = \Page\thumbnailLinkWithDescription('Trash',
        $description, '../trash/', 'trash-bin', ['id' => 'trash']);

}
