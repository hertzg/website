<?php

include_once '../fns/require_requirements.php';
require_requirements();

$key = 'install/general-info/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {

    $key = 'HTTP_HOST';
    if (array_key_exists($key, $_SERVER)) $domainName = $_SERVER[$key];
    else $domainName = $_SERVER['REMOTE_ADDR'];

    $documentRoot = $_SERVER['DOCUMENT_ROOT'];
    $file = substr($_SERVER['SCRIPT_FILENAME'], strlen($documentRoot));
    $remainingLength = strlen('install/general-info/index.php');
    $siteBase = substr($file, 0, strlen($file) - $remainingLength);

    $values = [
        'domainName' => $domainName,
        'infoEmail' => "info@$domainName",
        'siteBase' => $siteBase,
        'https' => array_key_exists('HTTPS', $_SERVER),
    ];

}

$key = 'install/general-info/error';
if (array_key_exists($key, $_SESSION)) {
    $errorHtml =
        '<div class="error formError">'
            ."&times; {$_SESSION[$key]}"
        .'</div>';
} else {
    $errorHtml = '';
}

$escapedDomainName = htmlspecialchars($values['domainName']);
$escapedInfoEmail = htmlspecialchars($values['infoEmail']);
$escapedSiteBase = htmlspecialchars($values['siteBase']);

$doneSteps = ['Agreement', 'Requirements'];
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
                '<label for="domainNameInput">Domain name:</label>'
                .'<br />'
                .'<input class="textfield" type="text" required="required"'
                .' autofocus="autofocus" id="domainNameInput"'
                ." value=\"$escapedDomainName\" name=\"domainName\" />",
                '<label for="infoEmailInput">Informational email:</label>'
                .'<br />'
                .'<input class="textfield" type="text" required="required"'
                .' autofocus="autofocus" id="infoEmailInput"'
                ." value=\"$escapedInfoEmail\" name=\"infoEmail\" />"
            )
            .'<div style="margin-bottom: 8px">'
                .'<label for="siteBaseInput">'
                    .'Path to "<code>www</code>" folder:'
                .'</label>'
                .'<br />'
                .'<input type="text" name="siteBase" required="required"'
                .' id="siteBaseInput" class="textfield"'
                ." value=\"$escapedSiteBase\" required=\"required\" />"
            .'</div>'
            .'<div>'
                .'<input type="checkbox" name="https" id="httpsInput"'
                .($values['https'] ? ' checked="checked"' : '').' />'
                .' <label for="httpsInput">'
                    .'The site uses HTTPS protocol.'
                .'</label>'
            .'</div>'
            .$errorHtml,
            '<a href="../requirements/" class="button">Back</a>'
            .'<input type="submit" class="button nextButton" value="Next" />'
        )
    .'</form>'
);
