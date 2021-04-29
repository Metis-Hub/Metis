function hash(seed) {
    var pw = String(document.getElementById("pwd").value);
    var email = String(document.getElementById("email").value);

    if (email.length + pw.length == 0) window.location.href = "index.php?error=fields_are_empty";
    else if (email.length == 0) window.location.href = "index.php?error=email_field_is_empty";
    else if (pw.length == 0) window.location.href = "index.php?error=password_field_is_empty";
    else if (email.indexOf("@") == -1 || email.indexOf(".") == -1) window.location.href = "index.php?error=invalid_email";
    else {
        var hash = parseInt(seed);
        var out = "";

        for (var v = 0; v < pw.length; v++) {
            hash = hash * 271 % 999999 + 1;
            out += hash ^ pw.charCodeAt(v);
            out += ';';
        }
        for (var v = pw.length; v < 100; v++) {
            hash = hash * 271 % 999999 + 1;
            out += hash ^ 3141;
            out += ";";
        }

        document.getElementById("pwd").text = out;
        document.getElementById("pw").value = out;
        document.getElementById("Email").value = email;
        document.getElementById("password").submit();
    }
}