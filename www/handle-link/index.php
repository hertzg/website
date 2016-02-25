<?php

include_once '../../lib/defaults.php';

$base = '../';
$fnsDir = '../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once "$fnsDir/request_strings.php";
list($value) = request_strings('value');

$boldValue = '"<b>'.htmlspecialchars($value).'</b>"';
$items = [];
$errors = [];
$text_html = '';

$url = parse_url($value);

if (array_key_exists('scheme', $url) && array_key_exists('path', $url)) {

    $scheme = $url['scheme'];
    $path = $url['path'];

    if ($scheme === 'mailto' || $scheme === 'sms' || $scheme === 'tel') {

        $escapedPath = htmlspecialchars($path);
        $pathParam = rawurlencode($path);

        include_once "$fnsDir/Page/text.php";
        $text_html = Page\text(
            "What would you like to do with \"<b>$escapedPath</b>\"?");

        if ($scheme === 'mailto') {
            $type = 'email';
            $property = 'email1';
        } else {
            $type = 'phone';
            $property = 'phone1';
        }

        include_once "$fnsDir/Page/imageLinkWithDescription.php";
        $items[] = Page\imageLinkWithDescription('Search',
            "Search for \"$escapedPath\".", "../search/?keyword=$pathParam",
            'search');

        $items[] = Page\imageLinkWithDescription('New Contact',
            "Create a new contact with the $type \"$escapedPath\".",
            "../contacts/new/?$property=$pathParam", 'create-contact');

    } else {
        $errors[] = "The link $boldValue cannot be opened.";
    }

} else {
    include_once "$fnsDir/Page/info.php";
    $errors[] = "The link $boldValue is invalid.";
}

if ($errors) {
    include_once "$fnsDir/Page/errors.php";
    $errorsHtml = Page\errors($errors);
} else {
    $errorsHtml = '';
}

include_once "$fnsDir/Page/create.php";
$content = Page\create(
    [
        'title' => 'Home',
        'href' => '..',
    ],
    'Handle Link',
    $errorsHtml.$text_html.join('<div class="hr"></div>', $items)
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Handle Link', $content, $base);
