<?php

class tekkhus_sw6_api
{


    function auth_to_shopware(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.tekkhus.com/api/oauth/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
                                        "grant_type": "client_credentials",
                                        "client_id": "SWIAZKPFTENHA0J2YTEZUNHKSW",
                                        "client_secret": "eU9GR3hqODFsTTc1bEdreFduZHFGRjltRUJaOGxJSFptQ0Y0cmM"
                                    }  ',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        //print("Auth Access Response: " . $response);
        $obj_ath = json_decode($response);

        curl_close($curl);
        return $obj_ath->{'access_token'};


    }


    function get_current_price_from_tekkhus($p_nrs){

        global $access_token_sw6, $token_start_time, $sw6_api;

        $new_key = "Konnte nicht ermittelt werden!";

        $p_nr_price_list = array();

        foreach ($p_nrs as $p_nr){

            $new_key = $p_nr;

            $time_current = microtime(true);
            $time = $time_current - $token_start_time;

            if($time > 580){

                $access_token_sw6 = $sw6_api->auth_to_shopware();
                $token_start_time = microtime(true);
                echo "Zeile 54: Auth Token wurde erneuert! Und hat den Wert:" . $token_start_time . "\n";

            }

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.tekkhus.com/api/product?filter%5BproductNumber%5D='.$new_key,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '. $access_token_sw6
                ),
            ));

            $response = curl_exec($curl);

            $obj_product = json_decode($response);

            curl_close($curl);
            $product_price = str_replace('.', ',', strval($obj_product->{'data'}[0]->{'attributes'}->{'price'}[0]->{'gross'}));



            $p_nr_price_list[$new_key] = $product_price;



        }

        return $p_nr_price_list;

    }

}
?>