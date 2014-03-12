<?php

function create_search_form ($idfolders, $keyword, $deep) {

    include_once __DIR__.'/../../../fns/create_folder_link.php';
    $clearHref = create_folder_link($idfolders, '../');

    $placeholder = 'Search folders and files...';
    include_once __DIR__.'/../../../fns/SearchForm/content.php';
    $formContent = SearchForm\content($keyword, $placeholder, $clearHref);
    if ($idfolders) {
        $formContent =
            "<input type=\"hidden\" name=\"idfolders\" value=\"$idfolders\" />"
            .$formContent;
    }
    if ($deep) {
        $formContent .= '<input type="hidden" name="deep" value="1" />';
    }

    include_once __DIR__.'/../../../fns/SearchForm/create.php';
    return SearchForm\create('./', $formContent);

}
