<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>ジモタル｜レンタル商品情報</title>
    <style>  
    </style>
    <title>テンプレート</title>
    <link href="../../_common/images/favicon.ico" rel="shortcut icon">
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+1p:400,500" rel="stylesheet">
    <link href="productinfo.css" rel="stylesheet">
</head>
<body>
<div class="zz">
    <section>
    <h1>レンタル商品情報</h1>
    <?php
    $item_id = $_GET['item_id'];
    //データベースに接続
    $db = new pdo("mysql:host=mysql149.phy.lolipop.lan;dbname=LAA1211401-db","LAA1211401","trident");
    $sql = "SELECT * FROM item WHERE item_id = $item_id";
    //sql実行
    $ps = $db->query($sql);
    //画像の名前を取得
    $row = $ps->fetch();
    $image=$row['image_name'];
    ?>
                            
    <img src="./gz_img/thumb_<?php echo $image?>" id="bigimg">
  
    <p>
    <?php 
    //データベースに接続
    $db = new pdo("mysql:host=mysql149.phy.lolipop.lan;dbname=LAA1211401-db","LAA1211401","trident");
    $sql = "SELECT * FROM item WHERE item_id = $item_id";
    //sql実行     
    $ps = $db->query($sql);
    //商品名レンタル商品の取得と表示     
    while ($row = $ps->fetch()){
    print "商品名：{$row['item_name']}<BR>";	
    print "レンタル代：{$row['item_price']}円/1泊<BR><BR>";
    print "<input id=\"sellerId\" name=\"sellerId\" type=\"hidden\" value=\"{$row['user_id']}\">";
    }  
    $sql = "SELECT * FROM item WHERE item_id = $item_id"; 
    //sql実行    
    $ps = $db->query($sql);
    //商品説明の取得と表示
    while ($row = $ps->fetch()){
    print "商品説明<br>{$row['item_desc']}<BR>";
    }
    ?>
    </p>
                        
    <table class="check" border="1">
    <tr>
    <th>レンタル期間</th>
    <td>
    <?php 
    //user_telをuser_idに変更し、「=」の後にuser_idが入るようにする。
    $sql = "SELECT * FROM item WHERE item_id = $item_id";
    //sql実行
    $ps = $db->query($sql);
    //貸出期限の取得と表示
    while ($row = $ps->fetch()){
    print "{$row['rent_day_up']}～{$row['rent_day_down']}日";
    }
    ?>
    </td>
    </tr>
    <tr>
    <th>取引地域</th>
    <td>
    <?php 
    //user_telをuser_idに変更し、「=」の後にuser_idが入るようにする。
    $sql = "SELECT * FROM item WHERE item_id = $item_id";
    //sql実行
    $ps = $db->query($sql);
    //レンタル可能地域の取得と表示
    while ($row = $ps->fetch()){
    print "{$row['item_addres']}<BR>";
    }
    ?>
    </td>
    </tr>                          
    </table><br>        
    <form action="buyerchat.php" method="post">
        <?php
        $sql = "SELECT * FROM item WHERE item_id = $item_id";
        //sql実行
        $ps = $db->query($sql);
        //出品者のユーザIDと出品商品番号を取得し、サイトに表示（hiddenで表示してないけど）
        while ($row = $ps->fetch()){
        print "<input id=\"sellerId\" name=\"sellerId\" type=\"hidden\" value=\"{$row['user_id']}\">";
        print "<input id=\"itemId\" name=\"itemId\" type=\"hidden\" value=\"{$row['item_id']}\">";
        }
        ?>
        <br>
        <input id="buyerId" name="buyerId" type="hidden" value="">
        <div class="ee"><input type="submit" value="チャット画面へ"></div>
    </form>
    </section>
    <!-- /.container -->
        
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
         https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-firestore.js"></script>
    <script>
        'use strict';

        const thumbs = document.querySelectorAll('.thumb');
        thumbs.forEach(function(item, index) {
            item.onclick = function(){
                document.getElementById('bigimg').src = this.dataset.image;
            }
        });
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
                    var user = firebase.auth().currentUser;
                    var uid, email;
                    uid = user.uid;
                    email = user.email;
                    console.log(email + 'でログインしています');
                    console.log('UID：' + uid);
                    //htmlファイルにuserIdを入れている
                    document.getElementById('buyerId').value = uid;
                }else{
                    console.log('ログインしていません');
                };
            });
        }());
        </script>
        </div>
    </body>
</html>