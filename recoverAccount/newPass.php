<style type="text/css">
	div{
		position: relative;
		height:20vh;
		margin-top:40vh;
	}
	
</style>

<div style="width: 100%"; >
	<h1> Enter Your New Password:
	<form method = "POST" action="">
		<input type="password" name="pass" placeholder= "New Password" required>
		<input type="hidden" name = "groupnm"value= <?php echo $_GET["groupnm"] ?> >
		<input type="hidden" name="temppass" value = <?php echo $_GET["temppass"] ?> >
		<button dis = "normal" type="submit" name="submit" value="newPass"> Complete</button>
	</form>
</div>
