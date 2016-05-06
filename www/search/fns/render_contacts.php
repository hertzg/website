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

        $id = $contact->id;

        $title = htmlspecialchars($contact->full_name);
        $alias = htmlspecialchars($contact->alias);
        $email1 = htmlspecialchars($contact->email1);
        $email2 = htmlspecialchars($contact->email2);
        $phone1 = htmlspecialchars($contact->phone1);
        $phone2 = htmlspecialchars($contact->phone2);

        $title = preg_replace($regex, $replace, $title);
        $query = "?id=$id&amp;keyword=$encodedKeyword";
        $href = "../contacts/view/$query";
        $options = [];

        if ($contact->favorite) $icon = 'favorite-contact';
        else $icon = 'contact';

        $descriptions = [];
        if ($alias !== '') {
            $descriptions[] = preg_replace($regex, $replace, $alias);
        }
        if (preg_match($regex, $email1)) {
            $descriptions[] = preg_replace($regex, $replace, $email1);
        }
        if (preg_match($regex, $email2)) {
            $descriptions[] = preg_replace($regex, $replace, $email2);
        }
        if (preg_match($regex, $phone1)) {
            $descriptions[] = preg_replace($regex, $replace, $phone1);
        }
        if (preg_match($regex, $phone2)) {
            $descriptions[] = preg_replace($regex, $replace, $phone2);
        }

        $photo_id = $contact->photo_id;
        if ($photo_id !== null) {
            $options['image'] = '../contacts/photo/download/'
                ."?id=$id&amp;photo_id=$photo_id";
        }

        if ($descriptions) {
            $description = join(' &middot; ', $descriptions);
            $items[] = Page\imageArrowLinkWithDescription(
                $title, $description, $href, $icon, $options);
        } else {
            $items[] = Page\imageArrowLink($title, $href, $icon, $options);
        }

    }

    if ($num_contacts < $total) {
        include_once "$fnsDir/Page/imageArrowLink.php";
        $items[] = Page\imageArrowLink("Show All $total Contacts",
            "../contacts/search/?keyword=$encodedKeyword", 'contacts');
    }

}
