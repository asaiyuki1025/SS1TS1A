<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>商品出品画面</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, inital-scale=1">
    <link rel="stylesheet" href="listing.css">
</head>
<body>
    <div class="nyuuryoku">
    <form method="post" action="listing_check.php" enctype = 'multipart/form-data'>
        <h1>商品の情報を入力</h1>
        <?php if (isset($_POST['upload'])): ?>
        <p><?php echo $message; ?></p>
        <?php else: ?>
        <p> 写真を追加<br>
            <?php
            $vd = (isset($_COOKIE["image"])) ? $_COOKIE["image"]:"";
            print "<input type='file' class='vv' name='item_image' accept='.jpg,.jpeg' value='$vd' required>"?>
            </p>
        <br>
        <p>商品名と説明<br>
            <?php
            $vd = (isset($_COOKIE["item_name"])) ? $_COOKIE["item_name"]:"";
            print "
            <INPUT TYPE='text' NAME='item_name'class='aa' PLACEHOLDER='商品名を入力' VALUE='$vd' required>"?>
        </p>
        <p><?php
                $vd = (isset($_COOKIE["item_desc"])) ? $_COOKIE["item_desc"]:"";
            print "
            <TEXTAREA NAME='item_desc'cols='40' rows='7' class='aa' PLACEHOLDER='商品の情報を入力してください' required>$vd</textarea>"?>

        </p>
        <p>カテゴリー</p>
        <p> 
            <select name="category">
               <option value="メンズ">メンズ</option>
               <option value="レディース">レディース</option>
               <option value="子供用品">子供用品</option>
               <option value="カメラ">カメラ</option>
               <option value="PC・家電">PC・家電</option>
               <option value="アウトドア">アウトドア</option>
               <option value="ホビー">ホビー</option>
               <option value="その他">その他</option>
            </select>
       　</p>
　　　　  <p>レンタル代<br>
            <?php
            $vd = (isset($_COOKIE["item_price"])) ? $_COOKIE["item_price"]:"";
            print "
            <input name='item_price' class='bb' type='text' placeholder='(例)100' size='4' value='$vd' required>" ?> 円/1泊</p>
        <br>
        <p>取引地域<br/>
            <?php
            $vd = (isset($_COOKIE["user_addres"])) ? $_COOKIE["user_addres"]:"";
            print "
            <input name='user_addres' type='text' class='aa' placeholder='市まで入力してください' value='$vd' required>"?>
        </p>
        <p>貸し出し日数<br/>
            <?php
            $vd = (isset($_COOKIE["rent_day_up"])) ? $_COOKIE["rent_day_up"]:"";
            print "
            <input name='rent_day_up' type='text' size='4' class='bb' placeholder='(例)7' value='$vd' required>"?>
            日～
            <?php
            $vd = (isset($_COOKIE["rent_day_down"])) ? $_COOKIE["rent_day_down"]:"";
            print "
            <input name='rent_day_down' type='text' size='4'  class='bb' placeholder='(例)30' value='$vd' required>"?>
            日
        </p>
        <br>
        <br>
        <div class="cc">
        <input id="userId" name="userId" type="hidden" value="">
        <input type="submit" value="出品確認画面へ" name="upload">
        <?php endif;?></div>
    </form>
    </div>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
         https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-firestore.js"></script>
    <script src="index.js"></script>
</body>
</html>