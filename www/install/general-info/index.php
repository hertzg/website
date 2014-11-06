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
        'siteBase' => $siteBase,
        'https' => false,
    ];

}

$key = 'install/general-info/error';
if (array_key_exists($key, $_SESSION)) {
    $erroHtml = "<div class=\"error formError\">{$_SESSION[$key]}</div>";
} else {
    $erroHtml = '';
}

$escapedDomainName = htmlspecialchars($values['domainName']);
$escapedSiteBase = htmlspecialchars($values['siteBase']);

include_once '../fns/echo_page.php';
include_once '../fns/field_columns.php';
include_once '../fns/wizard_layout.php';
echo_page(
    'Step 2 - General Information',
    '<form action="submit.php" method="post">'
        .wizard_layout(
            '<ul class="steps">'
                .'<li class="steps-done">'
                    .'<code>&#x2713;</code> Requirements'
                .'</li>'
                .'<li class="steps-active">'
                    .'<code>&bull;</code> General Information'
                .'</li>'
                .'<li class="steps-next">'
                    .'<code>&bull;</code> MySQL Configuration'
                .'</li>'
                .'<li class="steps-next">'
                    .'<code>&bull;</code> Finalize Installation'
                .'</li>'
            .'</ul>',
            '<span class="title-step">Step 2</span>'
            .'<h2>General Information</h2>'
            .field_columns(
                '<label for="domainNameInput">Domain name:</label>'
                .'<br />'
                .'<input class="textfield"'
                .' type="text" required="required"'
                .' autofocus="autofocus" id="domainNameInput"'
                ." value=\"$escapedDomainName\" name=\"domainName\" />",
                '<label for="siteBaseInput">'
                    .'Path to "<code>www</code>" folder:'
                .'</label>'
                .'<br />'
                .'<input type="text"'
                .' name="siteBase" required="required"'
                .' id="siteBaseInput" class="textfield"'
                ." value=\"$escapedSiteBase\" required=\"required\" />"
            )
            .'<div>'
                .'<input type="checkbox" name="https" id="httpsInput"'
                .($values['https'] ? ' checked="checked"' : '').' />'
                .' <label for="httpsInput">'
                    .'The site uses HTTPS protocol.'
                .'</label>'
            .'</div>'
            .$erroHtml,
            '<a href="../requirements/" class="button">Back</a>'
            .'<input type="submit" class="button nextButton" value="Next" />'
        )
    .'</form>'
);
