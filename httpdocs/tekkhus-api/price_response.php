<?php
include('class/tekkhus_sw6_api.php');

$token_start_time = microtime(true);

$p_nrs = array("P150736", "P145581", "P151650");

$sw6_api = new tekkhus_sw6_api();

$access_token_sw6 = $sw6_api->auth_to_shopware();

$prices = $sw6_api->get_current_price_from_tekkhus($p_nrs);

$price_str = $prices["P150736"] . " €|" . $prices["P145581"] . " €|" . $prices["P151650"] . " €";

echo $price_str;
?>