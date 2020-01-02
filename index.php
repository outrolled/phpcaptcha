<?php
$hash= base64_encode(substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVXYZ'), 0, 4));
?>
<!DOCTYPE html>
<html>
<head>
	<title>Captcha Demo</title>
</head>
<body>
	<img src="captcha.php?hash=<?php echo $hash; ?>" alt="image verification">
	<!-- <input type="hidden" id="captchha" name="captcha" value="<?php echo $hash; ?>"> -->

</body>
</html>