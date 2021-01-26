<?php
//変数の宣言
$userId = $_POST['userId'];
$itemId = '';
//データベースに接続
$db = new pdo("mysql:host=mysql149.phy.lolipop.lan;dbname=LAA1211401-db","LAA1211401","trident");
$sql = "SELECT * FROM user WHERE user_id = '$userId'";
//sql実行
$ps = $db->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="mypage.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, inital-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>マイページ</title>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
         https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-firestore.js"></script>
</head>
<body>
<div class='mypage'>
    <h1>ユーザー情報</h1>    
  <div class="gg"> 
   <?php
        //ユーザ情報を取得して表示
        while ($row = $ps->fetch()){
        print "ユーザー名：{$row['user_name']}<br>電話番号：{$row['user_tel']}<br>住所：{$row['address']}<br>受け渡し場所：{$row['place']}<br>自己紹介：{$row['user_memo']}<br><p/>";
        }   
    ?>
 </div>
<br>
<br>
<br>
    <div class="ww">
    <p><button id="btnLogout" class="btn btn-action hide">
    ログアウト
    </button></p>
        </div>
    <p id="text" class="warning"></p>
    <p>現在出品している商品のチャット一覧</p>
    <div class="gg">
        <?php
        //データベースに接続
        $db = new pdo("mysql:host=mysql149.phy.lolipop.lan;dbname=LAA1211401-db","LAA1211401","trident");
        $sql = "SELECT * FROM chatroom WHERE seller_id = '$userId'";
        //sql実行
        $ps = $db->query($sql);
        while ($row = $ps->fetch()){
            $rand_str = chr(mt_rand(65,90)) . chr(mt_rand(65,90)) . chr(mt_rand(65,90)) .
                chr(mt_rand(65,90)) . chr(mt_rand(65,90)) . chr(mt_rand(65,90));
            //現在出品している商品のチャット一覧を表示
            print "<form method=\"POST\" name=\"$rand_str\" action=\"sellerchat.php\">
                    <input type=\"hidden\" name=\"sellerId\" value=\"{$row['seller_id']}\">
                    <input type=\"hidden\" name=\"buyerId\" value=\"{$row['buyer_id']}\">
                    <input type=\"hidden\" name=\"itemId\" value=\"{$row['item_id']}\">
                    <input type=\"hidden\" name=\"roomId\" value=\"{$row['chatroom_id']}\">
                    <a href=\"#\" onclick=\"document.$rand_str.submit();\">
                    商品名：{$row['item_name']}<br>購入者名：{$row['buyer_name']}<br>
                    </a>
                </form><br>";
        }
        ?>
    </div>
    <p>現在購入取引をしているチャット一覧</p>
    <div class="gg">
        <?php
        //データベースに接続
        $db = new pdo("mysql:host=mysql149.phy.lolipop.lan;dbname=LAA1211401-db","LAA1211401","trident");
        $sql = "SELECT * FROM chatroom WHERE buyer_id = '$userId'";
        //sql実行
        $ps = $db->query($sql);
        while ($row = $ps->fetch()){
            $rand_str = chr(mt_rand(65,90)) . chr(mt_rand(65,90)) . chr(mt_rand(65,90)) .
                chr(mt_rand(65,90)) . chr(mt_rand(65,90)) . chr(mt_rand(65,90));
            //現在購入取引をしているチャット一覧
            print "<form method=\"POST\" name=\"$rand_str\" action=\"buyerchat.php\">
                    <input type=\"hidden\" name=\"sellerId\" value=\"{$row['seller_id']}\">
                    <input type=\"hidden\" name=\"buyerId\" value=\"{$row['buyer_id']}\">
                    <input type=\"hidden\" name=\"itemId\" value=\"{$row['item_id']}\">
                    <a href=\"#\" onclick=\"document.$rand_str.submit()\">
                    商品名：{$row['item_name']}<br>出品者名：{$row['seller_name']}<br>
                    </a>
                </form><br>";
        }
        ?>
    </div>
    <br>

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

        const btnLogout = document.getElementById('btnLogout');

        btnLogout.addEventListener('click', e=>{
           firebase.auth().signOut(); 
          document.getElementById('text').textContent = "ログアウトが完了しました。"
        });

        firebase.auth().onAuthStateChanged(firbaseUser => {
            if(firbaseUser){
                //console.log(firbaseUser);
                var user = firebase.auth().currentUser;
                var uid, email;
                uid = user.uid;
                email = user.email;
                console.log(email + 'でログインしています');
                console.log('UID：' + uid);
                //btnLogout.classList.remove('hide');
            }else{
                console.log('ログインしていません');
                //btnLogout.classList.add('hide');
            };
        });
    }());
    </script>  
</body>
</html>