<?php

include_once 'lib/require-user.php';
include_once '../fns/create_panel.php';
include_once '../fns/ifset.php';
include_once '../fns/request_strings.php';
include_once '../classes/Bookmarks.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

list($tag) = request_strings('tag');

if ($tag === '') {
    $bookmarks = Bookmarks::index($idusers);
    if (count($bookmarks) > 1) {
        include_once '../classes/BookmarkTags.php';
        $bookmarkTags = BookmarkTags::indexOnUser($idusers);
        if ($bookmarkTags) {
            $links = array();
            foreach ($bookmarkTags as $bookmarkTag) {
                $tagname = $bookmarkTag->tagname;
                $href = '?'.htmlspecialchars(
                    http_build_query(array(
                        'tag' => $tagname,
                    ))
                );
                $links[] =
                    '<li style="display: inline-block">'
                        ."<a class=\"tag\" href=\"$href\">"
                            .htmlspecialchars($tagname)
                        .'</a>'
                    .'</li>';
            }
            $filterMessage =
                '<div class="tags" style="background: #eee; color: #444">'
                    .'<span class="tags-label">Filter by tags:</span>'
                    .join('', $links)
                .'</div>'
                .'<div class="warnings-hr"></div>';
        }
    } else {
        $filterMessage = '';
    }
} else {
    $bookmarks = Bookmarks::indexOnTag($idusers, $tag);
    $filterMessage = Page::warnings(array(
        'Showing bookmarks with <b>'.htmlspecialchars($tag).'</b> tag.'
        .' <a class="a" href="./">Show all</a>',
    ));
}

$items = array();
if ($bookmarks) {
    foreach ($bookmarks as $bookmark) {
        $href = "view.php?id=$bookmark->idbookmarks";
        $escapedUrl = htmlspecialchars($bookmark->url);
        if ($bookmark->title) {
            $items[] = Page::imageLinkWithDescription($bookmark->title, $escapedUrl, $href, 'bookmark');
        } else {
            $items[] = Page::imageLink($bookmark->url, $href, 'bookmark');
        }
    }
} else {
    $items[] = Page::info('No bookmarks.');
}

unset(
    $_SESSION['bookmarks/add_errors'],
    $_SESSION['bookmarks/edit_errors'],
    $_SESSION['bookmarks/view_messages'],
    $_SESSION['home_messages']
);

$page->base = '../';
$page->title = 'Bookmarks';
$page->finish(
    Tab::create(
        Tab::activeItem('Bookmarks'),
        Page::messages(ifset($_SESSION['bookmarks/index_messages']))
        .$filterMessage
        .join(Page::HR, $items)
    )
    .create_panel(
        'Options',
        Page::imageLink('New Bookmark', 'add.php', 'create-bookmark')
    )
);
