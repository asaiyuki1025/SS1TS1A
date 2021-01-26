<!DOCTYPE html>
<?php
$userId = $_POST['userId'];
//$item_image=$_POST['item_image'];
$item_name = $_POST['item_name'];
$item_desc = $_POST['item_desc'];
$item_price = $_POST['item_price'];
$user_addres = $_POST['user_addres'];
$rent_day_up = $_POST['rent_day_up'];
$rent_day_down = $_POST['rent_day_down'];
$image_name= $_POST['image_name'];
$category=$_POST['category'];
$db = new pdo("mysql:host=mysql149.phy.lolipop.lan;dbname=LAA1211401-db","LAA1211401","trident");


$vd = (isset($_COOKIE["userid"])) ? $_COOKIE["user_id"]:"";
$sql = "INSERT INTO  item VALUES('0000','$userId','$item_name','$item_desc','$category','$user_addres','$item_price','$rent_day_up','$rent_day_down','4','$image_name')";
$ps = $db->query($sql);
?>
<head>
    <meta charset="UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, inital-scale=1">
    <link rel="stylesheet" href="listing_finish.css">
   </head>
 <body>
     <div class="zz">
        <h1>出品完了</h1>
        
        <div class="a"><p><?php echo $item_name?>の情報を登録しました</p></div>
        
        <form action="index.html" method="POST">
        <input class="btn1" type="submit" name="for_check" value="　メイン画面に戻る　">
        </form>
        <br>
        <form action="mypage.php" method="POST">
        <input class="btn2" type="submit" name="for_check" value="　マイページへ移る　">
        </form>
         </div>
    </body>
