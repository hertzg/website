<?php

function get_prepare_params () {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/get_absolute_base.php";
    $cross_site_api_base = get_absolute_base().'cross-site-api-call/';

    include_once "$fnsDir/phpCode.php";
    return
        phpCode\comment('prepare parameters')
        .phpCode\statement(
            phpCode\assignment(
                phpCode\variable('cross_site_api_base'),
                phpCode\stringLiteral($cross_site_api_base)
            )
        )
        .phpCode\statement(
            phpCode\assignment(
                phpCode\variable('cross_site_api_key'),
                phpCode\stringLiteral('DPFvTPfRvNPLfVvR4...')
            )
        )
        .phpCode\statement(
            phpCode\assignment(
                phpCode\variable('method'),
                phpCode\stringLiteral('someNamespace/someMethod')
            )
        )
        .phpCode\statement(
            phpCode\assignment(
                phpCode\variable('params'),
                phpCode\squareBrackets(
                    "\n"
                    .phpCode\indent(
                        phpCode\arrayKeyValue(
                            phpCode\stringLiteral('cross_site_api_key'),
                            phpCode\variable('cross_site_api_key')
                        )."\n",
                        phpCode\arrayKeyValue(
                            phpCode\stringLiteral('param1'),
                            phpCode\stringLiteral('value1')
                        )."\n",
                        phpCode\arrayKeyValue(
                            phpCode\stringLiteral('param2'),
                            phpCode\stringLiteral('value2')
                        )."\n",
                        phpCode\comment('...')
                    )
                )
            )
        )
        ."\n";

}
