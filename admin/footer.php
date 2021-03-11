		<footer>
		
		</footer>
	</body>
</html>

<?php
	flush();
	if(isset($_SESSION["wait"])) {
		unset($_SESSION["wait"]);
		sleep(30000);
	}
?>