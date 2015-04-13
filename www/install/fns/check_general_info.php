<?php

function check_general_info ($siteTitle, $domainName, $infoEmail, $siteBase) {

    if ($siteTitle === '') return 'Enter title.';

    if ($domainName === '') return 'Enter domain name.';

    if ($infoEmail === '') return 'Enter informational email.';

    $regex = "/^[a-z0-9][a-z0-9._-]*@[a-z0-9][a-z0-9.-]*$/";
    if (!preg_match($regex, $infoEmail)) return false;

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
