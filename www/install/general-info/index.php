<?php

include_once '../fns/require_requirements.php';
require_requirements();

include_once 'fns/get_values.php';
$values = get_values();

$key = 'install/general-info/error';
if (array_key_exists($key, $_SESSION)) {
    $errorHtml =
        '<div class="error formError">'
            ."&times; {$_SESSION[$key]}"
        .'</div>';
} else {
    $errorHtml = '';
}

$escapedSiteTitle = htmlspecialchars($values['siteTitle']);
$escapedDomainName = htmlspecialchars($values['domainName']);
$escapedInfoEmail = htmlspecialchars($values['infoEmail']);
$escapedSiteBase = htmlspecialchars($values['siteBase']);

$doneSteps = [
    [
        'title' => 'Agreement',
        'href' => '../agreement/',
    ],
    [
        'title' => 'Requirements',
        'href' => '../requirements/',
    ],
];
$nextSteps = ['MySQL Configuration', 'Administrator', 'Finalize Installation'];

include_once '../fns/echo_page.php';
include_once '../fns/field_columns.php';
include_once '../fns/steps.php';
include_once '../fns/wizard_layout.php';
echo_page(
    'Step 3 - General Information',
    '<form action="submit.php" method="post">'
        .wizard_layout(
            steps($doneSteps, 'General Information', $nextSteps),
            '<span class="title-step">Step 3</span>'
            .'<h2>General Information</h2>'
            .field_columns(
                '<label for="siteTitleInput">Site title:</label>'
                .'<br />'
                .'<input type="text" name="siteTitle" required="required"'
                ." class=\"textfield\" value=\"$escapedSiteTitle\""
                .' autofocus="autofocus" id="siteTitleInput" />',
                '<label for="domainNameInput">Domain name:</label>'
                .'<br />'
                .'<input class="textfield" type="text"'
                .' required="required" id="domainNameInput"'
                ." value=\"$escapedDomainName\" name=\"domainName\" />"
            )
            .field_columns(
                '<label for="infoEmailInput">Informational email:</label>'
                .'<br />'
                .'<input class="textfield" type="text"'
                .' required="required" id="infoEmailInput"'
                ." value=\"$escapedInfoEmail\" name=\"infoEmail\" />",
                '<label for="siteBaseInput">'
                    .'Path to "<code>www</code>" folder:'
                .'</label>'
                .'<br />'
                .'<input type="text" name="siteBase" required="required"'
                .' id="siteBaseInput" class="textfield"'
                ." value=\"$escapedSiteBase\" />"
            )
            .'<div>'
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
