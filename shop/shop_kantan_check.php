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
  <div class="preorder">


<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login'])==false)
{
	print '※ログインされていません。<br />';
	print '<h3><a href="shop_list.php" >商品一覧へ</a></h3>';
	exit();
}
?>


<?php
$code=$_SESSION['member_code'];

$dsn='mysql:dbname=shop;host=localhost;charset=utf8';
$user='root';
$password='';
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$sql='SELECT name,email,postal1,postal2,address,tel FROM dat_member WHERE code=?';
$stmt=$dbh->prepare($sql);
$data[]=$code;
$stmt->execute($data);
$rec=$stmt->fetch(PDO::FETCH_ASSOC);

$dbh=null;

$onamae=$rec['name'];
$email=$rec['email'];
$postal1=$rec['postal1'];
$postal2=$rec['postal2'];
$address=$rec['address'];
$tel=$rec['tel'];

print 'お名前:';
print $onamae;
print '<br /><br />';

print 'メールアドレス:';
print $email;
print '<br /><br />';

print '郵便番号:';
print $postal1;
print '-';
print $postal2;
print '<br /><br />';

print '住所:';
print $address;
print '<br /><br />';

print '電話番号:';
print $tel;
print '<br /><br />';

print '<form method="post" action="shop_kantan_done.php">';
print '<input type="hidden" name="onamae" value="'.$onamae.'">';
print '<input type="hidden" name="email" value="'.$email.'">';
print '<input type="hidden" name="postal1" value="'.$postal1.'">';
print '<input type="hidden" name="postal2" value="'.$postal2.'">';
print '<input type="hidden" name="address" value="'.$address.'">';
print '<input type="hidden" name="tel" value="'.$tel.'">';
print '<input type="button" class="button" onclick="history.back()" value="戻る">';
print '<input type="submit" value="ＯＫ"><br />';
print '</form>';
?>

</div>
<footer>
		<div class="wrapper">
				<p><small>&copy; 2020 portfolio </small></p>
		</div>
</footer>
</body>
</html>
