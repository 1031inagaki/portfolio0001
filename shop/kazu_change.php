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

  <div class="preorder">
<?php
	session_start();
	session_regenerate_id(true);

	require_once('../common/common.php');

	$post=sanitize($_POST);

	$max=$post['max'];
	for($i=0;$i<$max;$i++)
	{
		if(preg_match("/^[0-9]+$/", $post['kazu'.$i])==0)
		{
			print '※数量に誤りがあります。<br />';
			print '<h3><a href="shop_cartlook.php" style="color:#000">カートに戻る</a></h3>';
			exit();
		}
		if($post['kazu'.$i]<1 || 10<$post['kazu'.$i])
		{
			print '※数量は必ず1個以上、10個までです。<br />';
			print '<h3><a href="shop_cartlook.php" style="color:#000">カートに戻る</a></h3>';
			exit();
		}
		$kazu[]=$post['kazu'.$i];
	}

	$cart=$_SESSION['cart'];

	for($i=$max;0<=$i;$i--)
	{
		if(isset($_POST['sakujo'.$i])==true)
		{
			array_splice($cart,$i,1);
			array_splice($kazu,$i,1);
		}
	}

	$_SESSION['cart']=$cart;
	$_SESSION['kazu']=$kazu;

	header('Location:shop_cartlook.php');

?>


</div>



</body>


<footer>
		<div class="wrapper">
				<p><small>&copy; 2020 portfolio </small></p>
		</div>
</footer>
</html>
