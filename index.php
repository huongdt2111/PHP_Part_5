<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đào Hường</title>
</head>

<body>
    <?php
    // Bài tập silde 6

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

    //Bài tập silde 24
    try {
        // Connect to MySQL using PDO
        $dbh = new PDO('mysql:host=localhost;dbname=ex_php', 'root', '');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 1. Insert data into the table
        echo "<h3>Inserting data:</h3>";
        $sql = "INSERT INTO information (full_names, gender, contact_no, email) 
                VALUES (:full_names, :gender, :contact_no, :email)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':full_names' => 'Thu Huong',
            ':gender' => 'Female',
            ':contact_no' => '541',
            ':email' => 'daohuong@sea.oc'
        ]);
        echo "Successfully added Thu Huong to the contact list.<br>";

        // 2. Update data in the table
        echo "<h3>Updating data:</h3>";
        $sql = "UPDATE information 
                SET contact_no = :contact_no, email = :email 
                WHERE id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([
            ':contact_no' => '785',
            ':email' => 'daohuong@ocean.oc',
            ':id' => 6
        ]);
        echo "Successfully updated ID number 5.<br>";

        // 3. Delete data from the table
        echo "<h3>Deleting data:</h3>";
        $id = 4;
        $sql = "DELETE FROM information WHERE id = :id";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([':id' => $id]);
        echo "Successfully deleted ID number $id.<br>";

        // 4. Display data from the table
        echo "<h3>Displaying data:</h3>";
        $sql = "SELECT * FROM information";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $row) {
            echo 'ID: ' . $row['id'] . '<br>';
            echo 'Full Names: ' . $row['full_names'] . '<br>';
            echo 'Gender: ' . $row['gender'] . '<br>';
            echo 'Contact No: ' . $row['contact_no'] . '<br>';
            echo 'Email: ' . $row['email'] . '<br><br>';
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close the connection
    $dbh = null;
    ?>
</body>

</html>
