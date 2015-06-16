<?php

function render_contacts ($contacts, $total,
    $groupLimit, &$items, $regex, $encodedKeyword) {

    $replace = '<mark>$0</mark>';
    $fnsDir = __DIR__.'/../../fns';

    $num_contacts = count($contacts);
    if ($total > $groupLimit) array_pop($contacts);

    include_once "$fnsDir/Page/imageArrowLink.php";
    include_once "$fnsDir/Page/imageArrowLinkWithDescription.php";
    foreach ($contacts as $contact) {

        $title = htmlspecialchars($contact->full_name);
        $alias = htmlspecialchars($contact->alias);
        $email = htmlspecialchars($contact->email);
        $phone1 = htmlspecialchars($contact->phone1);
        $phone2 = htmlspecialchars($contact->phone2);

        $title = preg_replace($regex, $replace, $title);
        $query = "?id=$contact->id&amp;keyword=$encodedKeyword";
        $href = "../contacts/view/$query";

        if ($contact->favorite) $icon = 'favorite-contact';
        else $icon = 'contact';

        $descriptions = [];
        if ($alias !== '') {
            $descriptions[] = preg_replace($regex, $replace, $alias);
        }
        if (preg_match($regex, $email)) {
            $descriptions[] = preg_replace($regex, $replace, $email);
        }
        if (preg_match($regex, $phone1)) {
            $descriptions[] = preg_replace($regex, $replace, $phone1);
        }
        if (preg_match($regex, $phone2)) {
            $descriptions[] = preg_replace($regex, $replace, $phone2);
        }

        if ($descriptions) {
            $description = join(' &middot; ', $descriptions);
            $items[] = Page\imageArrowLinkWithDescription(
                $title, $description, $href, $icon);
        } else {
            $items[] = Page\imageArrowLink($title, $href, $icon);
        }

    }

    if ($num_contacts < $total) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items[] = Page\imageArrowLink("Show All $total Contacts",
            "../contacts/search/?keyword=$encodedKeyword", 'contacts');
    }

}
