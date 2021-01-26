<!-- サンプルコード -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
    <meta name="viewport" content="width=device-width, inital-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="stylesheet" href="userinfo.css">
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
         https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-firestore.js"></script>
<head>
    <title>ジモタル|お客様情報登録</title>
</head>
<body>

    <?php
    //$htmlを初期化
    $html = array();
    //戻りの場合
    if(isset($_POST['back'])){
        //htmlentities()でHTMLコードをエスケープします。
        $html['user_name'] = htmlentities($_SESSION['user_name'], ENT_QUOTES, 'UTF-8');
        $html['user_tel'] =  htmlentities($_SESSION['user_tel'], ENT_QUOTES, 'UTF-8');
        $html['address'] =   htmlentities($_SESSION['address'], ENT_QUOTES, 'UTF-8');
        $html['place'] =     htmlentities($_SESSION['place'], ENT_QUOTES, 'UTF-8');
        $html['user_memo'] = htmlentities($_SESSION['user_memo'], ENT_QUOTES, 'UTF-8');
    //初期値
    }else{
        //初期化
        $_SESSION = array();
        $html['user_name'] =  '';
        $html['user_tel'] =   '';
        $html['address'] =    '';
        $html['place'] =      '';
        $html['user_memo'] =  '';
    }
    ?>

    <div class="nyuuryoku">
        <h1>お客様情報登録</h1>
        <form action="userinfo_check.php" method="POST">
            
            <input type="hidden" name="userId" value="" id="userId">
            
            <!--    氏名入力欄-->
            <p><label for="user_name">お名前（必須）</label><br>
            <input type="text" name="user_name" value="<?php echo  $html['user_name']; ?>" id="user_name" required></p>
            
            <!--    電話番号入力欄-->
            <p><label for="user_tel">電話番号（必須）</label><br>
            <input type="text" name="user_tel" value="<?php echo  $html['user_tel']; ?>" id="user_tel" required></p>
            
            <!--    利用地域入力欄-->
            <p style="margin-top: 20px"><label for="address">ご利用エリア（必須）</label></p>    
            <p>
                <select name="address" value="<?php echo  $html['address']; ?>" id="address" required>
                    <option selected>エリアを選択</option>
                    <option value="北海道">北海道</option>
                    <option value="青森">青森</option>
                    <option value="岩手">岩手</option>
                    <option value="宮城">宮城</option>
                    <option value="秋田">秋田</option>
                    <option value="山形">山形</option>
                    <option value="福島">福島</option>
                    <option value="茨城">茨城</option>
                    <option value="栃木">栃木</option>
                    <option value="群馬">群馬</option>
                    <option value="埼玉">埼玉</option>
                    <option value="千葉">千葉</option>
                    <option value="東京都">東京都</option>
                    <option value="神奈川">神奈川</option>
                    <option value="新潟">新潟</option>
                    <option value="富山">富山</option>
                    <option value="石川">石川</option>
                    <option value="福井">福井</option>
                    <option value="山梨">山梨</option>
                    <option value="長野">長野</option>
                    <option value="岐阜">岐阜</option>
                    <option value="静岡">静岡</option>
                    <option value="愛知">愛知</option>
                    <option value="三重">三重</option>
                    <option value="滋賀">滋賀</option>
                    <option value="京都">京都</option>
                    <option value="大阪">大阪</option>
                    <option value="兵庫">兵庫</option>
                    <option value="奈良">奈良</option>
                    <option value="和歌山">和歌山</option>
                    <option value="鳥取">鳥取</option>
                    <option value="島根">島根</option>
                    <option value="岡山">岡山</option>
                    <option value="広島">広島</option>
                    <option value="山口">山口</option>
                    <option value="徳島">徳島</option>
                    <option value="香川">香川</option>
                    <option value="愛媛">愛媛</option>
                    <option value="高知">高知</option>
                    <option value="福岡">福岡</option>
                    <option value="佐賀">佐賀</option>
                    <option value="長崎">長崎</option>
                    <option value="熊本">熊本</option>
                    <option value="大分">大分</option>
                    <option value="宮崎">宮崎</option>
                    <option value="鹿児島">鹿児島</option>
                    <option value="沖縄">沖縄</option>
                </select>
            </p>
            <!--    手渡し場所希望記入欄-->
            <p><label for="place">受け渡し場所</label><br>
            <input type="text" name="place" value="<?php echo  $html['place']; ?>" id="place"></p>
            <!--    自己紹介入力欄-->
    　　　　　<p><label for="user_memo">自己紹介</label><br>
            <textarea type="text" name="user_memo" value="<?php echo  $html['user_memo']; ?>" id="user_memo"></textarea></p>
            <br>
        <div class="ss">
            <p><input class="btn" type="submit" name="for_check" value="　入力内容の確認　"></p>
            <br>
            <p><input class="btn2" type="reset" value="　リセット　" name="reset" onClick="Frest()"></p>     
        </div>
        </form>
            
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
                    document.getElementById('userId').value = uid;
                }else{
                    console.log('ログインしていません');
                };
            });
        }());
    </script> 
</body>
</html>