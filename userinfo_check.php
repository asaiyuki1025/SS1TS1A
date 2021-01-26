<?php
//セッション開始
session_start();
//変数初期化
$html =      array();
$cln =       array();
$_SESSION =  array();
$strError =  '';

$userId = $_POST['userId'];

//確認ボタンが押されていれば


if(isset($_POST['for_check'])){
 //POSTデータをSESSIONに格納
    
    if(isset($_POST['userId']) && $_POST['userId'] != '')
    $_SESSION['userId'] = $_POST['userId'];
    else
    $_SESSION['userId'] = '';    
    
    if(isset($_POST['user_name']) && $_POST['user_name'] != '')
    $_SESSION['user_name'] = $_POST['user_name'];
    else
    $_SESSION['user_name'] = '';
 
    if(isset($_POST['user_tel']) && $_POST['user_tel'] != '')
    $_SESSION['user_tel'] = $_POST['user_tel'];
    else
    $_SESSION['user_tel'] = '';
 
    if(isset($_POST['address']) && $_POST['address'] != '')
    $_SESSION['address'] = $_POST['address'];
    else
    $_SESSION['addresss'] = '';
 
    if(isset($_POST['place']) && $_POST['place'] != '')
    $_SESSION['place'] = $_POST['place'];
    else
    $_SESSION['place'] = '';
 
    if(isset($_POST['user_memo']) && $_POST['user_memo'] != '')
    $_SESSION['user_memo'] = $_POST['user_memo'];
    else
    $_SESSION['user_memo'] = '';
    
    
        //名前 フィルタリング 30文字以内
    if(isset($_SESSION['user_name']) && $_SESSION['user_name'] != ''){
        $cln['user_name'] = $_SESSION['user_name'];
        //マルチバイト文字列を含めた文字数
        if(mb_strlen($cln['user_name']) <= 30){
            //htmlentities()でHTMLコードをエスケープします。
            $html['user_name'] = htmlentities($cln['user_name'], ENT_QUOTES, 'UTF-8');
        }else{
            $strError .= "名前を30文字以内にして下さい。<br/>\n";
            $html['user_name'] = '';
        }
    }else{
        $html['user_name'] = '';
    }//end
 
    
    if(isset($_SESSION['user_tel']) && $_SESSION['user_tel'] != ''){
        $cln['user_tel'] = $_SESSION['user_tel'];
    }else{
        $html['user_tel'] = '';
    }//end
 
    
    if(isset($_SESSION['address']) && $_SESSION['address'] != ''){
        $cln['address'] = $_SESSION['address'];
    }else{
        $html['address'] = '';
    }//end
 
    
    if(isset($_SESSION['place']) && $_SESSION['place'] != ''){
        $cln['place'] = $_SESSION['place'];
    }else{
        $html['place'] = '';
    }//end
    
    if(isset($_SESSION['userId']) && $_SESSION['userId'] != ''){
        $cln['userId'] = $_SESSION['userId'];
    }else{
        $html['userId'] = '';
    }//end
 
    // 300文字以内
    if(isset($_SESSION['user_memo']) && $_SESSION['user_memo'] != ''){
        $cln['user_memo'] = $_SESSION['user_memo'];
        //マルチバイト文字列を含めた文字数
        if(mb_strlen($cln['user_memo']) <= 300){
            //htmlentities()でHTMLコードをエスケープします。
            $html['user_memo'] = htmlentities($cln['user_memo'], ENT_QUOTES, 'UTF-8');
        }else{
            $strError .= "お問合せ内容を300文字以内にして下さい。<br/>\n";
            $html['user_memo'] = '';
        }
    }else{
        $html['user_memo'] = '';
    }//end
 
    //フィルタリングでエラーがあれば
    if($strError != ''){
        echo $strError."<br/>\n";
        ?>
 
        <form action="userinfo" method="POST">
        <input type="submit" name="back" value="-　戻る　-">
        </form>
 
        <hr/>
        <?php
        exit;
    }
 
//確認ボタンが押されていなければ
}else{
    ?>
    <?php
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="stylesheet" href="userinfo_check.css">
        <title>ジモタル｜入力情報確認</title>
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-app.js"></script>

        <!-- TODO: Add SDKs for Firebase products that you want to use
             https://firebase.google.com/docs/web/setup#available-libraries -->
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-analytics.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-auth.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-firestore.js"></script>
        
    </head>
<style>
.ee{
text-align: center;
</style>
    <body>
        <div class="table">
            <table class="check" border="1">
                <caption>入力情報確認画面</caption>
                
                <tr>
                    <th>お名前</th>
                    <td><?php echo $html['user_name']; ?></td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td><?php echo $cln['user_tel']; ?></td>
                </tr>
                <tr>
                    <th>ご利用エリア</th>
                    <td><?php echo $cln['address']; ?></td>
                </tr>
                <tr>
                    <th>受け渡し場所</th>
                    <td><?php echo $cln['place']; ?></td>
                </tr>
                <tr>
                    <th>自己紹介</th>
                    <td><?php echo $html['user_memo']; ?></td>
                </tr>
        </table>
        <div class="ee">
                <form action="userinfo.php">
                    <button class="btn" type="submit" name="back">入力内容修正</button>
                </form>
            <br>
                <form action="userinfo_done.php">
                    <button class="btn" type="submit" name="for_comp">送信</button>
                </form>
    </div>
    </div>

        <script>
            (function(){
            // Your web app's Firebase configuration
            // For Firebase JS SDK v7.20.0 and later, measurementId is optional
            var firebaseConfig = {
            apiKey: "AIzaSyDHJpC0mj3Vi9h3fQKbmFg1q9uEXNfnthU",
            authDomain: "developmentauth.firebaseapp.com",
            databaseURL: "https://developmentauth.firebaseio.com",
            projectId: "developmentauth",
            storageBucket: "developmentauth.appspot.com",
            messagingSenderId: "785254904382",
            appId: "1:785254904382:web:168ced64673e38e41d576f",
            measurementId: "G-RWFY3RCM39"
            };
            // Initialize Firebase
            firebase.initializeApp(firebaseConfig);
            firebase.analytics();

            firebase.auth().onAuthStateChanged(firbaseUser => {
                if(firbaseUser){
                    //console.log(firbaseUser);
                    var user = firebase.auth().currentUser;
                    var uid, email;
                    uid = user.uid;
                    email = user.email;
                    console.log(email + 'でログインしています');
                    console.log('UID：' + uid);
                    //document.getElementById('userId').value = uid;
                }else{
                    console.log('ログインしていません');
                };
            });
        }());
        </script>
    </body>
</html>