<?php

//===========================
// セッション開始
//===========================
function init_session_start(){
  startSession();
}
add_action('init', 'init_session_start');

function startSession() {
  // セッションの有効期限を14日に設定
  session_set_cookie_params(60 * 60 * 24 * 14);
  // セッション管理開始
  session_start();
  // セッションから情報を取得する
  $loginFlg = getSessionLoginFlg();
  $memberId = getSessionMemberId();
  
  if($loginFlg && $memberId) {
    $userInfo = getUserInfoByMemberId($memberId);
    if($userInfo != null && $userInfo['loginFlg'] == 0) {
      clearSessionAll();
    } else {
      // ログイン日時更新
      selectUpdateLogin($userInfo['email']);
    }
  } else {
    clearSessionAll();
  }
}

//===========================
// セッションclear
//===========================
/*
 * clearSessionAll
 * セッションで保持している情報を削除する。
 */
function clearSessionAll() {
  // 会員情報DBの情報
  $_SESSION['memberId'] = "";         // 会員ID
  $_SESSION['userName'] = "";         // お名前
  $_SESSION['email'] = "";            // メールアドレス
  $_SESSION['password'] = "";         // パスワード
  $_SESSION['loginFlg'] = 0;          // ログインフラグ(0：未ログイン,1：ログイン)
  $_SESSION['memberStatus'] = "";     // 会員ステータス(1：入会中, 2：退会済み, 3：支払い滞納中)
  $_SESSION['memberPlan'] = "";       // 会員プラン（1：Lab会員（個人プラン）, 2：Lab会員（法人プラン））
  $_SESSION['paymentResult'] = "";    // 決済結果（1：決済成功, 2：決済失敗）
  $_SESSION['delKey'] = "";           // キー

  // アプリ内の情報
  $_SESSION['beforeLoginURL'] = "";
}

//======================================================
// セッションgetter/setter
// セッション情報へはgetter/setterを使用しアクセスする。
//======================================================

/*
 * setSessionAll
 * セッションに情報を設定する
 * @param $userInfo ユーザ情報の連想配列
 * @param $password パスワード
 */
function setSessionAll($userInfo) {
  $_SESSION['memberId'] = $userInfo["memberId"];
  $_SESSION['userName'] = $userInfo["userName"];
  $_SESSION['email'] = $userInfo["email"];
  $_SESSION['password'] = $userInfo["password"];
  $_SESSION['loginFlg'] = $userInfo["loginFlg"];
  $_SESSION['memberStatus'] = $userInfo["memberStatus"];
  $_SESSION['memberPlan'] = $userInfo["memberPlan"];
  $_SESSION['paymentResult'] = $userInfo["paymentResult"];
  $_SESSION['delKey'] = $userInfo["delKey"];
  $_SESSION['id'] = $userInfo["id"];
}


// TODO 必要か検討
/*
* setSessionMailMagazineFlg
* セッションにメルマガ有無を設定する
* @param $mailMagazineFlg メルマガ有無
*/
function setSessionMailMagazineFlg($mailMagazineFlg) {
  $_SESSION['mailMagazineFlg'] = $mailMagazineFlg;
}

/*
* getSessionMemberId
* セッションからキーを取得する
* @return キー
*/
function getSessionMemberId() {
  return $_SESSION['memberId'];
}

/*
* getSessionUserName
* セッションからお名前を取得する
* @return お名前
*/
function getSessionUserName() {
  return $_SESSION['userName'];
}

/*
* getSessionEmail
* セッションからメールアドレスを取得する
* @return メールアドレス
*/
function getSessionEmail() {
  return $_SESSION['email'];
}

/*
* getSessionPassword
* セッションからパスワードを取得する
* @return パスワード
*/
function getSessionPassword() {
  return $_SESSION['password'];
}

/*
* getSessionLoginFlg
* セッションからログインフラグを取得する
* @return ログインフラグ true: ログイン中, false：ログアウト中
*/
function getSessionLoginFlg() {
  return $_SESSION['loginFlg'] == 1;
}

/*
* getSessionMemberStatus
* セッションから会員ステータスを取得する
* @return 会員ステータス
*/
function getSessionMemberStatus() {
  return $_SESSION['memberStatus'];
}

/*
* getSessionMemberPlan
* セッションから会員プランを取得する
* @return 会員プラン
*/
function getSessionMemberPlan() {
  return $_SESSION['memberPlan'];
}

/*
* getSessionDelKey
* セッションからキーを取得する
* @return キー
*/
function getSessionDelKey() {
return $_SESSION['delKey'];
}



?>