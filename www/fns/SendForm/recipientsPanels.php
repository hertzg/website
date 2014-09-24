<?php

namespace SendForm;

function recipientsPanels ($recipients, $contacts, $params, $base = '') {

    $fnsDir = __DIR__.'/../';

    include_once __DIR__.'/renderRecipientsPanel.php';
    $html = renderRecipientsPanel($recipients, $params, $base);

    if ($contacts) {
        include_once "$fnsDir/RecipientList/contactsPanel.php";
        $html .= \RecipientList\contactsPanel($contacts, $params, $base);
    }

    include_once "$fnsDir/RecipientList/enterPanel.php";
    $html .= \RecipientList\enterPanel('', $params, $base);

    return $html;

}
