<?php

function get_prepare_params () {

    $fnsDir = __DIR__.'/../../../../../fns';

    include_once "$fnsDir/DomainName/get.php";
    include_once "$fnsDir/SiteBase/get.php";
    include_once "$fnsDir/SiteProtocol/get.php";
    $admin_api_base = SiteProtocol\get().'://'
        .DomainName\get().SiteBase\get().'admin/api-call/';

    include_once "$fnsDir/phpCode.php";
    return
        phpCode\comment('prepare parameters')
        .phpCode\statement(
            phpCode\assignment(
                phpCode\variable('admin_api_base'),
                phpCode\stringLiteral($admin_api_base)
            )
        )
        .phpCode\statement(
            phpCode\assignment(
                phpCode\variable('admin_api_key'),
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
                            phpCode\stringLiteral('admin_api_key'),
                            phpCode\variable('admin_api_key')
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
