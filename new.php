<?php

require "vendor/autoload.php";
$access_token = 'yQw5mqImEwMHcau8Hb9CXnPQaTlz11cUCGhUZL64yG1GyAyMJddLMqfjiLwlZgvKfdC2yo896ykJVwW8Xne9++3BjCqj9xsNEdeENjtWVda5UTFIw149B2ygMnCp/4Fcn/nAV1YYOX1YLNxEJkiHwwdB04t89/1O/w1cDnyilFU=';
$channelSecret = '5c1c1cb6d2769f4783b63c8ddddd8f82';
$idPush = 'U434d98c2ea737a9af2b3401a2c0abcbb'
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage('U7ef7a449f2a5c2057eacfc02ba2eb286', $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();
>
