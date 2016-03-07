<?php

function get_code () {
    include_once __DIR__.'/get_prepare_params.php';
    include_once __DIR__.'/get_send_request.php';
    include_once __DIR__.'/../../../../fns/phpCode.php';
    return get_prepare_params()
        .get_send_request()
        .phpCode\comment('check for errors')
        .phpCode\ifStatement(
            phpCode\comparison(
                phpCode\variable('response'),
                '===',
                phpCode\keyword('false')
            ),
            phpCode\curlyBrackets(
                "\n"
                .phpCode\indent(
                    phpCode\statement(
                        phpCode\functionCall(
                            'die',
                            phpCode\concat(
                                phpCode\stringLiteral('ERROR: '),
                                phpCode\functionCall(
                                    'curl_error',
                                    phpCode\variable('ch')
                                )
                            )
                        )
                    )
                )
            )
        )."\n"
        .phpCode\ifStatement(
            phpCode\comparison(
                phpCode\functionCall(
                    'curl_getinfo',
                    phpCode\commaSeparate(
                        phpCode\variable('ch'),
                        phpCode\constant('CURLINFO_HTTP_CODE')
                    )
                ),
                '!==',
                phpCode\number(200)
            ),
            phpCode\curlyBrackets(
                "\n"
                .phpCode\indent(
                    phpCode\statement(
                        phpCode\functionCall(
                            'die',
                            phpCode\concat(
                                phpCode\stringLiteral('ERROR: '),
                                phpCode\variable('response')
                            )
                        )
                    )
                )
            )
        )."\n"
        ."\n"
        .phpCode\comment('decode json')
        .phpCode\statement(
            phpCode\assignment(
                phpCode\variable('response'),
                phpCode\functionCall(
                    'json_decode',
                    phpCode\variable('response')
                )
            )
        )."\n"
        .phpCode\comment('do something with the response');
}
