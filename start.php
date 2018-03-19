<?php
// start.php

// YConnectライブラリ読み込み...(1)
require("lib/YConnect.inc");
 
// アプリケーションID, シークレット...(2)
$client_id     = "dj00aiZpPXE3Y1BNSGJhVmU1ZiZzPWNvbnN1bWVyc2VjcmV0Jng9YzU-";
$client_secret = "b1gqERWZ2gabYnzIOW9DmwYLNdEXbCIYgPbSgBY0";
 
// コールバックURL...(3)
$callback_uri = "https://frozen-reef-73565.herokuapp.com/signup.php";
// リクエストとコールバック間の検証用のランダムな文字列を指定してください...(4)
$state = "44Oq44Ki5YWF44Gr5L+644Gv44Gq44KL77yB";
// リプレイアタック対策のランダムな文字列を指定してください...(5)
$nonce = "5YOV44Go5aWR57SE44GX44GmSUTljqjjgavjgarjgaPjgabjgog=";
// レスポンスタイプ...(6)
$response_type = OAuth2ResponseType::CODE_IDTOKEN;
// Scope...(7)
$scope = array(
    OIDConnectScope::OPENID,
    OIDConnectScope::PROFILE,
    OIDConnectScope::EMAIL,
    OIDConnectScope::ADDRESS
);
// display...(8)
$display = OIDConnectDisplay::DEFAULT_DISPLAY;
// prompt...(9)
$prompt = array(
    OIDConnectPrompt::DEFAULT_PROMPT
);
 
// クレデンシャルインスタンス生成
$cred = new ClientCredential( $client_id, $client_secret );
// YConnectクライアントのインスタンス生成
$client = new YConnectClient( $cred );
 
// デバッグ用ログ出力...(10)
$client->enableDebugMode();
 
// Authorizationエンドポイントにリクエスト...(11)
$client->requestAuth(
    $callback_uri,
    $state,
    $nonce,
    $response_type,
    $scope,
    $display,
    $prompt
);
