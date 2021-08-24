<?php
require_once "creation.php";
//Action::insertPerson($Billy);
//Action::insertPerson($Karel);
//Action::insertPerson($Holly);
//Action::insertPerson($Bjergsen);
//Action::insertPerson($Faker);
//Action::insertPerson($Mithy);
//Action::insertPerson($Albert);
//Action::insertPerson($Doublelift);
//Action::insertPerson($Freeze);
//Action::insertPerson($Paul);

//Action::insertSubject($Math);
//Action::insertSubject($History);
//Action::insertSubject($Geography);
//Action::insertSubject($Art);

//Action::insertSubjectToPerson($Paul,'Math',40,2);
//Action::insertSubjectToPerson($Faker,'Art');
//Action::insertSubjectToPerson($Faker,'Math');
//Action::insertSubjectToPerson($Freeze,'History');
//Action::insertSubjectToPerson($Bjergsen,'Math');
//Action::insertSubjectToPerson($Holly,'History',20,1);

//Action::deleteSubject('History');
//Action::endSubjectProperly('Math');

//Action::deletePerson($Doublelift);
//Action::deletePerson($Karel);

//Action::leaveSubject($Faker,'Art');
//Action::leave($Faker);
//Action::leave($Freeze);

session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Koželuh - OOP projekt</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <form action="index.php" method="post" class="px-4 py-3">
                    <h4 style="text-align: center">insert student</h4>
                    First name:<input type="text" name="st_first_name" required><br />
                    Last name: <input type="text" name="st_last_name" required><br />
                    Birth:     <input type="date" name="st_birth" required><br />
                    Enrollment:<input type="date" name="st_enrollment" required><br />
                    Credits:   <input type="number" name="st_credits" required><br />
                    <input type="submit" name="student" value="Submit new student" />
                </form>
            </div>
            <div class="col-sm">
                <form action="index.php" method="post" class="px-4 py-3">
                    <h4 style="text-align: center">insert subject</h4>
                    Name:    <input type="text" name="subject_name" required><br />
                    Credits: <input type="number" name="subject_credits" required><br />
                    Semester:<input type="number" name="subject_semester" required><br />
                    Garant:  <input type="number" name="subject_garant" required><br />
                    Pc:      <input type="number" name="subject_pc" required><br />
                    <input type="submit" name="subject" value="Submit new subject" />
                </form>
            </div>
            <div class="col-sm">
                <form action="index.php" method="post" class="px-4 py-3">
                    <h4 style="text-align: center">insert teacher</h4>
                    Degree:    <input type="text" name="tr_degree" required><br />
                    First name:<input type="text" name="tr_first_name" required><br />
                    Last name: <input type="text" name="tr_last_name" required><br />
                    Birth:     <input type="date" name="tr_birth" required><br />
                    <input type="submit" name="teacher" value="Submit new teacher" />
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <form action="index.php" method="post" class="px-4 py-3">
                    <h4 style="text-align: center">insert subject to?</h4>
                    ID of a Person:<input type="number" name="i_id" required><br />
                    Subject name:  <input type="text" name="i_subject_name" required><br />
                    N.of lectures:<input type="number" name="i_lecture"><br />
                    N.of exercises:<input type="number" name="i_exercise"><br />
                    <input type="submit" name="i_subject" value="Submit subject to a person" />
                </form>
            </div>
            <div class="col-sm">
            </div>
            <div class="col-sm">
            </div>
        </div>
    </div>



<?php
    if(isset($_POST['student'])) {
        $student = new Student($_POST['st_first_name'],$_POST['st_last_name'], (string)date("Y/m/d", strtotime($_POST['st_birth'])),(string)date("Y/m/d", strtotime($_POST['st_enrollment'])),$_POST['st_credits']);
        Action::insertPerson($student);
        $_POST = array();
    }elseif(isset($_POST['subject'])) {
        $subject = new Subject($_POST['subject_name'],(int)$_POST['subject_credits'],(int)$_POST['subject_semester'],(int)$_POST['subject_garant'],(int)$_POST['subject_pc']);
        Action::insertSubject($subject);
        $_POST = array();
    }elseif(isset($_POST['teacher'])) {
        $teacher = new Teacher($_POST['tr_degree'],$_POST['tr_first_name'],$_POST['tr_last_name'],(string)date("Y/m/d", strtotime($_POST['tr_birth'])));
        Action::insertPerson($teacher);
        $_POST = array();
    }elseif(isset($_POST['i_subject'])) {
        if(!empty($_POST['i_lecture'] && $_POST['i_exercise'])){
            Action::insertSubjectToPerson2($_POST['i_id'], $_POST['i_subject_name'], $_POST['i_lecture'], $_POST['i_exercise']);
        }else{
            Action::insertSubjectToPerson2($_POST['i_id'], $_POST['i_subject_name']);
        }
        $_POST = array();
    }
?>

</body>
</html>
