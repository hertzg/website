<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);
$idusers = $user->idusers;

include_once '../lib/mysqli.php';

include_once '../fns/request_strings.php';
list($idfolders, $keyword, $deep) = request_strings('idfolders', 'keyword', 'deep');

$idfolders = abs((int)$idfolders);
if ($idfolders) {
    include_once '../fns/Folders/get.php';
    $folder = Folders\get($mysqli, $idusers, $idfolders);
    if (!$folder) {
        include_once '../fns/redirect.php';
        redirect();
    }
}

$deep = (bool)$deep;

$items = array();

include_once '../fns/str_collapse_spaces.php';
$keyword = str_collapse_spaces($keyword);

$searchAction = './';
$searchPlaceholder = 'Search folders and files...';

if ($keyword === '') {

    include_once '../fns/Folders/indexInUserFolder.php';
    $folders = Folders\indexInUserFolder($mysqli, $idusers, $idfolders);

    include_once '../fns/Files/indexInUserFolder.php';
    $files = Files\indexInUserFolder($mysqli, $idusers, $idfolders);

    if (count($files) + count($folders) > 1) {

        include_once '../fns/SearchForm/emptyContent.php';
        $formContent = SearchForm\emptyContent($searchPlaceholder);
        if ($idfolders) {
            $formContent =
                "<input type=\"hidden\" name=\"idfolders\" value=\"$idfolders\" />"
                .$formContent;
        }

        include_once '../fns/SearchForm/create.php';
        $items[] = SearchForm\create($searchAction, $formContent);

    }

} else {

    if ($deep) {
        include_once 'fns/search_recursively.php';
        list($folders, $files) = search_recursively($mysqli, $idusers, $idfolders, $keyword);
    } else {

        include_once '../fns/Folders/searchInFolder.php';
        $folders = Folders\searchInFolder($mysqli, $idusers, $idfolders, $keyword);

        include_once '../fns/Files/searchInFolder.php';
        $files = Files\searchInFolder($mysqli, $idusers, $idfolders, $keyword);

    }

    include_once '../fns/create_folder_link.php';
    $clearHref = create_folder_link($idfolders);

    include_once '../fns/SearchForm/content.php';
    $formContent = SearchForm\content($keyword, $searchPlaceholder, $clearHref);
    if ($idfolders) {
        $formContent =
            "<input type=\"hidden\" name=\"idfolders\" value=\"$idfolders\" />"
            .$formContent;
    }
    if ($deep) {
        $formContent .= '<input type="hidden" name="deep" value="1" />';
    }

    include_once '../fns/SearchForm/create.php';
    $items[] = SearchForm\create($searchAction, $formContent);

}

if ($idfolders && $keyword === '') {

    include_once '../fns/create_folder_link.php';
    $href = create_folder_link($folder->parentidfolders);

    include_once '../fns/Page/imageLink.php';
    $items[] = Page\imageLink('.. Parent folder', $href, 'parent-folder');

}

if ($folders || $files) {

    include_once '../fns/Page/imageArrowLink.php';

    foreach ($folders as $i => $folder) {
        $title = htmlspecialchars($folder->foldername);
        $href = "?idfolders=$folder->idfolders";
        $items[] = Page\imageArrowLink($title, $href, 'folder');
    }

    foreach ($files as $i => $file) {
        $items[] = Page\imageArrowLink(htmlspecialchars($file->filename),
            "view-file/?id=$file->idfiles", 'file');
    }

} else {
    if ($keyword === '') $text = 'Folder is empty.';
    else $text = 'Nothing found.';
    include_once '../fns/Page/info.php';
    $items[] = Page\info($text);
}

if ($keyword !== '' && !$deep) {

    $params = array();
    if ($idfolders) $params['idfolders'] = $idfolders;
    $params['keyword'] = $keyword;
    $params['deep'] = '1';
    $href = htmlspecialchars('./?'.http_build_query($params));

    include_once '../fns/Page/imageLink.php';
    $items[] = Page\imageLink('Search in Subfolders', $href, 'search-folder');

}

unset(
    $_SESSION['files/add-folder/index_errors'],
    $_SESSION['files/add-folder/index_lastpost'],
    $_SESSION['files/rename-folder/index_errors'],
    $_SESSION['files/rename-folder/index_lastpost'],
    $_SESSION['files/upload-files/index_errors'],
    $_SESSION['files/view-file/index_messages'],
    $_SESSION['home/index_messages']
);

if (array_key_exists('files/index_idfolders', $_SESSION) &&
    $idfolders != $_SESSION['files/index_idfolders']) {
    unset($_SESSION['files/index_messages']);
}

include_once 'fns/create_options_panel.php';
include_once '../fns/create_tabs.php';
include_once '../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '..',
            ),
        ),
        'Files',
        Page\sessionMessages('files/index_messages')
        .join('<div class="hr"></div>', $items)
    )
    .create_options_panel($idfolders);

include_once '../fns/echo_page.php';
echo_page($user, 'Files', $content, $base);
