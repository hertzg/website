<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

$api_base = 'https://zvini.com/api-call/';

include_once '../../../fns/Page/phpCode.php';
include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/text.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'API Documentation',
            'href' => '..',
        ],
    ],
    'PHP Example',
    Page\text('Below is a PHP code that calls an example method:')
    .'<div class="hr"></div>'
    .Page\phpCode(
        "<span class=\"comment\">// prepare parameters</span>\n"
        ."\$method = <span class=\"string\">'some-app/do-something'</span>;\n"
        ."\$params = [\n"
        ."    <span class=\"string\">'param1'</span> =&gt; <span class=\"string\">'value1'</span>,\n"
        ."    <span class=\"string\">'param2'</span> =&gt; <span class=\"string\">'value2'</span>,\n"
        ."];\n"
        ."\$api_key = <span class=\"string\">'dee48716455972ce2...'</span>;\n"
        ."\$api_base = <span class=\"string\">'$api_base'</span>;\n\n"
        ."<span class=\"comment\">// send request</span>\n"
        ."\$ch = curl_init();\n"
        ."curl_setopt_array(\$ch, [\n"
        ."    CURLOPT_POSTFIELDS =&gt; http_build_query(\$params),\n"
        ."    CURLOPT_RETURNTRANSFER =&gt; true,\n"
        ."    CURLOPT_URL =&gt; \$api_base.\$method,\n"
        ."]);\n"
        ."\$response = curl_exec(\$ch);\n"
        ."\n"
        ."<span class=\"comment\">// check for errors</span>\n"
        ."<span class=\"keyword\">if</span> (\$response === false) {\n"
        ."    <span class=\"keyword\">die</span>(<span class=\"string\">'ERROR: '</span>.curl_error(\$ch));\n"
        ."}\n"
        ."<span class=\"keyword\">if</span> (curl_getinfo(\$ch, CURLINFO_HTTP_CODE) != 200) {\n"
        ."    <span class=\"keyword\">die</span>(<span class=\"string\">'ERROR: '</span>.\$response);\n"
        ."}\n\n"
        ."\$response = json_decode(\$response);\n"
        ."<span class=\"comment\">// do something with the response</span>"
    )
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'PHP Example', $content, $base, [
//    'head' => '<link rel="stylesheet" type="text/css" href="index.css" />',
]);
