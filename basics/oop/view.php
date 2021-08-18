<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
</head>
<body>
    <?php include 'index.php';?>

    <h2>Student creation</h2>
    <form action="index.php" method="post">
        First Name: <input type="text" name="studentsFirstName"><br>
        Last Name: <input type="text" name="studentsLastName"><br>
        Birth: <input type="date" name="studentsBirth"><br>
        Enrollment: <input type="date" name="studentsEnrollment"><br>
    <input type="submit">
    <h2>Teacher creation</h2>
    <form action="index.php" method="post">
        Degree: <input type="text" name="teachersDegree"><br>
        First Name: <input type="text" name="teachersFirstName"><br>
        Last Name: <input type="text" name="teachersLastName"><br>
        Birth: <input type="date" name="teachersBirth"><br>
        <!-- Sem nějak narvu ty  -->
    <input type="submit">

</body>
</html>