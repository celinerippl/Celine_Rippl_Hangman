<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Registrierung</title>
    <link rel="stylesheet" type="text/css" href="registration.css">
</head>

<body>
    <form action="registration.php" method="POST">
        <ul>
            <li>
                <label for="firstname">Vorname</label>
                <input type="text" id="firstname" name="firstname" />
            </li>
            <li>
                <label for="lastname">Nachname</label>
                <input type="text" id="lastname" name="lastname" />
            </li>
            <li>
                <label for="email">E-Mail</label>
                <input type="email" id="email" name="email" />
            </li>
            <li>
                <label for="password">Passwort</label>
                <input type="password" id="password" name="password" />
            </li>
            <li>
                <label for="password_r">Passwort wiederholen</label>
                <input type="password" id="password_r" name="password_r" />
            </li>
            <li>
                <button type="submit">Jetzt registrieren</button>
            </li>
            <li>
                <button onclick="window.location.href='index.php'">Back To Login</button>
            </li>
        </ul>
    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            form_listeners();
        });

        function form_listeners() {

            $(document).on("submit", "form", function(e) {

                e.preventDefault();

                $.ajax({
                    url: 'action.php',
                    dataType: 'text',
                    type: 'post',
                    data: $("form").serialize(),
                    success: function(data) {

                        response = $.parseJSON(data);

                        if (response.status == "success") {

                            $("form ul").slideUp(500, function() {

                                $(this).replaceWith('<a class="link" href="index.php">Vielen Dank für Ihre Registrierung.<br><p class="subTextLink">Zurück zum Login</p></a>');
                                $("form a").fadeIn(300);
                            });

                        } 
                        else {

                            $("form ul").slideUp(500, function() {

                                $(this).replaceWith('<h2 class="hidden">E-Mail bereits im System vorhanden.</h2>');
                                $("form h2").fadeIn(300);
                            });
                        }
                    }
                });
            });
        }
    </script>
</body>

</html>