<!DCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>StayHomeCafe - ORDER</title>
<meta name="description" content="ブレンドコーヒーとオーガニックフードご自宅に提供するカフェ"＞
<link rel="stylesheet" href="https://unpkg.com./ress/dist/ress.min.css">
<link rel="stylesheet" href="css/style.css">
<link href="https://fonts.googleapis.com/css?family=Love+Ya+Like+A+Sister&display=swap" rel="stylesheet">


<body>
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
	</div>
	<div class="member_login">
<?php

try
{

require_once('../common/common.php');

$post=sanitize($_POST);
$member_email=$post['email'];
$member_pass=$post['pass'];

$member_pass=md5($member_pass);

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT code,name FROM dat_member WHERE email=? AND password=?';
$stmt=$dbh->prepare($sql);
$data[]=$member_email;
$data[]=$member_pass;
$stmt->execute($data);

$dbh=null;

$rec=$stmt->fetch(PDO::FETCH_ASSOC);

if($rec==false)
{
	print '※メールアドレスかパスワードが間違っています。';
	print '<br />';
	print '<br />';
	print '<h3><a href="member_login.html" style="color:#000"> 戻る</a></h3>';
}
else
{
	session_start();
	$_SESSION['member_login']=1;
	$_SESSION['member_code']=$rec['code'];
	$_SESSION['member_name']=$rec['name'];
	header('Location:shop_list.php');
	exit();
}

}
catch(Exception $e)
{
	print 'ただいま障害により大変ご迷惑をお掛けしております。';
	exit();
}

?>
</div>
<footer>
		<div class="wrapper">
				<p><small>&copy; 2020 portfolio </small></p>
		</div>
</footer>
</body>
