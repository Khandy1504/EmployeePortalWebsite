<!DOCTYPE html>
<head>
    <title>Profile Page</title>
</head>
<body>
    <h1>Profile</h1>
    <?php
    require_once('config.php');
    require_once('header.php');
    ?>

    <form action="account.php" method="POST">
    <button type="submit" name="submit">Account Information</button>
    </form>

</body>

</html>
