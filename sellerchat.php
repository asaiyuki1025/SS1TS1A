<?php
//変数の宣言
$sellerId = $_POST['sellerId'];
$sellerName = '';
$buyerId = $_POST['buyerId'];
$buyerName = '';
$itemId = $_POST['itemId'];
$itemName = '';
$roomId = $_POST['roomId'];
$itemAddres = '';
$imageName = '';
//sqlの接続
$db = new pdo("mysql:host=mysql149.phy.lolipop.lan;dbname=LAA1211401-db","LAA1211401","trident");
$sql = "SELECT user_name FROM user WHERE user_id = '$sellerId'";
$ps = $db->query($sql);
//出品者名取得
while ($row = $ps->fetch()){
  $sellerName = $row['user_name'];
}
$sql = "SELECT user_name FROM user WHERE user_id = '$buyerId'";
$ps = $db->query($sql);
//購入者名取得
while ($row = $ps->fetch()){
  $buyerName = $row['user_name'];
}
//商品名、取引地域、画像の名前取得
$sql = "SELECT item_name,item_addres,image_name FROM item WHERE item_id = '$itemId'";
$ps = $db->query($sql);
while ($row = $ps->fetch()){
  $itemName = $row['item_name'];
  $itemAddres = $row['item_addres'];
  $imageName = $row['image_name'];  
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, inital-scale=1">
    <link rel="stylesheet" href="buyerchat.css">
    <title><?php print $buyerName; ?>さんとのチャット</title>
    <style>
    #chatlog{ width:500px; height:300px; border:1px solid gray; overflow-y:scroll; }
    #uname{ width:80px; float:left; margin-right:10px; padding-top:5px; text-align:center}
    #userName{ width:80px; float:left; margin-right:10px; padding-top:5px; text-align:center}
    #msg{ width:330px; height:30px; margin-right:10px; font-size:12pt;}
    #sbmt{ width:100px; height:30px; }
    img {
            width: 20%;
            height: 20%;
        }
    </style>
</head>
<div class='nyuuryoku'>
<body>
    <h1><?php print $buyerName; ?>さんとのチャット</h1>
    <p>出品者名：<?php print $sellerName; ?></p>
    <p>商品名：<?php print $itemName; ?></p>
    <p>取引地域：<?php print $itemAddres; ?></p>
    <img class="cc" src="gz_img/<?php print $imageName; ?>" border="1">
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-firestore.js"></script>
    <input id="sellerUserId" name="sellerUserId" type="hidden" value="<?php echo $sellerId ?>"><br>
    <input id="userId" name="userId" type="hidden" value="<?php echo $buyerId ?>">
    <!-- 発言が表示される領域 -->
    <ul id="chatlog"></ul>

    <!-- 入力フォーム -->
    <!--    <input id="userName" name="userName" type="text" value="">-->
    <h1></h1>
    <p>取引相手：<?php print $buyerName; ?></p>
    <form id="form1">
        <div id="userName">
        <?php print $sellerName ?>
        </div>
        <input type="text" id="msg"><button type="button" id="sbmt">送信</button>
    </form>
    <br>
    <form action="index.html">
        <input type="submit" value="メイン画面へ">
    </form>
</body>
</div>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-app.js"></script>

    <!-- TODO: Add SDKs for Firebase products that you want to use
    https://firebase.google.com/docs/web/setup#available-libraries -->
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.24.0/firebase-firestore.js"></script>
    <script src="chat.js"></script>

</html>