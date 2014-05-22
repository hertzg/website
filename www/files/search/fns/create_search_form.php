<?php

function create_search_form ($id_folders, $keyword, $deep) {

    include_once __DIR__.'/../../../fns/create_folder_link.php';
    $clearHref = create_folder_link($id_folders, '../');

    $placeholder = 'Search folders and files...';
    include_once __DIR__.'/../../../fns/SearchForm/content.php';
    $formContent = SearchForm\content($keyword, $placeholder, $clearHref);
    if ($id_folders) {
        include_once __DIR__.'/../../../fns/Form/hidden.php';
        $formContent = Form\hidden('id_folders', $id_folders).$formContent;
    }
    if ($deep) {
        $formContent .= '<input type="hidden" name="deep" value="1" />';
    }

    include_once __DIR__.'/../../../fns/SearchForm/create.php';
    return SearchForm\create('./', $formContent);

}
