<?php
session_start();

require_once "pdo.php";


if (!isset($_SESSION['name'])) {
    die('Not logged in');
}

// Guardian: Make sure that user_id is present
if (!isset($_GET['profile_id'])) {
    $_SESSION['error'] = "Missing profile_id";
    header('Location: index.php');
    return;
}

function validatePos()
{
    for ($i = 1; $i <= 9; $i++) {
        if (!isset($_POST['year' . $i])) continue;
        if (!isset($_POST['desc' . $i])) continue;

        $year = $_POST['year' . $i];
        $desc = $_POST['desc' . $i];

        if (strlen($year) == 0 || strlen($desc) == 0) {
            return "All fields are required";
        }

        if (!is_numeric($year)) {
            return "Position year must be numeric";
        }
    }
    return true;
}

$stmt = $pdo->prepare("SELECT * FROM Profile where profile_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['profile_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row === false) {
    $_SESSION['error'] = 'Bad value for user_id';
    header('Location: index.php');
    return;
}

$stmt = $pdo->prepare("SELECT * FROM Position where profile_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['profile_id']));
$rowOfPosition = $stmt->fetchAll();
if (
    isset($_POST['first_name']) &&
    isset($_POST['first_name']) &&
    isset($_POST['last_name']) &&
    isset($_POST['email']) &&
    isset($_POST['headline'])
) {
    if (
        strlen($_POST['first_name']) < 1
        || strlen($_POST['last_name']) < 1
        || strlen($_POST['email']) < 1
        || strlen($_POST['headline']) < 1
        || strlen($_POST['summary']) < 1
    ) {
        $_SESSION['error'] = 'All values are required';
        header("Location: add.php");
        return;
    }
    if (strpos($_POST['email'], '@') === false) {
        $_SESSION['error'] = 'Bad Email';
    }
    if (is_string(validatePos())) {
        $_SESSION['error'] = validatePos();
        header("Location: edit.php?profile_id=" . $_GET['profile_id']);
        return;
    }

    $sql = "UPDATE Profile SET first_name = :first_name, last_name = :last_name,email=:email,headline=:headline,summary=:summary
            WHERE profile_id = :profile_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        array(
            ':first_name' => $_POST['first_name'],
            ':last_name' => $_POST['last_name'],
            ':email' => $_POST['email'],
            ':headline' => $_POST['headline'],
            ':summary' => $_POST['summary'],
            ':profile_id' => $_GET['profile_id']
        )
    );

    //delete all position then add the modified ones
    $stmt = $pdo->prepare("DELETE FROM Position WHERE profile_id = :id");
    $stmt->execute(array(":id" => $_REQUEST['profile_id']));
    $rank = 1;
    for ($i = 1; $i <= 9; $i++) {
        if (!isset($_POST['year' . $i])) continue;
        if (!isset($_POST['desc' . $i])) continue;
        $year = $_POST['year' . $i];
        $desc = $_POST['desc' . $i];
        $stmt = $pdo->prepare('INSERT INTO Position (profile_id, rank, year, description) VALUES ( :pid, :rank, :year, :desc)');
        $stmt->execute(
            array(
                ':pid' => $profile_id,
                ':rank' => $rank,
                ':year' => $year,
                ':desc' => $desc
            )
        );
        $rank++;
    }
    $_SESSION['success'] = 'Record updated';
    header('Location: index.php');
    return;
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php require_once "bootstrap.php"; ?>
    <title>CuongTCSE150676 Edit Page</title>
</head>

<body>
    <div class="container">
        <h1>Editing Profile for UMSI</h1>
        <?php
        if (isset($_SESSION['error'])) {
            echo ('<p style="color: red;">' . htmlentities($_SESSION['error']) . "</p>\n");
            unset($_SESSION['error']);
        }
        ?>
        <form method="post">
            <p>First Name:
                <input type="text" name="first_name" size="60" value="<?php echo $row['first_name'] ?>" />
            </p>
            <p>Last Name:
                <input type="text" name="last_name" size="60" value="<?php echo $row['last_name'] ?>" />
            </p>
            <p>Email:
                <input type="text" name="email" size="30" value="<?php echo $row['email'] ?>" />
            </p>
            <p>Headline:<br />
                <input type="text" name="headline" size="80" value="<?php echo $row['headline'] ?>" />
            </p>
            <p>Summary:<br />
                <textarea name="summary" rows="8" cols="80"><?php echo $row['summary'] ?></textarea>
            </p>
            <p>
                Position: <input type="submit" id="addPos" value="+">
            <div id="position_fields">
                <?php
                $rank = 1;
                foreach ($rowOfPosition as $row) {
                    echo "<div id=\"position" . $rank . "\">
                        <p>Year: <input type=\"text\" name=\"year1\" value=\"" . $row['year'] . "\">
                        <input type=\"button\" value=\"-\" onclick=\"$('#position" . $rank . "').remove();return false;\"></p>
                        <textarea name=\"desc" . $rank . "\"').\" rows=\"8\" cols=\"80\">" . $row['description'] . "</textarea>
                        </div>";
                    $rank++;
                } ?>
            </div>
            <input type="submit" value="Save">
            <input type="submit" name="cancel" value="Cancel">
        </form>
    </div>
    <script>
        var countPos = 0;
        $(document).ready(function() {
            $('#addPos').click(function(event) {
                event.preventDefault();
                if (countPos >= 9) {
                    alert("Maximum of nine position entries exceeded");
                    return;
                }
                countPos++;
                window.console && console.log("Adding Position " + countPos);
                $("#position_fields").append(
                    `<div id="position${countPos}">
                        <p>
                        Year: <input type="text" name="year${countPos}" value=""/>
                        <input type="button" value="-" onclick="$(\'#position${countPos}'\).remove(); return false;"/>
                        </p>
                        <textarea name="desc${countPos}" row="8" cols="80"></textarea>
                    </div>
                    `
                );
            });
        });
    </script>
</body>

</html>