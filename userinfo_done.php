<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, inital-scale=1">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="stylesheet" href="userinfo_done.css".css>
        <title>ジモタル｜お客様情報登録</title>
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-app.js"></script>

        <!-- TODO: Add SDKs for Firebase products that you want to use
             https://firebase.google.com/docs/web/setup#available-libraries -->
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-analytics.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-auth.js"></script>
        <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-firestore.js"></script>
    </head>
<style>
.btn {

    /* 文字サイズを1.4emに指定 */
    font-size: 16px;

    /* 文字の太さをboldに指定 */
    font-weight: bold;

    /* 縦方向に10px、
     * 横方向に30pxの余白を指定 */
    padding: 8px 25px;

    /* 背景色を濃い青色に指定 */
    background-color: #248;

    /* 文字色を白色に指定 */
    color: #fff;

    /* ボーダーをなくす */
    border-style: none;
    
    /* 角丸の指定 */
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
}

.btn:hover {
    /* 背景色を明るい青色に指定 */
    background-color: #24d;

    /* 文字色を白色に指定 */
    color: #fff;
}

.button-area{
    text-align: center;
}
div{
    text-align: center;
}


@media screen and (max-width: 480px) {
@charset "utf-8";
body{
    background-color: #1e90ff;
}
h1{
    font-size: 100px;
    text-align: center;
    color: aliceblue;
}

.btn {
    /* 文字サイズを1.4emに指定 */
    font-size: 50px;

    /* 文字の太さをboldに指定 */
    font-weight: bold;

    /* 縦方向に10px、
     * 横方向に30pxの余白を指定 */
    padding: 8px 25px;

    /* 背景色を濃い青色に指定 */
    background-color: #248;

    /* 文字色を白色に指定 */
    color: #fff;

    /* ボーダーをなくす */
    border-style: none;
    
    /* 角丸の指定 */
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
}
@media screen and (max-width: 480px) {
@charset "utf-8";
.btn {
      
    /* 文字サイズを1.4emに指定 */
    font-size: 25px;

    /* 文字の太さをboldに指定 */
    font-weight: bold;

    /* 縦方向に10px、
     * 横方向に30pxの余白を指定 */
    padding: 8px 10px;

    /* 背景色を濃い青色に指定 */
    background-color: #248;

    /* 文字色を白色に指定 */
    color: #fff;

    /* ボーダーをなくす */
    border-style: none;
    
    /* 角丸の指定 */
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    border-radius: 5px;
}

.btn:hover {
    /* 背景色を明るい青色に指定 */
    background-color: #24d;

    /* 文字色を白色に指定 */
    color: #fff;
}

body{
    background-color: #1e90ff;
}
h1{
    font-size: 40px;
    text-align: center;
    color: aliceblue;
}



div{
    text-align: center;
}

}
</style>
    <body>
        
        <h1>登録が<br>完了しました！！</h1>
            <div>
                <form action="index.html" method="POST">
                    <input class="btn" type="submit" value="メイン画面に戻る">
                </form>
            </div>        
        <?php
        
        $db = new pdo("mysql:host=mysql149.phy.lolipop.lan;dbname=LAA1211401-db","LAA1211401","trident");
//        print "接続成功<BR>";
        $userId = $_SESSION['userId'];
        $user_name = $_SESSION['user_name'];
        $user_tel = $_SESSION['user_tel'];
        $address = $_SESSION['address'];
        $place = $_SESSION['place'];
        $user_memo = $_SESSION['user_memo'];
        
        $sql = "INSERT INTO user VALUES('$userId','$user_name','$user_tel','$address','$place','$user_memo')";
        $ps = $db->query($sql);
        
//        mysql_close($d) or die("切断失敗");
//        print "切断成功";
        
        
        ?>
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