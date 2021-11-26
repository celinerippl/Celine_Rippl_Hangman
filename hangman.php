<?php

session_start();

//Set folder or file name for location path.
function nameOfFolder()
{
    $filePathElements = explode("/", str_replace("\\", "/", __FILE__));
    $index = array(
        "index.php",
        "test.php"
    );
    if (in_array($filePathElements[count($filePathElements) - 1], $index)) {
        define("setNameOfFolder", $filePathElements[count($filePathElements) - 2]);
    } else {
        define("setNameOfFolder", $filePathElements[count($filePathElements) - 2] . "/" . $filePathElements[count($filePathElements) - 1]);
    }
}
nameOfFolder();

function verifySession()
{
    require('inc/words.php');
    if ($_SESSION["givenWord"] == true && isset($_SESSION["word"]) == true) {
        
    } else {
        $sql = "SELECT * FROM Words";
        $Words = [];
        foreach ($db->query($sql) as $row) {
            array_push($Words,$row['words']);
         }
        $word_count = count($Words);
        $random = rand(0, $word_count - 1);
        $word = $Words[$random];
        $_SESSION["word"] = $word;
        $_SESSION["givenWord"] = true;
        $_SESSION["sessionFinish"] = false;
        $_SESSION["wordLenght"] = strlen($word);
        $_SESSION["wrongGuesses"] = 0;
        $_SESSION["rightGuesses"] = 0;
        $_SESSION["confirmedLetterCount"] = strlen($word) - substr_count($word, " ");
        for ($i = 0; $i < strlen($word); $i ++) {
            if ($word[$i] == " ") {
                $_SESSION["letter" . $i] = "-";
                $_SESSION["showLetter" . $i] = "-";
            } else {
                $_SESSION["letter" . $i] = $word[$i];
                $_SESSION["showLetter" . $i] = "_";
            }
        }
        header("location: ../" . setNameOfFolder);
    }
}

//maxWrongGuesses können auf 8, 7 oder 6 festgelegt werden. Es legt die Anzahl der erlaubten Fehlversuche fest.
define("maxWrongGuesses", 8);

//Checks if user session success / fail
function statusGame()
{
    if ($_SESSION["wrongGuesses"] == maxWrongGuesses) {
        echo '
            <div id="end">
                <div class="output">
                    <h1><font color="red">YOU KILLED THE MAN!</font></h1>
                    <p>Answer was: ' . $_SESSION["word"] . '</p>
                    <button class="new-game" onclick="location.href = \'?p=new\';">NEW GAME</button>
                </div>
            </div>
';
        $_SESSION["sessionFinish"] = true;
    }
    if ($_SESSION["rightGuesses"] == $_SESSION["confirmedLetterCount"]) {
        echo '
            <div id="end">
                <div class="output">
                    <h1><font color="green">MAN SAVED!</font></h1>
                    <br>
                    <p>The word you were looking for was: <u>' . $_SESSION["word"] . '</u></p>
                    <br>
                    <button class="new-game" onclick="location.href = \'?p=new\';">NEW GAME</button>
                </div>
            </div>
';
        $_SESSION["sessionFinish"] = true;
    }
}

// Drawing hangman.
function buildHangman()
{
    $wrongGuesses = $_SESSION["wrongGuesses"];
    $onload = "";
    $scriptList6 = array(
        "podium();",
        "head(); leftEye(); rightEye();",
        "verticalLine();",
        "arm1();",
        "arm2();",
        "leg1();",
        "leg2();"
    );
    $scriptList7 = array(
        "podium();",
        "head();",
        "leftEye();", 
        "rightEye();",
        "verticalLine();",
        "arm1();",
        "arm2();",
        "leg1();",
        "leg2();"
    );
    $scriptList8 = array(
        "podium();",
        "head();", 
        "leftEye();",
        "rightEye();",
        "verticalLine();",
        "arm1();",
        "arm2();",
        "leg1();",
        "leg2();"
    );

    $scriptList = maxWrongGuesses == 6 ? $scriptList6 : maxWrongGuesses == 7 ? $scriptList7 : $scriptList8;
    for ($i = 0; $i < $wrongGuesses; $i ++) {
        if ($wrongGuesses != 0) {
            $onload = $onload . " " . $scriptList[$i];
        }
    }
    if ($_SESSION["onloadValue"] != $onload) {
        header("location: ../" . setNameOfFolder);
    }
    $_SESSION["onloadValue"] = $onload;

    $canvas = '<canvas width="250px" height="250px" id="hangman"></canvas>';
    echo $canvas;
}

// Get the word.
function writeDisplayingWord(){
    echo "<br>";
    $text = '';
    for ($i = 0; $i < $_SESSION["wordLenght"]; $i ++) {
        $text = $text.$_SESSION["showLetter" . $i] . " ";
    }
    echo "
    <br>
    <span class='word'>$text</span>
    <br>
    ";
}


// Get letter buttons.
function showButtons()
{
    echo "<br>";
    echo "<form method='post' action='?p=enter'>";
    $alphabet = range("A", "Z");
    $i = 0;
    foreach ($alphabet as $letter) {
        $i = $i + 1;
        if ($i == 10 || $i == 20) {
            echo "<br>";
        }
        if ($_SESSION["sessionFinish"] == true) {
            $addon = " onclick='return false;'";
        }
        echo "<button type='submit' name='letter' value='$letter'$addon>$letter</button>
        ";
    }
    echo "</form>";
}

// Get guess from input
function getGuess()
{
    echo "<br>";
    echo "<form method='post' action='?p=guess'>";
    echo '<input name="guess" class="input-guess" autocomplete="off" placeholder="Type your guess" onchange="this.form.submit()"></input>';
    echo "</form>";
}
?>
<html>
<head>
<title>Hangman</title>
<meta name="author" content="Celine Rippl" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="hangman.css" />
<script src="hangman.js"></script>
</head>
<body onload="<?php echo $_SESSION["onloadValue"]; ?>">
	<h1 class="gameName">HANGMAN</h1>
	<div class="clear"></div>
	<div id="content">
<?php
switch ($_GET["p"]) {
    default:
        verifySession();
        statusGame();
        buildHangman();
        writeDisplayingWord();
        showButtons();
        getGuess();
        break;
    case "enter":
        $pressed = $_POST["letter"];
        $checks = $_SESSION["wordLenght"]; //Is needed if user pressed wrong letter
        $wrong_check = false;
        // Check every letter.
        for ($i = 0; $i < $_SESSION["wordLenght"]; $i ++) {
            if (strtolower($_SESSION["showLetter" . $i]) != strtolower($pressed)) {
                
                if (strtolower($pressed) == strtolower($_SESSION["word"][$i])) {
                    
                    $_SESSION["showLetter" . $i] = strtoupper($_SESSION["letter" . $i]);
                    $_SESSION["rightGuesses"] += 1;
                    $checks -= 1;
                }
            } else {
                $wrong_check = true;
            }
        }

        //Increase wrongGuesses by 1 if wrong check is true else increase by 0
        $_SESSION["wrongGuesses"] += $wrong_check == true ? 1 : 0;
        if ($checks == $_SESSION["wordLenght"] && $wrong_check == false) {
            $_SESSION["wrongGuesses"] += 1;
        }
        header("location: ../" . setNameOfFolder);
        break;
    case "guess":
        $guessed = $_POST["guess"];
        if (strtolower($guessed) == strtolower($_SESSION["word"])) {
            $_SESSION["rightGuesses"] = $_SESSION["confirmedLetterCount"];
        } else {
            $_SESSION["wrongGuesses"] += 1;
        }
        header("location: ../" . setNameOfFolder);
        break;
    case "new":
        $_SESSION["givenWord"] = true;
        $_SESSION["word"] = null;
        header("location: ../" . setNameOfFolder);
        break;
}
?>
</body>
</html>