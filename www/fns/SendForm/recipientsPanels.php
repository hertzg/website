<?php

namespace SendForm;

function recipientsPanels ($recipients, $contacts, $params, &$content,
    &$additionalPanels, $base, $contactsBase, $localBase = '') {

    $fnsDir = __DIR__.'/../';

    include_once __DIR__.'/renderRecipientsPanel.php';
    $content = renderRecipientsPanel($recipients, $params, $localBase);

    if ($contacts) {
        include_once "$fnsDir/RecipientList/contactsPanel.php";
        $additionalPanels .= \RecipientList\contactsPanel(
            $contacts, $params, $base, $contactsBase, $localBase);
    }

    include_once "$fnsDir/RecipientList/enterPanel.php";
    $additionalPanels .= \RecipientList\enterPanel('', $params, $localBase);

}
