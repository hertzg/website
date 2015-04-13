<?php

function check_general_info ($siteTitle, $domainName, $infoEmail, $siteBase) {

    if ($siteTitle === '') return 'Enter site title.';

    if ($domainName === '') return 'Enter domain name.';

    $fnsDir = __DIR__.'/../../fns';

    include_once "$fnsDir/DomainName/isValid.php";
    if (!DomainName\isValid($domainName)) return 'The domain name is invalid';

    if ($infoEmail === '') return 'Enter informational email.';

    include_once "$fnsDir/InfoEmail/isValid.php";
    if (!InfoEmail\isValid($infoEmail)) {
        return 'The informational email is invalid.';
    }

    if ($siteBase === '') return 'Enter path to "<code>www</code>" folder.';

    if (substr($siteBase, 0, 1) !== '/') {
        return 'The path to "<code>www</code>" folder'
            .' should start with slash (<code>/</code>).';
    }

    if (substr($siteBase, -1) !== '/') {
        return 'The path to "<code>www</code>" folder'
            .' should end with slash (<code>/</code>).';
    }

}
