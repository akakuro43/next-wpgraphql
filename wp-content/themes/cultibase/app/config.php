<?php
// *********************************************************************
//  本番とステージング環境における環境変数を定義している。
//  MODEで環境変数のバリューを切り替えるが、開発時やテスト時は"STAGING"とする。
//  本番リリースのときのみ"PRODUCTION"に変更する。
// *********************************************************************

// MODEにより、環境変数を切り替える
// $MODE = 'STAGING';
$MODE = 'PRODUCTION';

// プロダクションフラグ
$IS_PRODUCTION_MODE = false; // true → PRODUCTION, false → STAGING

switch ($MODE) {
  //---- 本番環境 ----//
  case 'PRODUCTION': 
    // --------------------------------
    // 記事の公開期限(日数)
    // --------------------------------
    $ARTICLE_PUBLICATION_DEADLINE = 30;

    // --------------------------------
    // 決済関連（ロボットペイメント）
    // --------------------------------
    // $ROBOTPAYMENT_AID = 'XXX';
    // $ROBOTPAYMENT_PT = 'XXX';
    // $ROBOTPAYMENT_IID = 'XXX';

    // --------------------------------
    // SPIRALフォームのURL
    // --------------------------------
    // Lab会員登録用URL
    $SPIRAL_REGIST_URL = 'https://reg34.smp.ne.jp/regist/is?SMPFORM=oeob-lglhld-dc062e19abc29399663a29df657fe296';
    // 法人プランのお問い合わせ用URL
    $SPIRAL_REGIST_TO_BE_URL = 'https://reg34.smp.ne.jp/regist/is?SMPFORM=oeob-lglirj-1d085a895ffc0906e802b387eff21ea9';
    // お問い合わせ用URL
    $SPIRAL_CONTACT_URL = 'https://reg34.smp.ne.jp/regist/is?SMPFORM=oeob-leocsh-04f7ee544bf875681c71c2287e6232bf';
    // パスワードをお忘れの方はこちら用URL
    $SPIRAL_REREGIST_PW_URL = 'https://reg34.smp.ne.jp/regist/is?SMPFORM=oeob-lglhrb-a9261f900952be7fcbff5181e20a9b36';
    // メルマガ登録用URL
    $SPIRAL_MAIL_MAGAZINE_URL = 'https://reg34.smp.ne.jp/regist/is?SMPFORM=oeob-lgmasc-1198593622ac5e9b1b435ae5bffceceb';
    // action_url
    $ACTION_URL = 'https://reg34.smp.ne.jp/regist/Reg2';
    

    // ------------------------------------------
    // SPIRALフォーム：リモートページのSMPFORM VALUE
    // ------------------------------------------
    // プロフィール変更フォーム
    $SMPFORM_VALUE_EDIT_PROFILE = 'oeob-lglhsf-4e02859ac1ce20d8945b5e21ec6b1de1';
    // メールアドレス変更依頼フォーム
    $SMPFORM_VALUE_EDIT_MAIL = 'oeob-lglhsh-0a50bdab815b513301205ac08f60d094';
    // パスワード変更フォーム
    $SMPFORM_VALUE_EDIT_PASSWORD = 'oeob-lglhth-d632de377c660680a4b9919adf466f39';
    // メール通知設定フォーム
    $SMPFORM_VALUE_SETTING_MAIL_MAGAZINE = 'oeob-lglhtj-bd3d7ce645b130ba345c69f2a862b20e';
    // 退会フォーム
    $SMPFORM_VALUE_WITHDRAWAL = 'oeob-lglikb-d1e9fb0bf6a11a830e58b385abc9e836';
    // // Lab会員登録フォーム
    // $SMPFORM_VALUE_REGIST_LAB_MEMBER = 'XXXX';

    // --------------------------------
    // SPIRALのAPIアクセス関連
    // --------------------------------
    // DB名
    // $DB_NAME = 'MemberInfoDB';
    $DB_NAME = 'LabMemberDB';
    // スパイラルの操作画面で発行したトークン
    $TOKEN = "00002GiblS7i63b6fda229a4d04e5747681e8742fd7e77717d7d";
    // スパイラルの操作画面で発行したシークレット
    $SECRET = "2a494cc90a31c015e015677370f8364bbec2bee1";    

    // --------------------------------
    // その他
    // --------------------------------
    // ホームのURL
    $HOME_URL = 'https://cultibase.jp/';
      
    $IS_PRODUCTION_MODE = true;
    break;

  //---- ステージング環境 ----//
  case "STAGING":
    // --------------------------------
    // 記事の公開期限(日数)
    // --------------------------------
    $ARTICLE_PUBLICATION_DEADLINE = 30;

    // --------------------------------
    // 決済関連（ロボットペイメント）
    // --------------------------------
    // $ROBOTPAYMENT_AID = '119962';
    // $ROBOTPAYMENT_PT = '1';
    // $ROBOTPAYMENT_IID = 'cultibase-test';
    
    // --------------------------------
    // SPIRALフォームのURL
    // --------------------------------
    // Lab会員登録用URL
    $SPIRAL_REGIST_URL = 'https://reg18.smp.ne.jp/regist/is?SMPFORM=pisc-lenhrc-52c227d1f2cceab299685db5702baf46';
    // 法人プランのお問い合わせ用URL
    $SPIRAL_REGIST_TO_BE_URL = '';
    // お問い合わせ用URL
    $SPIRAL_CONTACT_URL = 'https://reg18.smp.ne.jp/regist/is?SMPFORM=pisc-ldodrh-d71b258b41d103dbbd50212ab88f350a';
    // パスワードをお忘れの方はこちら用URL
    $SPIRAL_REREGIST_PW_URL = 'https://reg18.smp.ne.jp/regist/is?SMPFORM=pisc-ldodsd-06af550ef92f9ccd9d31c5dad1574c9b';
    // action_url
    $ACTION_URL = 'https://reg18.smp.ne.jp/regist/Reg2';

    // ------------------------------------------
    // SPIRALフォーム：リモートページのSMPFORM VALUE
    // ------------------------------------------
    // プロフィール変更フォーム
    $SMPFORM_VALUE_EDIT_PROFILE = 'pisc-leniog-2902c045ae1e9f3150091d31e18e9078';
    // メールアドレス変更依頼フォーム
    $SMPFORM_VALUE_EDIT_MAIL = 'pisc-lenhlj-4db28f2dee10f15500a32261890bce9c';
    // パスワード変更フォーム
    $SMPFORM_VALUE_EDIT_PASSWORD = 'pisc-lenipf-8a2b62da5820d71eacdffba0cfedb6ce';
    // メール通知設定フォーム
    $SMPFORM_VALUE_SETTING_MAIL_MAGAZINE = 'pisc-lenipg-9041f3480de9010f7c726cc5f6dde9f2';
    // 退会フォーム
    $SMPFORM_VALUE_WITHDRAWAL = 'pisc-leniqi-64b272f4f4e4a52c55f968dbb188a710';
    // // Lab会員登録フォーム
    // $SMPFORM_VALUE_REGIST_LAB_MEMBER = 'pisc-lekemh-f2fa4030b55d481d9e9a25b3f6139a3b';
    // メルマガ登録用URL
    $SPIRAL_MAIL_MAGAZINE_URL = '';

    // --------------------------------
    // SPIRALのAPIアクセス関連
    // --------------------------------
    // DB名
    $DB_NAME = 'LabMemberDB';
    // スパイラルの操作画面で発行したトークン
    $TOKEN = "00011KJ68S21496c96905ffb1907ef04e250464358f8204aebb1";
    // スパイラルの操作画面で発行したシークレット
    $SECRET = "0c7e64b6bc0cab6894a878f9e87ea7968c441519";
    // --------------------------------
    // その他
    // --------------------------------
    // ホームのURL
    $HOME_URL = 'https://staging.cultibase.jp/';
    break;
}
?>