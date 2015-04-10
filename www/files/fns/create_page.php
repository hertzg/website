<?php

function create_page ($mysqli, $user, $folder, &$scripts, $base = '') {

    $fnsDir = __DIR__.'/../../fns';
    $id = $folder ? $folder->id_folders : 0;
    $id_users = $user->id_users;

    $items = [];

    include_once "$fnsDir/Folders/indexInUserFolder.php";
    $folders = Folders\indexInUserFolder($mysqli, $id_users, $id);

    include_once "$fnsDir/Files/indexInUserFolder.php";
    $files = Files\indexInUserFolder($mysqli, $id_users, $id);

    $scripts = '';

    if (count($files) + count($folders) > 1) {

        include_once "$fnsDir/SearchForm/emptyContent.php";
        $formContent = SearchForm\emptyContent('Search folders and files...');
        if ($id) {
            include_once "$fnsDir/Form/hidden.php";
            $formContent = Form\hidden('id_folders', $id).$formContent;
        }

        include_once "$fnsDir/SearchForm/create.php";
        $items[] = SearchForm\create('search/', $formContent);

        include_once "$fnsDir/compressed_js_script.php";
        $scripts = compressed_js_script('searchForm', "$base../");

    }

    include_once __DIR__.'/render_folders_and_files.php';
    render_folders_and_files($folders, $files, $items);

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

    include_once __DIR__.'/create_options_panel.php';
    include_once __DIR__.'/create_location_bar.php';
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    $content =
        Page\tabs(
            [
                [
                    'title' => 'Home',
                    'href' => '../home/#files',
                ],
            ],
            'Files',
            Page\sessionErrors('files/errors')
            .Page\sessionMessages('files/messages')
            .create_location_bar($mysqli, $folder)
            .join('<div class="hr"></div>', $items)
            .$infoText
        )
        .create_options_panel($user, $id, $files)
        .$scripts;

    if ($id) {
        include_once __DIR__.'/create_folder_options_panel.php';
        $content .= create_folder_options_panel($id);
    }

    return $content;

}
