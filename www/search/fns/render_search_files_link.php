<?php

function render_search_files_link ($user,
    $searchFiles, $keyword, $offset, &$items) {

    if (!$user->num_files && !$user->num_folders) return;

    if ($searchFiles) return;

    $params = [
        'keyword' => $keyword,
        'files' => '1',
    ];
    if ($offset) $params['offset'] = $offset;
    $href = './?'.htmlspecialchars(http_build_query($params));
    include_once __DIR__.'/../../fns/Page/imageLink.php';
    $items[] = Page\imageLink('Search in files', $href, 'search-folder');

}
