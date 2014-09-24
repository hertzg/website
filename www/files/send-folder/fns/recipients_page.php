<?php

function recipients_page ($recipients, $contacts, $params, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/SendForm/renderRecipientsPanel.php";
    $html = SendForm\renderRecipientsPanel($recipients, $params, $base);

    if ($contacts) {
        include_once "$fnsDir/RecipientList/contactsPanel.php";
        $html .= RecipientList\contactsPanel($contacts, $params, $base);
    }

    include_once "$fnsDir/RecipientList/enterPanel.php";
    $html .= RecipientList\enterPanel('', $params, $base);

    return $html;

}
