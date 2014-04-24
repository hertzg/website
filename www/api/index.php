<?php

function create_h2 ($text) {
    $name = rawurlencode($text);
    return "<h2><a name=\"$name\">$text</a></h2>";
}

function create_api_method (array $method) {
    $name = $method['name'];
    $html =
        '<h3 style="display: inline">'
            ."<a name=\"$name\">$name</a>"
        .'</h3>'
        ."<span> - $method[description] Parameters:</span>"
        .''
        .'<ul>';
    foreach ($method['params'] as $name => $param) {
        $html .=
            '<li class="params">'
                ."<b>$name</b> - $param[description]"
            .'</li>';
    }
    $html .= '</ul>';
    return $html;
}

$api_base = "https://zvini.com/api-call/";
echo '<!DOCTYPE html>'
    .'<html>'
        .'<head>'
            .'<title>Zvini API</title>'
            .'<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />'
            .'<link rel="stylesheet" type="text/css" href="index.css" />'
        .'</head>'
        .'<body>'
            .'<div class="layout-title">'
                .'<h1>Zvini API Documentation</h1>'
            .'</div>'
            .'<div class="layout-index">'
                .'<div class="padder">'
                    .'<h2>Table of Contents</h2>'
                    .'<ul class="tableOfContents">'
                        .'<li>'
                            .'<a href="#Introduction">Introduction</a>'
                        .'</li>'
                        .'<li>'
                            .'<ul>'
                                .'<a href="#API Methods">API Methods</a>'
                                .'<li>'
                                    .'<a href="#notification/post">notification/post</a>'
                                .'</li>'
                            .'</ul>'
                        .'</li>'
                    .'</ul>'
                .'</div>'
            .'</div>'
            .'<div class="layout-content">'
                .'<div class="padder">'
                    .create_h2('Introduction')
                    .'<br />'
                    .'<div>'
                        .'<div>'
                            .'Zvini API allows programs to access, modify and delete user data using HTTP and JSON.'
                            .' Programs are given API keys with which they call API methods.'
                            .' The API methods can be called with either GET or POST methods.'
                            .' The methods parameters can be passes either in a query string or as a URL-encoded form data.'
                            .' The API key parameter <code>api_key</code> should be present in all requests.'
                            ." The base URL of all the API methods is <code>$api_base</code>."
                            .' The response returned from the server is always a JSON document.'
                            .' Below is a PHP code that calls an example method:'
                        .'</div>'
                        .'<br />'
                        .'<pre class="php-code">'
                            ."<span class=\"comment\">// prepare parameteres</span>\n"
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
                        .'</pre>'
                    .'</div>'
                    .'<br />'
                    .create_h2('API Methods')
                    .'<br />'
                    .create_api_method([
                        'name' => 'notification/post',
                        'description' => 'Sends a notification in a channel.',
                        'params' => [
                            'channel_name' => [
                                'description' => 'The name of the channel in which in which the notification will be published.',
                            ],
                            'notification_text' => [
                                'description' => 'The text to send.',
                            ],
                        ],
                    ])
                .'</div>'
            .'</div>'
        .'</body>'
    .'</html>';
