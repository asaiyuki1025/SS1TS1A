<?php
session_start();
$name = $_GET['name'];
//データベースに接続
$db = new pdo("mysql:host=mysql149.phy.lolipop.lan;dbname=LAA1211401-db","LAA1211401","trident");
$sql = "SELECT * FROM item WHERE category_id = '$name'";
//sql実行
$ps = $db->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, inital-scale=1">
	<link rel="stylesheet" href="product.css">
    <title>『<?php echo $name; ?>』カテゴリのページ</title>
    </head>
    <style>
    .item{
       font-size: 30px;
       margin-bottom: 30px;
    }
    img {
        width: 80%;
        height: 80%;
max-width:300px;
max-height:300px;
    }
    .vertical-list {
      overflow: auto;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }
	.scrolling-wrapper {
  	overflow: auto;
  	overflow: auto;
  	white-space: nowrap;
	}
	.scrolling-wrapper .item {
  	display: inline-block;
	}
    button:hover,input[type="submit"]:hover {
        /* 背景色を明るい青色に指定 */
        background-color: #24d;

        /* 文字色を白色に指定 */
        color: #fff;
    }  
        input[type="submit"]{
            /* 文字サイズを1.4emに指定 */
        font-size: 23px;

        /* 文字の太さをboldに指定 */
        font-weight: bold;

        /* 縦方向に10px、
        * 横方向に30pxの余白を指定 */
        padding: 8px 20px;

        /* 背景色を濃い青色に指定 */
        background-color: #248;

        /* 文字色を白色に指定 */
        color: #fff;

        /* ボーダーをなくす */
       border-style: none;
    
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
    
        text-align: center;
        
        }
    }
    </style>
</html>
<body>
<div class='nyuuryoku'>
    <h1><span id="name"></span>カテゴリのページ</h1><br><br>
    <ul class="scrolling-wrapper">
    <?php
        //カテゴリーで検索した商品の一覧を表示する
        while ($row = $ps->fetch()){
        print "<li class=\"item\"><div class='item'>
        <a href=\"productinfo.php?item_id={$row['item_id']}\"><img class=\"cc\"src=\"gz_img/{$row['image_name']}\" border=\"1\"><br>商品名：{$row['item_name']}<br>
        取引地域：{$row['item_addres']}<br>
        レンタル代：{$row['item_price']}円/1泊<br></a></div></li><br>";        
        }
    ?>
<br>
    <ul>
    <script>
        var school=document.querySelector('#name');
        school.innerHTML='『<?php echo $name; ?>』';
    </script>
</div>
</body>