<?php

function get_prepare_params () {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/DomainName/get.php";
    $domainName = DomainName\get();

    include_once "$fnsDir/SiteBase/get.php";
    $siteBase = SiteBase\get();

    include_once "$fnsDir/SiteProtocol/get.php";
    $siteProtocol = SiteProtocol\get();

    $api_base = "$siteProtocol://$domainName{$siteBase}api-call/";

    include_once __DIR__.'/phpCode.php';
    return
        phpCode\comment('prepare parameters')
        .phpCode\statement(
            phpCode\assignment(
                phpCode\variable('method'),
                phpCode\stringLiteral('some-app/do-something')
            )
        )
        .phpCode\statement(
            phpCode\assignment(
                phpCode\variable('params'),
                phpCode\squareBrackets(
                    "\n"
                    .phpCode\indent(
                        phpCode\arrayKeyValue(
                            phpCode\stringLiteral('param1'),
                            phpCode\stringLiteral('value1')
                        )."\n",
                        phpCode\arrayKeyValue(
                            phpCode\stringLiteral('param2'),
                            phpCode\stringLiteral('value2')
                        )."\n"
                    )
                )
            )
        )
        .phpCode\statement(
            phpCode\assignment(
                phpCode\variable('api_key'),
                phpCode\stringLiteral('dee48716455972ce2...')
            )
        )
        .phpCode\statement(
            phpCode\assignment(
                phpCode\variable('api_base'),
                phpCode\stringLiteral($api_base)
            )
        )
        ."\n";

}
