<!DCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>StayHomeCafe - ORDER</title>
<meta name="description" content="ブレンドコーヒーとオーガニックフードご自宅に提供するカフェ"＞
<link rel="stylesheet" href="https://unpkg.com./ress/dist/ress.min.css">
<link rel="stylesheet" href="css/style.css">
<link href="https://fonts.googleapis.com/css?family=Love+Ya+Like+A+Sister&display=swap" rel="stylesheet">


</head>
<body>
	<div id="order" class="big-bg">
			<header class="page-header wrapper">
					<nav>
							<ul class="main-nav">
								<li><a href="index.html">home</a></li>
								<li><a href="news.html">News</a></li>
								<li><a href="menu.html">Menu</a></li>
								<li><a href="shop_list.php">Order</a></li>
							</ul>
					</nav>
			</header>
			<div class="wrapper">
					<h2 class="page-title">Order</h2>
			</div><!-- /.wrapper -->
	</div><!-- /#order -->

<div class="wrapper">
	<?php
	session_start();
	session_regenerate_id(true);
	if(isset($_SESSION['member_login'])==false)
	{
		print '<h2>ようこそゲスト様</h2>';
		print '<a href="member_login.html">会員ログイン</a><br />';
		print '<br />';
	}
	else
	{
		print '<h2>ようこそ</h2>';
		print $_SESSION['member_name'];
		print '様　';
		print '<a href="member_logout.php">ログアウト</a><br />';
		print '<br />';
	}
	?>
</div>
  <div class="preorder">


<?php

try
{

$pro_code=$_GET['procode'];

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT name,price,gazou FROM mst_product WHERE code=?';
$stmt=$dbh->prepare($sql);
$data[]=$pro_code;
$stmt->execute($data);

$rec=$stmt->fetch(PDO::FETCH_ASSOC);
$pro_name=$rec['name'];
$pro_price=$rec['price'];
$pro_gazou_name=$rec['gazou'];

$dbh=null;

if($pro_gazou_name=='')
{
	$disp_gazou='';
}
else
{
	$disp_gazou='<img src="../product/gazou/'.$pro_gazou_name.'">';
}
print '<h3><a href="shop_cartin.php?procode='.$pro_code.'" style="color:#800000">カートに入れる</a></h3><br />';

}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

商品情報参照<br />
<br />
商品コード:
<?php print $pro_code; ?>
<br />
商品名:
<?php print $pro_name; ?>
<br />
価格:
<?php print $pro_price; ?>円
<br /><br />
<?php print $disp_gazou; ?>
<br />
<br />
<form>
<input type="button" class="button" onclick="history.back()" value="戻る">
</form>


</div>
<footer>
		<div class="wrapper">
				<p><small>&copy; 2020 portfolio </small></p>
		</div>
</footer>
</body>
</html>
