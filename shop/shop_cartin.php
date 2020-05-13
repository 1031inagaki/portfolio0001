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
	print '<h2>ようこそゲスト様　</h2>';
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

if(isset($_SESSION['cart'])==true)
{
	$cart=$_SESSION['cart'];
	$kazu=$_SESSION['kazu'];
	if(in_array($pro_code,$cart)==true)
	{
		print '※その商品はすでにカートに入っています。<br /><br />';
		print '<h3><a href="shop_list.php" style="color:#000">商品一覧に戻る</a></h3>';
		print'<h3><a href="shop_cartlook.php" style="color:#000">カートを見る</a></h3><br />';
		exit();
	}
}
$cart[]=$pro_code;
$kazu[]=1;
$_SESSION['cart']=$cart;
$_SESSION['kazu']=$kazu;

}
catch(Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>

カートに追加しました。<br />
<br />
<h3><a href="shop_list.php" style="color:#000">商品一覧に戻る</a></h3>
<h3><a href="shop_cartlook.php" style="color:#000">カートを見る</a></h3><br />

</div>
<footer>
		<div class="wrapper">
				<p><small>&copy; 2020 portfolio </small></p>
		</div>
</footer>
</body>

</html>
