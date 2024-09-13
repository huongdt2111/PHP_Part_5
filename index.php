<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $dbh = mysqli_connect('localhost', 'root', '', 'ex_php');
    // Connect to MySQL server

    if (!$dbh) {
        die("Unable to connect to MySQL: " . mysqli_connect_error());
    }

    if (!mysqli_select_db($dbh, 'ex_php')) {
        die("Unable to select database: " . mysqli_error($dbh));
    }

    // SELECT statement
    $sql_stmt = "SELECT * FROM information";
    $result = mysqli_query($dbh, $sql_stmt);

    if (!$result) {
        die("Database access failed: " . mysqli_error($dbh));
    }

    $rows = mysqli_num_rows($result);

    if ($rows) {
        while ($row = mysqli_fetch_array($result)) {
            echo 'ID: ' . $row['id'] . '<br>';
            echo 'Full Names: ' . $row['full_names'] . '<br>';
            echo 'Gender: ' . $row['gender'] . '<br>';
            echo 'Contact No: ' . $row['contact_no'] . '<br>';
            echo 'Email: ' . $row['email'] . '<br>';
        }
    }

    // INSERT statement
    $sql_stmt = "INSERT INTO information (full_names, gender, contact_no, email) ";
    $sql_stmt .= "VALUES ('Dao Huong', 'Mail', '541', 'daohuong@sea.oc')";

    $result = mysqli_query($dbh, $sql_stmt);

    if (!$result) {
        die("Adding record failed: " . mysqli_error($dbh));
    } else {
        echo "Dao Huong has been successfully added to your contacts list<br>";
    }

    // UPDATE statement
    $sql_stmt = "UPDATE information SET contact_no = '785', email = 'daohuong@ocean.oc' ";
    $sql_stmt .= "WHERE id = 5";

    $result = mysqli_query($dbh, $sql_stmt);

    if (!$result) {
        die("Updating record failed: " . mysqli_error($dbh));
    } else {
        echo "ID number 5 has been successfully updated<br>";
    }

    // DELETE statement
    $id = 4;
    $sql_stmt = "DELETE FROM information WHERE id = $id";

    $result = mysqli_query($dbh, $sql_stmt);

    if (!$result) {
        die("Deleting record failed: " . mysqli_error($dbh));
    } else {
        echo "ID number $id has been successfully deleted<br>";
    }

    mysqli_close($dbh);
    ?>
</body>

</html>
