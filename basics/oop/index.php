<?php
require_once "models.php";
//$studentOne = new Student();
//$studentOne->setFirstName("Michal");
//$studentOne->setLastName("Adámik");
//$studentOne->setBirth(1989,1,3);
//$studentOne->setEnrollDate(2000,8,4);
//
//$studentTwo = new Student();
//$studentTwo->setFirstName("Jan");
//$studentTwo->setLastName("Kozeluh");
//$studentTwo->setBirth(2004,4,8);
//$studentTwo->setEnrollDate(4,4,2022);
//$studentTwo->setCredits(100);
//
//$studentThree = new Student();
//$studentThree->setFirstName("Jakub");
//$studentThree->setLastName("Malina");
//$studentThree->setBirth(2003,3,3);
//$studentThree->setEnrollDate(2021,3,3);
//$studentThree->setCredits(80);
//
//$subjectOne = new Subject();
//$subjectOne->setName("History");
//$subjectOne->setCredits(4);
//$subjectOne->setSemester(1);
//$subjectOne->setGarant(30);

//$teacherOne = new Teacher();
//$teacherOne->setDegree("Mgr.");
//$teacherOne->setFirstName("Jakub");
//$teacherOne->setLastName("Hutečka");
//$teacherOne->setBirth(2003,6,8);
//setBirth(yyyy,mm,dd);
//setEnrollDate(yyyy,mm,dd);



//echo $studentOne->getEnrollDate();
//echo $teacherOne->getDegree();
//$studentOne->setCredits(180);
//$studentOne->leave('Math');
//$studentOne->getAllStudents();
//Subject::getAllSubjectsFromDatabase();
Action::getSubjects();
//Action::getStudents();
Action::getTeachers();

Action::getStudentsAZByLastName();

//Action::leave($studentTwo);
//Action::insertSubjectToPerson($studentThree,'History');
//Action::leaveSubject($studentThree,'Math');
//Action::insertPerson($studentTwo);
//Action::deletePerson($studentOne);
//Subject::insertSubjectToDatabase($subjectOne);
//Student::insertStudentToDB($studentTwo);
//$studentOne->getConcreteStudent('Jan','Kozeluh');
//Student::deleteStudentFromDB($studentTwo);
//Action::insertSubject($subjectOne);
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">-->
    <title>DŽEN KOUDŽELUCH - INTERNSHIP - OOP projekt</title>
</head>
<body>

</body>
</html>





