<?php
require "bitfinex.v2.class.php";

$api_key        ="MY_BFX_KEY";
$api_secret     ="MY_BFX_SECRET";
$bfx            =new Bitfinex($api_key, $api_secret);

/* Fetch wallet balances */
$balances=$bfx->get_balances();
echo '<h1>Balances</h1>';
echo '<pre>';print_r($balances);echo '</pre>';
/* Sample for fetching multiple tickers, based on populated wallet values: */
$t_data=array();
for ($z=0; $z<count($balances); $z++) {
        if ($balances[$z]["currency"]=="USD") {
                array_push($t_data, "fUSD");
        } else {
                array_push($t_data, "t".$balances[$z]["currency"]."USD");
                if ($balances[$z]["currency"]!=="BTC") {
                array_push($t_data, "t".$balances[$z]["currency"]."BTC");
                }
        }
}
//$tickers=$bfx->get_tickers($t_data);
$tickers=$bfx->get_tickers(array("ALL"));
echo '<h1>Tickers</h1>';
echo '<pre>';print_r($tickers);echo '</pre>';

/* Fetch one ticker */
$ticker=$bfx->get_ticker("tSANBTC");
echo '<h1>Ticker</h1>';
echo '<pre>';print_r($ticker);echo '</pre>';

/* Fetch open orders */
$orders=$bfx->get_orders();
echo '<h1>Orders</h1>';
echo '<pre>';print_r($orders);echo '</pre>';

/* Fetch orders history */
$orderhist=$bfx->get_orderhist('tSANBTC');
echo '<h1>Order History SAN/BTC</h1>';
echo '<pre>';print_r($orderhist);echo '</pre>';
?>
