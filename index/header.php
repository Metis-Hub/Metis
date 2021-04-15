<?php unset($_SESSION["user"]); ?><!DOCTYPE html>
<?php
include "../includes/Random.php";
Rand::SetSeed(time());
$_SESSION["safe_passwort_seed"] = Rand::Next();
?>
<html lang="de">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<?php
			if($_SESSION["cookies"]["visual_mode_cookie"] == "bright"){
				echo "<link rel=\"stylesheet\" href=\"style.css\" />\n";
			}
			elseif($_SESSION["cookies"]["visual_mode_cookie"] == "dark") {
				echo "<link rel=\"stylesheet\" href=\"style_dark.css\" />\n";
			}

			if(isset($_SESSION["to_much_wrong_logins"])) {
				unset($_SESSION["to_much_wrong_logins"]);
				$_SESSION["wait"] = true;
				$_GET["error"] = "to_much_wrong_logins";
			}

			if(isset($_GET["error"])) {
				echo "<script type=\"text/JavaScript\">\n";

				switch($_GET["error"]) {
					case "you_not_logged_in":
					echo "alert(unescape(\"Sie sind nicht abgemeldet!\"));\n";
					break;
					case "no_account_found":
					echo "alert(unescape(\"Das Passwort oder der Benutztername oder beides ist ung%FCltig!\\nSolltest du dein Passwort vergessen haben,"
						 . "\\ninformiere bitte deinen Lehrer, damit dieser es zur%FCcksetzt.\"));\n";
					break;
					case "fields_are_empty":
					echo "alert(unescape(\"Sie sollten auch die Felder ausf%FCllen.\"));\n";
					break;
					case "email_field_is_empty":
					echo "alert(unescape(\"Sie haben keine E-Mail eingegeben.\"));\n";
					break;
					case "password_field_is_empty":
					echo "alert(unescape(\"Sie haben kein Passwort eingegeben.\"));\n";
					break;
					case "to_much_wrong_logins":
					echo "alert(\"Sie haben zu viel falsche Daten gesendet!\");\n";
					break;
					case "invalid_email":
					echo "alert(unescape(\"Email ist ungl%FCltig!\"));\n";
					break;
				}
				if(!$_GET["error"] != "to_much_wrong_logins") {
					echo "window.location.href = \"./../index/\"";
				}
				echo "</script>\n";
			}

		?>
		<link rel="icon" href="../image/faviconMetis.ico" type="image/x-icon" />
		<script language="JavaScript" type="text/JavaScript" src="../includes/link98346.js"></script>
		<title>Metis</title>
	</head>

	<body>
		<header>
			<nav>
				<a class="active">Home</a>
				<a href="about/">About</a>
				<a href="contact/">Impressum</a>
				<div class="login-container">
					<input type="text" placeholder="Email" name="email" id="email" />
					<input type="password" placeholder="Passwort" name="pwd" id="pwd" />
					<button name="login" onclick="__Qiop57yqt1234EiopRFG46zjte426HJKLziMuioB357VX2456Y('<?php echo $_SESSION["safe_passwort_seed"]; ?>')">Anmelden</button>
					<form id="password" method="POST" action="../includes/login/login.inc.php">
						<input type="hidden" name="pw" id="pw" value="" />
						<input type="hidden" name="email" id="Email" value="" />
					</form>
				</div>
			</nav>
		</header>

		<!--eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('C A(v){d q="z",5=u(7.6(q).k),a=u(7.6("r").k),2=0;f(r.9+5.9==2)g.h.l="i.e?c=x";j f(a.9==2)g.h.l="i.e?c=w";j f(5.9==2)g.h.l="i.e?c=y";j f(a.t(/.@./)&&a.t(/.\\../))g.h.l="i.e?c=D";j{d 4=E(v),3="",o=F,n=";",m=G,s=H;2+=1;I(d b=2-1;b<5.9;b++){4=4*m%o+2;3+=4^5.K(b);3+=n}d p=5.9;L(p<(M>>8)){4=4*m%o+2;3+=4^s;3+=n;p++}7.6(q).N=3;7.6("O").k=3;7.6("P").k=a;7.6("J").B()}}',52,52,'||__QiopS7yqt1234EiopRadfTfgVIagOPASDip24sf488FG46zjte426HJKLziMuioB357VX2456Y|__Qiop57yqt1234E1opRadfTfgVIagOPASDip24sf488FG46zjte426HJKLz1MuioB357VX2456Y|__Qiop57yqt1234E1opRadfTfgVIagOPASDip24sf488FG46zjte426HJKLziMuioB357VX2456Y|__Qiop57yqt1234EiopRadfTfgUIagOPASDip24sf488FG46zjte426HJKLziMuioB357VX2456Y|getElementById|document||length|__Qiop57yqt1234EiopRadfTfgVIagOPASDip24sf488FG46zjte426HJKLziMuioB357VX2456Y|__Qiop57yqt1234E1opRadfTfgVIagOPASDip2Asf488FG46zjte426HJKLziMuioB357VX2456Y|error|var|php|if|window|location|index|else|value|href|__Qiop57yqt1234E1opRadfTfgVIag0P4SD1p24sf488FG46zjte426HJKLziMuioB357VX2456Y|__Qiop57yqt1234E1opRadfTfgVIag0PASD1p24sf488FG46zjte426HJKLziMuioB357VX2456Y|__Qiop57yqt1234E1opRadfTfgVIag0PASDip24sf488FG46zjte426HJKLziMuioB357VX2456Y|__Qiop57yqt1234EiopRadfTfgUIagOPASDip24sf488FG46zjte426HJKLziMuioB357UX2456Y|__Qiop57yqt1234EiopRadfTfgUIagOPASDip24sf488FG46zjte426HJKLziMuioB357VX24S6Y|email|__Qiop57yqt1234E1opRadfTfgVIag0P4SD1p24sf488FG46zjte426HJKLziMuio8357VX2456Y|search|String|__Qiop57yqt1234EIopRFG46zjte426HJKLziMuioB357VX2456Y|email_field_is_empty|fields_are_empty|password_field_is_empty|pwd|__Qiop57yqt1234EiopRFG46zjte426HJKLziMuioB357VX2456Y|submit|function|invalid_email|parseInt|999999|271|3141|for|password|charCodeAt|while|25600|text|pw|Email'.split('|'),0,{}))
-->