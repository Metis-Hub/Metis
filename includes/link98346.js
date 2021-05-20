function hash(seed, errorfile, check_two_passwords) {
    var email = (check_two_passwords ? "" : String(document.getElementById("email").value));
    // Neues Passwort
    var pw = String(document.getElementById("pwd").value);
    var pw2 = (check_two_passwords ? String(document.getElementById("pwd2").value) : "");
    // Altes Passwort
    var pw_old = (check_two_passwords ? String(document.getElementById("pwd_old").value) : "");

    if ((check_two_passwords ? pw2.length + pw_old.length : email.length) + pw.length == 0) window.location.href = errorfile + "?error=fields_are_empty";
    else if (email.length == 0 && !check_two_passwords) window.location.href = errorfile + "?error=email_field_is_empty";
    else if (pw.length == 0) window.location.href = errorfile + "?error=password_field_is_empty";
    else if ((email.indexOf("@") == -1 || email.indexOf(".") == -1) && !check_two_passwords) window.location.href = errorfile + "?error=invalid_email";
    else if (pw2.length == 0 && check_two_passwords) window.location.href = errorfile + "?error=password_field2_is_empty";
    else if (pw_old.length == 0 && check_two_passwords) window.location.href = errorfile + "?error=password_old_field_is_empty";
    else if (pw2 != pw && check_two_passwords) window.location.href = errorfile + "?error=not_equal";
    else {

        function hash2(seed, pw) {

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

            return out;
        }

        var out = hash2(seed, pw);

        document.getElementById("pwd").text = out;
        document.getElementById("pw").value = out;

        if (!check_two_passwords) document.getElementById("Email").value = email;
        else {
            var out_old = hash2(seed, pw_old);
            document.getElementById("pwd_old").text = out_old;
            document.getElementById("pw_old").value = out_old;
            document.getElementById("pwd2").text = out;
        }

        document.getElementById("password").submit();
    }
}