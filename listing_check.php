<!DOCTYPE html>
<?php
$item_name = $_POST['item_name'];
$item_desc = $_POST['item_desc'];
$item_price = $_POST['item_price'];
$user_addres = $_POST['user_addres'];
$rent_day_up = $_POST['rent_day_up'];
$rent_day_down = $_POST['rent_day_down'];
$file=$_FILES['item_image'];
$item_image = $_FILES['item_image'];
$category=$_POST['category'];
?>
<html lang="ja">
<head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, inital-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="stylesheet" href="listing.css">
<style>
@media screen and (max-width: 480px) {
    @charset "utf-8";

    .pp{
        width: 170px;
        font-size: 28px;
         padding: 15px;
    font-family: 'M+ Type-1 (general-j) Regular';
    }
</style>
    <body>
        <div class="nyuuryoku">
        <h1>商品の情報の確認</h1>
       <form method="post" action="listing_finish.php">
           <p>商品の写真</p>
          <?php
           require_once 'functions.php';
           $pdo=connectDB();
           if (!empty($_FILES['image']['name'])) {
        $name = $_FILES['image']['name'];
        $type = $_FILES['image']['type'];
        $content = file_get_contents($_FILES['image']['tmp_name']);
        $size = $_FILES['image']['size'];

        $sql = 'INSERT INTO image(item_id,image_name,image_type, image_content, image_size, created_at)
                VALUES (1,:image_name, :image_type, :image_content, :image_size, now())';
        $stmt = $pdo->prepare($sql);
               $stmt->bindValue(':image_type', $name, PDO::PARAM_STR);
        $stmt->bindValue(':image_type', $type, PDO::PARAM_STR);
        $stmt->bindValue(':image_content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':image_size', $size, PDO::PARAM_INT);
        $stmt->execute();
    }
    unset($pdo);
           
           if( $file['size']>0 ){
               
            
            //アップロードされた画像ファイルを移動
            $ima = date('YmdHis');
            $fn = $ima . $file['name'];
            move_uploaded_file($file['tmp_name'], './gz_img/'.$fn);


            //サムネイルの作成
            $motogazo = imagecreatefromjpeg("./gz_img/$fn");
            list($w, $h) = getimagesize("./gz_img/$fn");
            $new_h = 200;
            $new_w = $w * 200 / $h;
            $mythumb = imagecreatetruecolor($new_w, $new_h);
            imagecopyresized($mythumb, $motogazo, 0, 0, 0, 0,$new_w,$new_h,$w,$h);
            imagejpeg($mythumb, "./gz_img/thumb_$fn");

            //サムネイルの表示
            print "<P><IMG SRC='./gz_img/thumb_$fn'></P>";     
    }
else{
print "ほかの画像を使ってね";
}
?>
           <input type="hidden" name="image_name" value="<?php echo $fn ?>">
           <input type="hidden" name="image_size" value="<?php echo $file['size']?>">
           <input name="item_image" type="hidden" value="<?php echo $fn ?>" readonly>
           <p>商品名<br/>
               <input type="text" name="item_name" class="aa"  value="<?php echo $item_name ?>" readonly   >
           </p>
           <p>商品説明<br/>
           <textarea name="item_desc" cols="40" rows="7" class="aa" readonly ><?php echo $item_desc ?></textarea>
           </p>
           <p>カテゴリー<br/>
               <input type="text" name="category" class="aa" value="<?php echo $category ?>" readonly>
           </p>
           <p>レンタル代<br/>
            <input type="text" name="item_price" class="pp" value="<?php echo $item_price?>" readonly>   円/1日
           </p>
           <br>
           <p>地域<br/>
           <input type="text" name="user_addres" class="aa" value="<?php echo $user_addres?>" readonly >
           </p>
           <p>レンタル日数<br/>
               <input type="text" name="rent_day_up" class="pp" value="<?php echo $rent_day_up?>"    readonly >日
           ～
               <input type="text" name="rent_day_down" class="pp" value="<?php echo $rent_day_down?>" readonly >日
           </p>
           <br>
           <br>
           <div class="cc">
               <input id="userId" name="userId" type="hidden" value="">
           <input class="btn" type="submit" value="商品登録"></div>
        </form>
            <br>
       <div class="cc"> <form action="listing.php">
            <input class="btn" type="submit" value="商品情報修正">
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
            </div>
    </body>
</head>
</html>