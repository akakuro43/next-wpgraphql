<?php
    // TODO 使用箇所把握
    include 'session.php';

    $email = getSessionEmail();

    if(isset($_GET['mailMagazineFlg'])) {
        $mailMagazineFlg = $_GET['mailMagazineFlg'];
        $result = updateMailMagazineFlg($email, $mailMagazineFlg);

        if($result == 1) {
            setSessionMailMagazineFlg($mailMagazineFlg);
        }
    }
?>
