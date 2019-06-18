<style type="text/css">
	.main{
		position: relative;
		height:20vh;
		margin-top:30vh;
	}
	h2{
		color:#f99500;;
		text-align: center;
	}
</style>
<div class = "main" style="width: 100%"; >
	
	<h2><?php if(isset($_GET["message"])) {
		if($_GET["message"]=='fail')
		echo "The information you provided is not correct. Please try again.";
	}?></h2>
	<h1> Enter Your User Name:</h1>
	<form method = "POST">
		<input type="text" name="accountName" required>
		<button dis = "normal" type="submit" name="submit" value="confirmInfo"> NEXT</button>
	</form>
</div>