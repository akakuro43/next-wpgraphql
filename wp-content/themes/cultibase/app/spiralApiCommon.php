<?php
    global $DB_NAME,$TOKEN,$SECRET;
    
    // API用のHTTPヘッダ
    $api_headers = array(
    "X-SPIRAL-API: locator/apiserver/request",
    "Content-Type: application/json; charset=UTF-8",
    );
    // 送信するJSONデータを作成
    $parameters = array();
    $parameters["spiral_api_token"] = $TOKEN; //トークン
    // 送信用のJSONデータを作成します。
    $json = json_encode($parameters);
    // curlライブラリを使って送信します。
    $curl = curl_init("https://www.pi-pe.co.jp/api/locator");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST , true);
    curl_setopt($curl, CURLOPT_POSTFIELDS , $json);
    curl_setopt($curl, CURLOPT_HTTPHEADER , $api_headers);
    curl_exec($curl);
    // エラーがあればエラー内容を表示
    if (curl_errno($curl)) echo curl_error($curl);
    $response = curl_multi_getcontent($curl);
    curl_close($curl);
    $response_json = json_decode($response , true);
    // サービス用のURL
    $APIURL = $response_json['location'];

?>