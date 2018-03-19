<?php
// signup.php

//...前処理...
$client = new YConnectClient( $cred );
 
// 認可コードを取得...(1)
$code_result = $client->getAuthorizationCode( $state );
 
if( $code_result ) {
 
    try {
        // Tokenエンドポイントにリクエスト...(2)
        $client->requestAccessToken(
            $redirect_uri,
            $code_result
        );
    } catch ( OAuth2TokenException $e ) {
        if( $e->invalidGrant() ) {
            // 再度Authorizationエンドポイントへリクエスト...(3)
        }
    }
 
    try {
        // IDトークンを検証...(4)
        $client->verifyIdToken( $nonce );
        // アクセストークン、リフレッシュトークンを取得...(5)
        $accessToken  = $client->getAccessToken();
        $refreshToken = $client->getRefreshToken();
    } catch ( IdTokenException $e ) {
        // 認証失敗...(6)
        echo "Unauthorized";
    }
    // ユーザー識別子を取得...(7)
    $userId = $client->getIdToken();
}
// ログインセッションの発行など...(8)
