<?php

namespace SendForm;

function recipientsPanels ($recipients, $contacts,
    $params, &$content, &$additionalPanels, $base = '') {

    $fnsDir = __DIR__.'/../';

    include_once __DIR__.'/renderRecipientsPanel.php';
    $content = renderRecipientsPanel($recipients, $params, $base);

    if ($contacts) {
        include_once "$fnsDir/RecipientList/contactsPanel.php";
        $additionalPanels .= \RecipientList\contactsPanel($contacts, $params, $base);
    }

    include_once "$fnsDir/RecipientList/enterPanel.php";
    $additionalPanels .= \RecipientList\enterPanel('', $params, $base);

}
