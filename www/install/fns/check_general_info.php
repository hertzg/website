<?php

function check_general_info ($domainName, $infoEmail, $siteBase) {
    if ($domainName === '') return 'Enter domain name.';
    if ($infoEmail === '') return 'Enter informational email.';
    $regex = "/^[a-z0-9][a-z0-9._-]*@[a-z0-9][a-z0-9.-]*$/";
    if (!preg_match($regex, $infoEmail)) return false;
    if ($siteBase === '') return 'Enter path to "<code>www</code>" folder.';
}
