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

require_once('../common/common.php');

$post=sanitize($_POST);

$onamae=$post['onamae'];
$email=$post['email'];
$postal1=$post['postal1'];
$postal2=$post['postal2'];
$address=$post['address'];
$tel=$post['tel'];
$chumon=$post['chumon'];
$pass=$post['pass'];
$pass2=$post['pass2'];
$danjo=$post['danjo'];
$birth=$post['birth'];

$okflg=true;

if($onamae=='')
{
	print '※お名前が入力されていません。<br /><br />';
	$okflg=false;
}
else
{
	print 'お名前:';
	print $onamae;
	print '<br /><br />';
}

if(preg_match('/^[\w\-\.]+\@[\w\-\.]+\.([a-z]+)$/',$email)==0)
{
	print '※メールアドレスを正確に入力してください。<br /><br />';
	$okflg=false;
}
else
{
	print 'メールアドレス:';
	print $email;
	print '<br /><br />';
}

if(preg_match('/^[0-9]+$/',$postal1)==0)
{
	print '※郵便番号は半角数字で入力してください。<br /><br />';
	$okflg=false;
}
else
{
	print '郵便番号:';
	print $postal1;
	print '-';
	print $postal2;
	print '<br /><br />';
}

if(preg_match('/^[0-9]+$/',$postal2)==0)
{
	print '※郵便番号は半角数字で入力してください。<br /><br />';
	$okflg=false;
}

if($address=='')
{
	print '※住所が入力されていません。<br /><br />';
	$okflg=false;
}
else
{
	print '住所:';
	print $address;
	print '<br /><br />';
}

if(preg_match('/^\d{2,5}-?\d{2,5}-?\d{4,5}$/',$tel)==0)
{
	print '※電話番号を正確に入力してください。<br /><br />';
	$okflg=false;
}
else
{
	print '電話番号:';
	print $tel;
	print '<br /><br />';
}

if($chumon=='chumontouroku')
{
	if($pass=='')
	{
		print '※パスワードが入力されていません。<br /><br />';
		$okflg=false;
	}

	if($pass!=$pass2)
	{
		print '※パスワードが一致しません。<br /><br />';
		$okflg=false;
	}

	print '性別<br />';
	if($danjo=='dan')
	{
		print '男性';
	}
	else
	{
		print '女性';
	}
	print '<br /><br />';

	print '生まれ年<br />';
	print $birth;
	print '年代';
	print '<br /><br />';

}

if($okflg==true)
{
	print '<form method="post" action="shop_form_done.php">';
	print '<input type="hidden" name="onamae" value="'.$onamae.'">';
	print '<input type="hidden" name="email" value="'.$email.'">';
	print '<input type="hidden" name="postal1" value="'.$postal1.'">';
	print '<input type="hidden" name="postal2" value="'.$postal2.'">';
	print '<input type="hidden" name="address" value="'.$address.'">';
	print '<input type="hidden" name="tel" value="'.$tel.'">';
	print '<input type="hidden" name="chumon" value="'.$chumon.'">';
	print '<input type="hidden" name="pass" value="'.$pass.'">';
	print '<input type="hidden" name="danjo" value="'.$danjo.'">';
	print '<input type="hidden" name="birth" value="'.$birth.'">';
	print '<input type="button" class="button" onclick="history.back()" value="戻る">';
	print '<input type="submit" value="ＯＫ"><br />';
	print '</form>';
}
else
{
	print '<form>';
	print '<input type="button"  class="button" onclick="history.back()" value="戻る">';
	print '</form>';
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
