<?php
//===========================
// 会員情報DB操作
//===========================

/*
 * hasUser
 * 会員情報DBに対象レコードがあるか確認する
 * @param $email メールアドレス(ID)
 * @return ログイン可否 0:レコードなし(ログイン失敗),1:レコードあり(ログイン成功)
 */
function hasUser($email) {
  include 'spiralApiCommon.php';
  // API用のHTTPヘッダ
  $api_headers = array(
  "X-SPIRAL-API: database/select/request",
  "Content-Type: application/json; charset=UTF-8",
  );
  // 送信するJSONデータを作成
  $parameters = array();
  $parameters["spiral_api_token"] = $TOKEN; //トークン
  $parameters["db_title"] = $DB_NAME; //DBのタイトル
  $parameters["passkey"] = time(); //エポック秒
  // 表示カラム名
  $parameters["select_columns"] = array("email");
  // 検索条件
  $parameters["search_condition"] = array(
      array("name" => "email", "value" => $email),
  );
  // 署名を付けます
  $key = $parameters["spiral_api_token"] . "&" . $parameters["passkey"];
  $parameters["signature"] = hash_hmac('sha1', $key, $SECRET, false);
  // 送信用のJSONデータを作成します。
  $json = json_encode($parameters);

  // curlライブラリを使って送信します。
  $curl = curl_init($APIURL);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_POST , true);
  curl_setopt($curl, CURLOPT_POSTFIELDS , $json);
  curl_setopt($curl, CURLOPT_HTTPHEADER , $api_headers);
  curl_exec($curl);
  // エラーがあればエラー内容を表示
  if (curl_errno($curl)) echo curl_error($curl);
  $response = curl_multi_getcontent($curl);
  curl_close($curl);
  // 画面に表示
  // セレクトデータ
  // print_r(json_decode($response, true));
  // セレクト数
  // print(json_decode($response, true)['count']);

  $result = 0; // 0:存在なし
  if(json_decode($response, true)['count'] == 1) {
      $result = 1; // 1:存在あり
  }
  return $result;
}

/*
* getUserInfo
* 会員情報DBからユーザ情報を取得する
* @param $email メールアドレス(ID)
* @return ユーザ情報
*/
function getUserInfo($email, $password) {
  include 'spiralApiCommon.php';
  // -----------------------------------------------------------------------------
  // select
  // -----------------------------------------------------------------------------
  // API用のHTTPヘッダ
  $api_headers = array(
  "X-SPIRAL-API: database/select/request",
  "Content-Type: application/json; charset=UTF-8",
  );
  // 送信するJSONデータを作成
  $parameters = array();
  $parameters["spiral_api_token"] = $TOKEN; //トークン
  $parameters["db_title"] = $DB_NAME; //DBのタイトル
  $parameters["passkey"] = time(); //エポック秒
  // 表示カラム名
  $parameters["select_columns"] =
      array(
          "memberId",
          "userName",
          "email",
          "loginFlg",
          "memberStatus",
          "memberPlan",
          "paymentResult",
          "delKey",
          "id",
          );
  // 検索条件
  $parameters["search_condition"] = array(
      array("name" => "email", "value" => $email),
      array("name" => "password", "value" => $password),
  );
  // 署名を付けます
  $key = $parameters["spiral_api_token"] . "&" . $parameters["passkey"];
  $parameters["signature"] = hash_hmac('sha1', $key, $SECRET, false);
  // 送信用のJSONデータを作成します。
  $json = json_encode($parameters);

  // curlライブラリを使って送信します。
  $curl = curl_init($APIURL);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_POST , true);
  curl_setopt($curl, CURLOPT_POSTFIELDS , $json);
  curl_setopt($curl, CURLOPT_HTTPHEADER , $api_headers);
  curl_exec($curl);
  // エラーがあればエラー内容を表示
  if (curl_errno($curl)) echo curl_error($curl);
  $response = curl_multi_getcontent($curl);
  curl_close($curl);
  // 画面に表示
  // セレクトデータ
//   print_r(json_decode($response, true));
  // セレクト数
  // print(json_decode($response, true)['count']);


  $resMemberId = json_decode($response, true)['data'][0][0];
  $resUserName = json_decode($response, true)['data'][0][1];
  $resEmail = json_decode($response, true)['data'][0][2];
  $resLoginFlg = json_decode($response, true)['data'][0][3];
  $resMemberStatus = json_decode($response, true)['data'][0][4];
  $resMemberPlan = json_decode($response, true)['data'][0][5];  
  $resPaymentResult = json_decode($response, true)['data'][0][6];
  $resDelKey = json_decode($response, true)['data'][0][7];
  $resId = json_decode($response, true)['data'][0][8];

  $userInfo = array(
      'memberId' => $resMemberId,
      'userName' => $resUserName,
      'email' => $resEmail,
      'loginFlg' => $resLoginFlg,
      'memberStatus' => $resMemberStatus,
      'memberPlan' => $resMemberPlan,
      'paymentResult' => $resPaymentResult,
      'delKey' => $resDelKey,
      'id' => $resId
  );
  return $userInfo;
}

/*
* getUserInfoByOrderId
* 会員情報DBからユーザ情報を取得する
* @param $memberId メンバーID
* @return ユーザ情報
*/
function getUserInfoByOrderId($orderId) {
  include 'spiralApiCommon.php';
  // -----------------------------------------------------------------------------
  // select
  // -----------------------------------------------------------------------------
  // API用のHTTPヘッダ
  $api_headers = array(
  "X-SPIRAL-API: database/select/request",
  "Content-Type: application/json; charset=UTF-8",
  );
  // 送信するJSONデータを作成
  $parameters = array();
  $parameters["spiral_api_token"] = $TOKEN; //トークン
  $parameters["db_title"] = $DB_NAME; //DBのタイトル
  $parameters["passkey"] = time(); //エポック秒
  // 表示カラム名
  $parameters["select_columns"] =
    array(
      "memberId",
      "userName",
      "email",
      "loginFlg",
      "memberStatus",
      "memberPlan",
      "paymentResult",
      "delKey",
      "id",
      
      );
  // 検索条件
  $parameters["search_condition"] = array(
      array("name" => "orderID", "value" => $orderId),
  );
  // 署名を付けます
  $key = $parameters["spiral_api_token"] . "&" . $parameters["passkey"];
  $parameters["signature"] = hash_hmac('sha1', $key, $SECRET, false);
  // 送信用のJSONデータを作成します。
  $json = json_encode($parameters);

  // curlライブラリを使って送信します。
  $curl = curl_init($APIURL);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_POST , true);
  curl_setopt($curl, CURLOPT_POSTFIELDS , $json);
  curl_setopt($curl, CURLOPT_HTTPHEADER , $api_headers);
  curl_exec($curl);
  // エラーがあればエラー内容を表示
  if (curl_errno($curl)) echo curl_error($curl);
  $response = curl_multi_getcontent($curl);
  curl_close($curl);
  // 画面に表示
  // セレクトデータ
//   print_r(json_decode($response, true));
  // セレクト数
  // print(json_decode($response, true)['count']);

  $resMemberId = json_decode($response, true)['data'][0][0];
  $resUserName = json_decode($response, true)['data'][0][1];
  $resEmail = json_decode($response, true)['data'][0][2];
  $resLoginFlg = json_decode($response, true)['data'][0][3];
  $resMemberStatus = json_decode($response, true)['data'][0][4];
  $resMemberPlan = json_decode($response, true)['data'][0][5];  
  $resPaymentResult = json_decode($response, true)['data'][0][6];
  $resDelKey = json_decode($response, true)['data'][0][7];
  $resId = json_decode($response, true)['data'][0][8];

  $userInfo = array(
      'memberId' => $resMemberId,
      'userName' => $resUserName,
      'email' => $resEmail,
      'loginFlg' => $resLoginFlg,
      'memberStatus' => $resMemberStatus,
      'memberPlan' => $resMemberPlan,
      'paymentResult' => $resPaymentResult,
      'delKey' => $resDelKey,
      'id' => $resId
  );
  return $userInfo;
}


/*
* getUserInfoByMemberId
* 会員情報DBからユーザ情報を取得する
* @param $memberId メンバーID
* @return ユーザ情報
*/
function getUserInfoByMemberId($memberId) {
  include 'spiralApiCommon.php';
  // -----------------------------------------------------------------------------
  // select
  // -----------------------------------------------------------------------------
  // API用のHTTPヘッダ
  $api_headers = array(
  "X-SPIRAL-API: database/select/request",
  "Content-Type: application/json; charset=UTF-8",
  );
  // 送信するJSONデータを作成
  $parameters = array();
  $parameters["spiral_api_token"] = $TOKEN; //トークン
  $parameters["db_title"] = $DB_NAME; //DBのタイトル
  $parameters["passkey"] = time(); //エポック秒
  // 表示カラム名
  $parameters["select_columns"] =
    array(
        // セッション管理する情報
        "memberId",
        "userName",
        "email",
        "loginFlg",
        "memberStatus",
        "memberPlan",
        "paymentResult",
        "delKey",
        "id",
        
        );
  // 検索条件
  $parameters["search_condition"] = array(
      array("name" => "memberId", "value" => $memberId),
  );
  // 署名を付けます
  $key = $parameters["spiral_api_token"] . "&" . $parameters["passkey"];
  $parameters["signature"] = hash_hmac('sha1', $key, $SECRET, false);
  // 送信用のJSONデータを作成します。
  $json = json_encode($parameters);

  // curlライブラリを使って送信します。
  $curl = curl_init($APIURL);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_POST , true);
  curl_setopt($curl, CURLOPT_POSTFIELDS , $json);
  curl_setopt($curl, CURLOPT_HTTPHEADER , $api_headers);
  curl_exec($curl);
  // エラーがあればエラー内容を表示
  if (curl_errno($curl)) echo curl_error($curl);
  $response = curl_multi_getcontent($curl);
  curl_close($curl);
  // 画面に表示
  // セレクトデータ
  // print_r(json_decode($response, true));
  // セレクト数
  // print(json_decode($response, true)['count']);

  $resMemberId = json_decode($response, true)['data'][0][0];
  $resUserName = json_decode($response, true)['data'][0][1];
  $resEmail = json_decode($response, true)['data'][0][2];
  $resLoginFlg = json_decode($response, true)['data'][0][3];
  $resMemberStatus = json_decode($response, true)['data'][0][4];
  $resMemberPlan = json_decode($response, true)['data'][0][5];  
  $resPaymentResult = json_decode($response, true)['data'][0][6];
  $resDelKey = json_decode($response, true)['data'][0][7];
  $resId = json_decode($response, true)['data'][0][8];
//   $resJobType = json_decode($response, true)['data'][0][9];
//   $resCompany = json_decode($response, true)['data'][0][10];
  

  $userInfo = array(
      'memberId' => $resMemberId,
      'userName' => $resUserName,
      'email' => $resEmail,
      'loginFlg' => $resLoginFlg,
      'memberStatus' => $resMemberStatus,
      'memberPlan' => $resMemberPlan,
      'paymentResult' => $resPaymentResult,
      'delKey' => $resDelKey,
      'id' => $resId

    //   'jobType' => $resJobType,
    //   'company' => $resCompany,
    //   'id' => $resId,
  );
  return $userInfo;
}

/*
* getWithdrawalUserInfo
* 退会時のユーザー情報を取得する
* @param $memberId メンバーID
* @return ユーザ情報
*/
function getWithdrawalUserInfo($memberId) {
    include 'spiralApiCommon.php';
    // -----------------------------------------------------------------------------
    // select
    // -----------------------------------------------------------------------------
    // API用のHTTPヘッダ
    $api_headers = array(
    "X-SPIRAL-API: database/select/request",
    "Content-Type: application/json; charset=UTF-8",
    );
    // 送信するJSONデータを作成
    $parameters = array();
    $parameters["spiral_api_token"] = $TOKEN; //トークン
    $parameters["db_title"] = $DB_NAME; //DBのタイトル
    $parameters["passkey"] = time(); //エポック秒
    // 表示カラム名
    $parameters["select_columns"] =
      array(
          "memberId",
          "email",
          "userName",
          "birthday",
          "company",
          "jobType",
          "joinPoint",
          "registDate",
          "delKey",
          "paymentGid",
          "paymentAcid",
          "orderID",
          );
    // 検索条件
    $parameters["search_condition"] = array(
        array("name" => "memberId", "value" => $memberId),
    );
    // 署名を付けます
    $key = $parameters["spiral_api_token"] . "&" . $parameters["passkey"];
    $parameters["signature"] = hash_hmac('sha1', $key, $SECRET, false);
    // 送信用のJSONデータを作成します。
    $json = json_encode($parameters);
  
    // curlライブラリを使って送信します。
    $curl = curl_init($APIURL);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST , true);
    curl_setopt($curl, CURLOPT_POSTFIELDS , $json);
    curl_setopt($curl, CURLOPT_HTTPHEADER , $api_headers);
    curl_exec($curl);
    // エラーがあればエラー内容を表示
    if (curl_errno($curl)) echo curl_error($curl);
    $response = curl_multi_getcontent($curl);
    curl_close($curl);
    // 画面に表示
    // セレクトデータ
    // print_r(json_decode($response, true));
    // セレクト数
    // print(json_decode($response, true)['count']);
  
    $resMemberId = json_decode($response, true)['data'][0][0];
    $resEmail = json_decode($response, true)['data'][0][1];
    $resUserName = json_decode($response, true)['data'][0][2];
    $resBirthday = json_decode($response, true)['data'][0][3];
    $resCompany = json_decode($response, true)['data'][0][4];
    $resJobType = json_decode($response, true)['data'][0][5];
    $resJoinPoint = json_decode($response, true)['data'][0][6];
    $resRegistDate = json_decode($response, true)['data'][0][7];
    $resDelKey = json_decode($response, true)['data'][0][8];
    $resPaymentGid = json_decode($response, true)['data'][0][9];
    $resPaymentAcid = json_decode($response, true)['data'][0][10];
    $resOrderID = json_decode($response, true)['data'][0][11];

    $withdrawalUserInfo = array(
        'memberId' => $resMemberId,
        'email' => $resEmail,
        'userName' => $resUserName,
        'birthday' => $resBirthday,
        'company' => $resCompany,
        'jobType' => $resJobType,
        'joinPoint' => $resJoinPoint,
        'registDate' => $resRegistDate,
        'delKey' => $resDelKey,
        'paymentGid' => $resPaymentGid,
        'paymentAcid' => $resPaymentAcid,
        'orderID' => $resOrderID,
    );
    return $withdrawalUserInfo;
  }

/*
* getPaymentInfo
* 決済情報を取得する
* @param $memberId メンバーID
* @return 決済情報
*/
function getPaymentInfo($memberId) {
  include 'spiralApiCommon.php';
  // -----------------------------------------------------------------------------
  // select
  // -----------------------------------------------------------------------------
  // API用のHTTPヘッダ
  $api_headers = array(
  "X-SPIRAL-API: database/select/request",
  "Content-Type: application/json; charset=UTF-8",
  );
  // 送信するJSONデータを作成
  $parameters = array();
  $parameters["spiral_api_token"] = $TOKEN; //トークン
  $parameters["db_title"] = $DB_NAME; //DBのタイトル
  $parameters["passkey"] = time(); //エポック秒
  // 表示カラム名
  $parameters["select_columns"] =
    array(
        "paymentGid",
        "paymentAcid",
        );
  // 検索条件
  $parameters["search_condition"] = array(
      array("name" => "memberId", "value" => $memberId),
  );
  // 署名を付けます
  $key = $parameters["spiral_api_token"] . "&" . $parameters["passkey"];
  $parameters["signature"] = hash_hmac('sha1', $key, $SECRET, false);
  // 送信用のJSONデータを作成します。
  $json = json_encode($parameters);

  // curlライブラリを使って送信します。
  $curl = curl_init($APIURL);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_POST , true);
  curl_setopt($curl, CURLOPT_POSTFIELDS , $json);
  curl_setopt($curl, CURLOPT_HTTPHEADER , $api_headers);
  curl_exec($curl);
  // エラーがあればエラー内容を表示
  if (curl_errno($curl)) echo curl_error($curl);
  $response = curl_multi_getcontent($curl);
  curl_close($curl);
  // 画面に表示
  // セレクトデータ
  // print_r(json_decode($response, true));
  // セレクト数
  // print(json_decode($response, true)['count']);

  
  $resPaymentGid = json_decode($response, true)['data'][0][0];
  $resPaymentAcid = json_decode($response, true)['data'][0][1];
  

  $paymentInfo = array(
      'paymentGid' => $resPaymentGid,
      'paymentAcid' => $resPaymentAcid,

  );
  return $paymentInfo;
}

/*
* getProfileInfo
* プロフィール情報を取得する
* @param $memberId メンバーID
* @return ユーザ情報
*/
function getProfileInfo($memberId) {
    include 'spiralApiCommon.php';
    // -----------------------------------------------------------------------------
    // select
    // -----------------------------------------------------------------------------
    // API用のHTTPヘッダ
    $api_headers = array(
    "X-SPIRAL-API: database/select/request",
    "Content-Type: application/json; charset=UTF-8",
    );
    // 送信するJSONデータを作成
    $parameters = array();
    $parameters["spiral_api_token"] = $TOKEN; //トークン
    $parameters["db_title"] = $DB_NAME; //DBのタイトル
    $parameters["passkey"] = time(); //エポック秒
    // 表示カラム名
    $parameters["select_columns"] =
      array(
          "id",
          "jobType",
          "company",
          );
    // 検索条件
    $parameters["search_condition"] = array(
        array("name" => "memberId", "value" => $memberId),
    );
    // 署名を付けます
    $key = $parameters["spiral_api_token"] . "&" . $parameters["passkey"];
    $parameters["signature"] = hash_hmac('sha1', $key, $SECRET, false);
    // 送信用のJSONデータを作成します。
    $json = json_encode($parameters);
  
    // curlライブラリを使って送信します。
    $curl = curl_init($APIURL);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST , true);
    curl_setopt($curl, CURLOPT_POSTFIELDS , $json);
    curl_setopt($curl, CURLOPT_HTTPHEADER , $api_headers);
    curl_exec($curl);
    // エラーがあればエラー内容を表示
    if (curl_errno($curl)) echo curl_error($curl);
    $response = curl_multi_getcontent($curl);
    curl_close($curl);
    // 画面に表示
    // セレクトデータ
    // print_r(json_decode($response, true));
    // セレクト数
    // print(json_decode($response, true)['count']);
  
    $resId = json_decode($response, true)['data'][0][0];
    $resJobType = json_decode($response, true)['data'][0][1];
    $resCompany = json_decode($response, true)['data'][0][2];
    
  
    $profileInfo = array(
        'id' => $resId,
        'jobType' => $resJobType,
        'company' => $resCompany,
    );
    return $profileInfo;
  }

  /*
* getMailMagazineFlg
* メルマガフラグを取得する
* @param $memberId メンバーID
* @return メルマガフラグ
*/
function getMailMagazineFlg($memberId) {
    include 'spiralApiCommon.php';
    // -----------------------------------------------------------------------------
    // select
    // -----------------------------------------------------------------------------
    // API用のHTTPヘッダ
    $api_headers = array(
    "X-SPIRAL-API: database/select/request",
    "Content-Type: application/json; charset=UTF-8",
    );
    // 送信するJSONデータを作成
    $parameters = array();
    $parameters["spiral_api_token"] = $TOKEN; //トークン
    $parameters["db_title"] = $DB_NAME; //DBのタイトル
    $parameters["passkey"] = time(); //エポック秒
    // 表示カラム名
    $parameters["select_columns"] =
      array(
          "mailMagazineFlg",
    );
    // 検索条件
    $parameters["search_condition"] = array(
        array("name" => "memberId", "value" => $memberId),
    );
    // 署名を付けます
    $key = $parameters["spiral_api_token"] . "&" . $parameters["passkey"];
    $parameters["signature"] = hash_hmac('sha1', $key, $SECRET, false);
    // 送信用のJSONデータを作成します。
    $json = json_encode($parameters);
  
    // curlライブラリを使って送信します。
    $curl = curl_init($APIURL);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST , true);
    curl_setopt($curl, CURLOPT_POSTFIELDS , $json);
    curl_setopt($curl, CURLOPT_HTTPHEADER , $api_headers);
    curl_exec($curl);
    // エラーがあればエラー内容を表示
    if (curl_errno($curl)) echo curl_error($curl);
    $response = curl_multi_getcontent($curl);
    curl_close($curl);
    // 画面に表示
    // セレクトデータ
    // print_r(json_decode($response, true));
    // セレクト数
    // print(json_decode($response, true)['count']);
  
    $resMailMagazineFlg = json_decode($response, true)['data'][0][0];
    
    return $resMailMagazineFlg;
  }


/*
* selectUpdateLogin
* 会員情報DBのログイン関連のステータスを更新する。
* @param $email メールアドレス(ID)
* @param $password パスワード
* @return ログイン可否 0:レコードなし(ログイン失敗),1:レコードあり(ログイン成功)
*/
function selectUpdateLogin($email) {
  // print($email);

  include 'spiralApiCommon.php';
  // -----------------------------------------------------------------------------
  // update
  // -----------------------------------------------------------------------------
  $api_headers = array(
  "X-SPIRAL-API: database/update/request",
  "Content-Type: application/json; charset=UTF-8",
  );
  // 送信するJSONデータを作成
  $parameters = array();
  $parameters["spiral_api_token"] = $TOKEN; //トークン
  $parameters["db_title"] = $DB_NAME; //DBのタイトル
  $parameters["passkey"] = time(); //エポック秒
  // 検索条件
  $parameters["search_condition"] = array(
      array("name" => "email", "value" => $email),
      // array("name" => "password", "value" => $password),
      // array("name" => "memberStatus", "value" => "0"),
      // array("name" => "status", "value" => "0", "operator" => "!="),
  );
  // 更新データ
  $parameters["data"] = array(
      array("name" => "loginFlg", "value" => "1"),
      array("name" => "loginDate", "value" => "now"),
  );
  // 署名を付けます
  $key = $parameters["spiral_api_token"] . "&" . $parameters["passkey"];
  $parameters["signature"] = hash_hmac('sha1', $key, $SECRET, false);
  // 送信用のJSONデータを作成します。
  $json = json_encode($parameters);

  // curlライブラリを使って送信します。
  $curl = curl_init($APIURL);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_POST , true);
  curl_setopt($curl, CURLOPT_POSTFIELDS , $json);
  curl_setopt($curl, CURLOPT_HTTPHEADER , $api_headers);
  curl_exec($curl);
  // エラーがあればエラー内容を表示
  if (curl_errno($curl)) echo curl_error($curl);
  $response = curl_multi_getcontent($curl);
  curl_close($curl);
  // 画面に表示
//   print_r(json_decode($response, true));

  $result = 0; // 0:ログイン失敗
  if(json_decode($response, true)['count'] == 1) {
      $result = 1; // 1:ログイン成功
  }
  return $result;
}

/*
* upgradeLabStatus
* 会員情報DBのユーザー情報をLab会員のステータスにアップグレードする
* @param $email メールアドレス(ID)
* @param $password パスワード
* @return ログイン可否 0:レコードなし(ログイン失敗),1:レコードあり(ログイン成功)
*/
function upgradeLabStatus($memberId, $paymentResult, $gid, $acid) {
    // print($email);
  
    include 'spiralApiCommon.php';
    // -----------------------------------------------------------------------------
    // update
    // -----------------------------------------------------------------------------
    $api_headers = array(
    "X-SPIRAL-API: database/update/request",
    "Content-Type: application/json; charset=UTF-8",
    );
    // 送信するJSONデータを作成
    $parameters = array();
    $parameters["spiral_api_token"] = $TOKEN; //トークン
    $parameters["db_title"] = $DB_NAME; //DBのタイトル
    $parameters["passkey"] = time(); //エポック秒
    // 検索条件
    $parameters["search_condition"] = array(
        array("name" => "memberId", "value" => $memberId),
        // array("name" => "password", "value" => $password),
        // array("name" => "status", "value" => "0", "operator" => "!="),
    );
    // 更新データ
    $parameters["data"] = array(
        array("name" => "paymentGid", "value" => $gid), // 決済番号
        array("name" => "paymentResult", "value" => $paymentResult), // 決済結果
        array("name" => "paymentAcid", "value" => $acid), // 自動課金番号
        array("name" => "paymentRegDate", "value" => "now"), // 決済情報登録日
        array("name" => "loginFlg", "value" => "1"), // ログインフラグ
        array("name" => "incompleteFlg", "value" => "2"), // 登録完了フラグ
        
    );
    // 署名を付けます
    $key = $parameters["spiral_api_token"] . "&" . $parameters["passkey"];
    $parameters["signature"] = hash_hmac('sha1', $key, $SECRET, false);
    // 送信用のJSONデータを作成します。
    $json = json_encode($parameters);
  
    // curlライブラリを使って送信します。
    $curl = curl_init($APIURL);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POST , true);
    curl_setopt($curl, CURLOPT_POSTFIELDS , $json);
    curl_setopt($curl, CURLOPT_HTTPHEADER , $api_headers);
    curl_exec($curl);
    // エラーがあればエラー内容を表示
    if (curl_errno($curl)) echo curl_error($curl);
    $response = curl_multi_getcontent($curl);
    curl_close($curl);
    // 画面に表示
    // print_r(json_decode($response, true));
  
    $result = 0; // 0:更新失敗
    if(json_decode($response, true)['count'] == 1) {
        $result = 1; // 1:更新成功
    }
    return $result;
  }

/*
* upgradeLabStatus
* 会員情報DBのユーザー情報をLab会員のステータスにアップグレードする
* @param $email メールアドレス(ID)
* @param $password パスワード
* @return ログイン可否 0:レコードなし(ログイン失敗),1:レコードあり(ログイン成功)
*/
// function addEmail($memberId, $tempEmail) {
//     // print($email);
  
//     include 'spiralApiCommon.php';
//     // -----------------------------------------------------------------------------
//     // update
//     // -----------------------------------------------------------------------------
//     $api_headers = array(
//     "X-SPIRAL-API: database/update/request",
//     "Content-Type: application/json; charset=UTF-8",
//     );
//     // 送信するJSONデータを作成
//     $parameters = array();
//     $parameters["spiral_api_token"] = $TOKEN; //トークン
//     $parameters["db_title"] = $DB_NAME; //DBのタイトル
//     $parameters["passkey"] = time(); //エポック秒
//     // 検索条件
//     $parameters["search_condition"] = array(
//         array("name" => "memberId", "value" => $memberId),
//         // array("name" => "password", "value" => $password),
//         // array("name" => "status", "value" => "0", "operator" => "!="),
//     );
//     // 更新データ
//     $parameters["data"] = array(
//         array("name" => "email", "value" => $tempEmail), // メールアドレス
//         array("name" => "tempEmail", "value" => ''), // メールアドレス（Temp）  
//     );
//     // 署名を付けます
//     $key = $parameters["spiral_api_token"] . "&" . $parameters["passkey"];
//     $parameters["signature"] = hash_hmac('sha1', $key, $SECRET, false);
//     // 送信用のJSONデータを作成します。
//     $json = json_encode($parameters);
  
//     // curlライブラリを使って送信します。
//     $curl = curl_init($APIURL);
//     curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//     curl_setopt($curl, CURLOPT_POST , true);
//     curl_setopt($curl, CURLOPT_POSTFIELDS , $json);
//     curl_setopt($curl, CURLOPT_HTTPHEADER , $api_headers);
//     curl_exec($curl);
//     // エラーがあればエラー内容を表示
//     if (curl_errno($curl)) echo curl_error($curl);
//     $response = curl_multi_getcontent($curl);
//     curl_close($curl);
//     // 画面に表示
//     // print_r(json_decode($response, true));
  
//     $result = 0; // 0:更新失敗
//     if(json_decode($response, true)['count'] == 1) {
//         $result = 1; // 1:更新成功
//     }
//     return $result;
//   }

/*
* updateMailMagazineFlg
* 会員情報DBのログイン関連のステータスを更新する。
* @param $email メールアドレス(ID)
* @param $password パスワード
* @return ログイン可否 0:レコードなし(ログイン失敗),1:レコードあり(ログイン成功)
*/
function updateMailMagazineFlg($email, $mailMagazineFlg) {
  // print($email);
  // print($password);

  include 'spiralApiCommon.php';
  // -----------------------------------------------------------------------------
  // update
  // -----------------------------------------------------------------------------
  $api_headers = array(
  "X-SPIRAL-API: database/update/request",
  "Content-Type: application/json; charset=UTF-8",
  );
  // 送信するJSONデータを作成
  $parameters = array();
  $parameters["spiral_api_token"] = $TOKEN; //トークン
  $parameters["db_title"] = $DB_NAME; //DBのタイトル
  $parameters["passkey"] = time(); //エポック秒
  // 検索条件
  $parameters["search_condition"] = array(
      array("name" => "email", "value" => $email)
  );
  // 更新データ
  $parameters["data"] = array(
      array("name" => "mailMagazineFlg", "value" => $mailMagazineFlg),
      // array("name" => "loginDate", "value" => "now"),
  );
  // 署名を付けます
  $key = $parameters["spiral_api_token"] . "&" . $parameters["passkey"];
  $parameters["signature"] = hash_hmac('sha1', $key, $SECRET, false);
  // 送信用のJSONデータを作成します。
  $json = json_encode($parameters);

  // curlライブラリを使って送信します。
  $curl = curl_init($APIURL);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_POST , true);
  curl_setopt($curl, CURLOPT_POSTFIELDS , $json);
  curl_setopt($curl, CURLOPT_HTTPHEADER , $api_headers);
  curl_exec($curl);
  // エラーがあればエラー内容を表示
  if (curl_errno($curl)) echo curl_error($curl);
  $response = curl_multi_getcontent($curl);
  curl_close($curl);
  // 画面に表示
//   print_r(json_decode($response, true));

  $result = 0; // 0:ログイン失敗
  if(json_decode($response, true)['count'] == 1) {
      $result = 1; // 1:ログイン成功
  }
  return $result;
}

/*
 * selectUpdateLogout
 * ログアウトする。
 * @param $email メールアドレス(ID)
 * @return ログアウト可否 0:レコードなし(ログイン失敗),1:レコードあり(ログイン成功)
 */
function selectUpdateLogout($email,$delKey) {
  // print($email);

  include 'spiralApiCommon.php';
  // -----------------------------------------------------------------------------
  // update
  // -----------------------------------------------------------------------------
  $api_headers = array(
  "X-SPIRAL-API: database/update/request",
  "Content-Type: application/json; charset=UTF-8",
  );
  // 送信するJSONデータを作成
  $parameters = array();
  $parameters["spiral_api_token"] = $TOKEN; //トークン
  $parameters["db_title"] = $DB_NAME; //DBのタイトル
  $parameters["passkey"] = time(); //エポック秒
  // 検索条件
  $parameters["search_condition"] = array(
      array("name" => "email", "value" => $email),
      array("name" => "delKey", "value" => $delKey),
  );
  // 更新データ
  $parameters["data"] = array(
      array("name" => "loginFlg", "value" => "0"),
      // array("name" => "loginDate", "value" => "now"),
  );
  // 署名を付けます
  $key = $parameters["spiral_api_token"] . "&" . $parameters["passkey"];
  $parameters["signature"] = hash_hmac('sha1', $key, $SECRET, false);
  // 送信用のJSONデータを作成します。
  $json = json_encode($parameters);

  // curlライブラリを使って送信します。
  $curl = curl_init($APIURL);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_POST , true);
  curl_setopt($curl, CURLOPT_POSTFIELDS , $json);
  curl_setopt($curl, CURLOPT_HTTPHEADER , $api_headers);
  curl_exec($curl);
  // エラーがあればエラー内容を表示
  if (curl_errno($curl)) echo curl_error($curl);
  $response = curl_multi_getcontent($curl);
  curl_close($curl);
  // 画面に表示
  // print_r(json_decode($response, true));


  $result = 0; // 0:ログアウト失敗
  if(json_decode($response, true)['count'] == 1) {
      $result = 1; // 1:ログアウト成功
  }

  return $result;
}

?>