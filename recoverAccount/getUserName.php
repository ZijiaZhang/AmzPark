<style type="text/css">
	div{
		position: relative;
		height:20vh;
		margin-top:40vh;
	}
	h2{
		text-align: center;
	}
</style>
<div style="width: 100%"; >
	<h1> Enter Your User Name:</h1>
	<h2><?php if(isset($_GET["message"])) {
		if($_GET["message"]=='fail')
		echo "The information you provided is not correct. Please try again.";
	}?></h2>
	<form method = "POST">
		<input type="text" name="accountName" required>
		<button dis = "normal" type="submit" name="submit" value="confirmInfo"> NEXT</button>
	</form>
</div>