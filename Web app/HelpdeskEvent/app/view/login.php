<?php include __DIR__.'./includes/header.php';?>


<div id="mainContent">
<center><h1>LOGIN</h1></center>

</div>

<div id="LoginDiv">
	<form class="form-horizontal" method="POST" action="./checklogin">
		<label>USERNAME:</label>
		<input type="text" name="username" class="form-control" required id="username">
		<label>PASSWORD:</label>
		<input type="password" name="password" class="form-control" required id="password">
		<input type="submit" name="submit" class="btn-success" value="LOGIN">
	</form>
</div>

<?php include __DIR__.'./includes/footer.php';?>

</body>
</html>