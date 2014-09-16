<?php

function highlight ($string) {
    $string = htmlspecialchars($string);
    $replace = '$1<span class="comment">$2</span>$3';
    $string = preg_replace('/(^|\n)(\/\/.*)(\n|$)/', $replace, $string);
    $replace = '<span class="string">$0</span>';
    $string = preg_replace('/\'.*?\'/', $replace, $string);
    return $string;
}

$fnsDir = '../../../fns';

include_once "$fnsDir/signed_user.php";
$user = signed_user();

include_once "$fnsDir/get_domain_name.php";
$domain_name = get_domain_name();

include_once "$fnsDir/get_site_base.php";
$siteBase = get_site_base();

include_once "$fnsDir/get_site_protocol.php";
$site_protocol = get_site_protocol();

$api_base = "$site_protocol://$domain_name{$siteBase}api-call/";

$code =
    "// prepare parameters\n"
    ."\$method = 'some-app/do-something';\n"
    ."\$params = [\n"
    ."    'param1' => 'value1',\n"
    ."    'param2' => 'value2',\n"
    ."];\n"
    ."\$api_key = 'dee48716455972ce2...';\n"
    ."\$api_base = '$api_base';\n"
    ."\n"
    ."// send request\n"
    ."\$ch = curl_init();\n"
    ."curl_setopt_array(\$ch, [\n"
    ."    CURLOPT_POSTFIELDS => http_build_query(\$params),\n"
    ."    CURLOPT_RETURNTRANSFER => true,\n"
    ."    CURLOPT_URL => \$api_base.\$method,\n"
    ."]);\n"
    ."\$response = curl_exec(\$ch);\n"
    ."\n"
    ."// check for errors\n"
    ."if (\$response === false) {\n"
    ."    die('ERROR: '.curl_error(\$ch));\n"
    ."}\n"
    ."if (curl_getinfo(\$ch, CURLINFO_HTTP_CODE) != 200) {\n"
    ."    die('ERROR: '.\$response);\n"
    ."}\n"
    ."\n"
    ."// decode json\n"
    ."\$contentType = curl_getinfo(\$ch, CURLINFO_CONTENT_TYPE);\n"
    ."if (\$contentType == 'application/json') {\n"
    ."    \$response = json_decode(\$response);\n"
    ."}\n"
    ."\n"
    ."// do something with the response\n";

include_once "$fnsDir/Page/phpCode.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Page/text.php";
$content = Page\tabs(
    [
        [
            'title' => 'API Documentation',
            'href' => '..',
        ],
    ],
    'PHP Example',
    Page\text('Below is a PHP code that calls an example API method:')
    .'<div class="hr"></div>'
    .Page\phpCode(highlight($code))
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'PHP Example', $content, '../../../');
