<?php

function create_options_panel ($idfolders) {

    include_once __DIR__.'/../../fns/Page/imageArrowLink.php';

    $options = array(
        Page\imageArrowLink('New Folder',
            "new-folder/?parentidfolders=$idfolders", 'create-folder'),
        Page\imageArrowLink('Upload Files',
            "upload-files/?idfolders=$idfolders", 'upload'),
    );

    if ($idfolders) {
        $options[] = Page\imageArrowLink('Rename This Folder',
            "rename-folder/?idfolders=$idfolders", 'rename');
        $options[] = Page\imageArrowLink('Move This Folder',
            "move-folder/?idfolders=$idfolders", 'move-folder');
        $options[] = Page\imageArrowLink('Delete This Folder',
            "delete-folder/?idfolders=$idfolders", 'trash-bin');
    }

    include_once __DIR__.'/../../fns/create_panel.php';
    return create_panel('Options', join('<div class="hr"></div>', $options));

}
