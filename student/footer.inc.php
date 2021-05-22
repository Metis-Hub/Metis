	
	<!-- Zeitanzeige -->
	<div id="time"></div>

	<!-- Zeitupdate -->
	<script type="text/JavaScript">
		function UpdateTime() {
			var now = new Date();
			var hour = now.getHours(), minute = now.getMinutes(), second = now.getSeconds(), day = now.getDay(), date = now.getDate(), month = now.getMonth();
			var days = ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"];

			document.getElementById("time").innerHTML = days[day] + ", der " + ((date < 10)? "0" + date : date) + "." + ((month < 10)? "0" + month : month) + "." +
			now.getFullYear() + "; " + ((hour < 10)? "0" + hour : hour) + ":" +	((minute < 10)? "0" + minute : minute) + ":" + ((second < 10)? "0" + second : second) + " Uhr";

			setTimeout(UpdateTime, 500);
		}
	</script>

</body>

</html>