<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_requirements.php';
require_requirements();

include_once 'fns/get_values.php';
$values = get_values();

$siteTitle = $values['siteTitle'];
$domainName = $values['domainName'];
$infoEmail = $values['infoEmail'];
$siteBase = $values['siteBase'];
$numReverseProxies = $values['numReverseProxies'];

if ($values['check']) {

    include_once '../fns/check_general_info.php';
    $error = check_general_info($siteTitle, $domainName,
        $infoEmail, $siteBase, $numReverseProxies, $focus);
    if ($focus === null) $focus = 'siteTitle';

    if ($error === null) $errorHtml = '';
    else $errorHtml = "<div class=\"error formError\">&times; $error</div>";

} else {
    $focus = 'siteTitle';
    $errorHtml = '';
}

$escapedSiteTitle = htmlspecialchars($siteTitle);
$escapedDomainName = htmlspecialchars($domainName);
$escapedInfoEmail = htmlspecialchars($infoEmail);
$escapedSiteBase = htmlspecialchars($siteBase);

$options = '';
include_once '../../fns/NumReverseProxies/available.php';
foreach (NumReverseProxies\available() as $key => $value) {
    $options .= "<option value=\"$key\">$value</option>";
}

include_once 'fns/create_steps.php';
include_once '../fns/echo_page.php';
include_once '../fns/field_columns.php';
include_once '../fns/wizard_layout.php';
echo_page(
    'Step 3 - General Information',
    '<form action="submit.php" method="post">'
        .wizard_layout(
            create_steps(),
            '<span class="title-step">Step 3</span>'
            .'<h2>General Information</h2>'
            .field_columns(
                '<label for="siteTitleInput">Site title:</label>'
                .'<br />'
                .'<input type="text" name="siteTitle"'
                .' required="required" class="textfield"'
                ." value=\"$escapedSiteTitle\" id=\"siteTitleInput\""
                .($focus == 'siteTitle' ? ' autofocus="autofocus"' : '').' />',
                '<label for="domainNameInput">Domain name:</label>'
                .'<br />'
                .'<input class="textfield" type="text"'
                .' required="required" id="domainNameInput"'
                ." value=\"$escapedDomainName\" name=\"domainName\""
                .($focus == 'domainName' ? ' autofocus="autofocus"' : '').' />'
            )
            .field_columns(
                '<label for="infoEmailInput">Informational email:</label>'
                .'<br />'
                .'<input class="textfield" type="text"'
                .' required="required" id="infoEmailInput"'
                ." value=\"$escapedInfoEmail\" name=\"infoEmail\""
                .($focus == 'infoEmail' ? ' autofocus="autofocus"' : '').' />',
                '<label for="siteBaseInput">Website path:</label>'
                .'<br />'
                .'<input type="text" name="siteBase" required="required"'
                .' id="siteBaseInput" class="textfield"'
                ." value=\"$escapedSiteBase\""
                .($focus == 'siteBase' ? ' autofocus="autofocus"' : '').' />'
            )
            .'<div style="margin-bottom: 8px">'
                .'<label for="numReverseProxiesInput">'
                    .'Reverse proxies / your IP:'
                .'</label>'
                .'<br />'
                .'<select class="textfield"'
                .($focus == 'numReverseProxies' ? ' autofocus="autofocus"' : '')
                .' id="numReverseProxiesInput" name="numReverseProxies">'
                    .$options
                .'</select>'
            .'</div>'
            .'<div >'
                .'<input type="checkbox" name="https" id="httpsInput"'
                .($values['https'] ? ' checked="checked"' : '').' />'
                .' <label for="httpsInput">'
                    .'The site uses HTTPS protocol.'
                .'</label>'
            .'</div>'
            .$errorHtml,
            '<input type="submit" class="button nextButton" value="Next" />'
            .'<a href="../requirements/" class="button">Back</a>'
        )
    .'</form>'
);
