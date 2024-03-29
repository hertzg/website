<?php

function create_page ($mysqli, $user,
    $folder, &$scripts, &$title, $base = '') {

    $fnsDir = __DIR__.'/../../fns';
    $id = $folder ? $folder->id_folders : 0;

    $items = [];

    include_once "$fnsDir/Users/Folders/index.php";
    $folders = Users\Folders\index($mysqli, $user, $id);

    include_once "$fnsDir/Users/Files/index.php";
    $files = Users\Files\index($mysqli, $user, $id);

    if (count($files) + count($folders) > 1) {

        include_once "$fnsDir/SearchForm/emptyContent.php";
        $formContent = SearchForm\emptyContent('Search folders and files...');
        if ($id) {
            include_once "$fnsDir/Form/hidden.php";
            $formContent = Form\hidden('id_folders', $id).$formContent;
        }

        include_once "$fnsDir/SearchForm/create.php";
        $items[] = SearchForm\create("{$base}search/", $formContent);

        include_once "$fnsDir/compressed_js_script.php";
        $scripts = compressed_js_script('searchForm', "$base../");

    }

    include_once __DIR__.'/render_folders_and_files.php';
    render_folders_and_files($folders, $files, $items, $base);

    $key = 'files/id_folders';
    if (array_key_exists($key, $_SESSION) && $id != $_SESSION[$key]) {
        unset(
            $_SESSION['files/errors'],
            $_SESSION['files/messages']
        );
    }

    if ($id) {

        include_once "$fnsDir/compressed_js_script.php";
        $scripts .= compressed_js_script('dateAgo', "$base../");

        include_once "$fnsDir/format_author.php";
        $author = format_author($folder->insert_time,
            $folder->insert_api_key_name);
        $text = "Folder created $author.";
        if ($folder->revision) {
            $author = format_author($folder->rename_time,
                $folder->rename_api_key_name);
            $text .= "<br />Last renamed $author.";
        }

        include_once "$fnsDir/Page/infoText.php";
        $infoText = Page\infoText($text);

    } else {
        $infoText = '';
    }

    include_once __DIR__.'/unset_session_vars.php';
    unset_session_vars();

    include_once __DIR__.'/create_content.php';
    return create_content($mysqli, $folder,
        $user, $files, $items, $infoText, $title, $base);

}
