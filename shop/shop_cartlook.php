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

if(isset($_SESSION['cart'])==true)
{
	$cart=$_SESSION['cart'];
	$kazu=$_SESSION['kazu'];
	$max=count($cart);
}
else
{
	$max=0;
}

if($max==0)
{
	print '※カートに商品が入っていません。<br />';
	print '<br />';
	print '<h3><a href="shop_list.php" style="color:#000">商品一覧へ戻る</a><h3>';
	exit();
}

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

foreach($cart as $key=>$val)
{
	$sql='SELECT code,name,price,gazou FROM mst_product WHERE code=?';
	$stmt=$dbh->prepare($sql);
	$data[0]=$val;
	$stmt->execute($data);

	$rec=$stmt->fetch(PDO::FETCH_ASSOC);

	$pro_name[]=$rec['name'];
	$pro_price[]=$rec['price'];
	if($rec['gazou']=='')
	{
		$pro_gazou[]='';
	}
	else
	{
		$pro_gazou[]='<img src="../product/gazou/'.$rec['gazou'].'">';
	}
}
$dbh=null;

}
catch(Exception $e)
{
	print'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}



?>
</div>


<div class="preorder">
<h1>カートの中身</h1>
<br />
<table border="1"　>
<tr>
<td>商品</td>
<td>商品画像</td>
<td>価格</td>
<td>数量</td>
<td>小計</td>
<td>削除</td>
</tr>
<form method="post" action="kazu_change.php">
<?php for($i=0;$i<$max;$i++)
	{
?>
<tr>
	<td><?php print $pro_name[$i]; ?></td>
	<td><?php print $pro_gazou[$i]; ?></td>
	<td><?php print $pro_price[$i]; ?>円</td>
	<td><input type="text" name="kazu<?php print $i; ?>" value="<?php print $kazu[$i]; ?>"></td>
	<td><?php print $pro_price[$i]*$kazu[$i]; ?>円</td>
	<td><input type="checkbox" name="sakujo<?php print $i; ?>"></td>
</tr>
<?php
	}
?>
</table>
<input type="hidden" name="max" value="<?php print $max; ?>">
<input type="submit" value="数量変更"><br />
<input type="button" class="button" onclick="history.back()" value="戻る">
</form>
<br />
<h3><a href="shop_form.html" style="color:#000">ご購入手続きへ進む</a></h3>


<?php
	if(isset($_SESSION["member_login"])==true)
	{
		print '<h3><a href="shop_kantan_check.php" style="color:#000">会員かんたん注文へ進む</a></h3><br />';
	}
?>

</div>

<footer>
		<div class="wrapper">
				<p><small>&copy; 2020 portfolio </small></p>
		</div>
</footer>

</body>
</html>
