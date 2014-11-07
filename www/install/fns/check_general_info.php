<?php

function check_general_info ($domainName, $siteBase) {
    if ($domainName === '') return 'Enter domain name.';
    if ($siteBase === '') return 'Enter path to "<code>www</code>" folder.';
}
