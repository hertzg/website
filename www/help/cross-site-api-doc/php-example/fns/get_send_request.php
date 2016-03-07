<?php

function get_send_request () {
    include_once __DIR__.'/../../../../fns/phpCode.php';
    return
        phpCode\comment('send request')
        .phpCode\statement(
            phpCode\assignment(
                phpCode\variable('ch'),
                phpCode\functionCall('curl_init', '')
            )
        )
        .phpCode\statement(
            phpCode\functionCall(
                'curl_setopt_array',
                phpCode\commaSeparate(
                    phpCode\variable('ch'),
                    phpCode\squareBrackets(
                        "\n"
                        .phpCode\indent(
                            phpCode\arrayKeyValue(
                                phpCode\constant('CURLOPT_POSTFIELDS'),
                                phpCode\functionCall(
                                    'http_build_query',
                                    phpCode\variable('params')
                                )
                            )."\n",
                            phpCode\arrayKeyValue(
                                phpCode\constant('CURLOPT_RETURNTRANSFER'),
                                phpCode\keyword('true')
                            )."\n",
                            phpCode\arrayKeyValue(
                                phpCode\constant('CURLOPT_URL'),
                                phpCode\concat(
                                    phpCode\variable('cross_site_api_base'),
                                    phpCode\variable('method')
                                )
                            )."\n"
                        )
                    )
                )
            )
        )
        .phpCode\statement(
            phpCode\assignment(
                phpCode\variable('response'),
                phpCode\functionCall(
                    'curl_exec',
                    phpCode\variable('ch')
                )
            )
        )
        ."\n";
}
