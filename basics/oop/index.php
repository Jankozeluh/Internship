<?php
require_once "creation.php";
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
                <form action="index.php" method="post" class="px-4 py-3" style="text-align: center">
                    <h4 style="text-align: center">insert student</h4>
                    <input type="text" name="st_first_name" placeholder="First name" required><br />
                    <input type="text" name="st_last_name" placeholder="Last name" required><br />
                    Birth:<input type="date" name="st_birth" required><br />
                    Enrollment:<input type="date" name="st_enrollment" required><br />
                    <input type="number" name="st_credits" placeholder="Credits" required><br />
                    <input type="submit" name="student" value="Submit new student" />
                </form>
            </div>
            <div class="col-sm">
                <form action="index.php" method="post" class="px-4 py-3" style="text-align: center">
                    <h4 style="text-align: center">insert subject</h4>
                    <input type="text" name="subject_name" placeholder="Name" required><br />
                    <input type="number" name="subject_credits" placeholder="Credits" required><br />
                    <input type="number" name="subject_semester" placeholder="Semester" required><br />
                    Garant: <?php Action::getTeachersSelector('subject_garant'); ?>
                    <br>
                    PC: <select name="subject_pc" required>
                        <option value="1">YES</option>
                        <option value="2">NO</option>
                    </select>
                    <br>
                    <input type="submit" name="subject" value="Submit new subject" />
                </form>
            </div>
            <div class="col-sm">
                <form action="index.php" method="post" class="px-4 py-3" style="text-align: center">
                    <h4 style="text-align: center">insert teacher</h4>
                    <input type="text" name="tr_degree" placeholder="Degree" required><br />
                    <input type="text" name="tr_first_name" placeholder="First name" required><br />
                    <input type="text" name="tr_last_name" placeholder="Last name" required><br />
                    Birth: <input type="date" name="tr_birth"  required><br />
                    <input type="submit" name="teacher" value="Submit new teacher" />
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <form action="index.php" method="post" class="px-4 py-3" style="text-align: center">
                    <h4 style="text-align: center">insert subject to?</h4>
                    <?php Action::getPeopleSelector('i_id'); Action::getSubjectsSelector('i_subject_name'); ?>
                    <input type="number" placeholder="N.of lectures" name="i_lecture"><br />
                    <input type="number" placeholder="N.of exercises" name="i_exercise"><br />
                    <input type="submit" name="i_subject" value="Submit subject to a person" />
                </form>
            </div>
            <div class="col-sm">
                <form action="index.php" method="post" class="px-4 py-3" style="text-align: center">
                    <h4 style="text-align: center">students leave</h4>
                    <?php Action::getStudentsSelector('stt'); ?>
                    <input type="submit" name="s_leave" value="Submit leave" />
                </form>
            </div>
            <div class="col-sm">
                <form action="index.php" method="post" class="px-4 py-3" style="text-align: center">
                    <h4 style="text-align: center">leave subject</h4>
                    <?php Action::getStudentsSelector('leave');Action::getSubjectsSelector('leave_s'); ?>
                    <input type="submit" name="s_sub_leave" value="Submit leave subject" />
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm">
                <form action="index.php" method="post" class="px-4 py-3" style="text-align: center">
                    <h4 style="text-align: center">delete subject</h4>
                    <?php Action::getSubjectsSelector('deleteSub'); ?>
                    <input type="submit" name="d_subject" value="DELETE SUBJECT" />
                </form>
            </div>
            <div class="col-sm">
                <form action="index.php" method="post" class="px-4 py-3" style="text-align: center">
                    <h4 style="text-align: center">delete person</h4>
                    <?php Action::getPeopleSelector('deletePer'); ?>
                    <input type="submit" name="d_person" value="DELETE PERSON" />
                </form>
            </div>
            <div class="col-sm">
                <form action="index.php" method="post" class="px-4 py-3" style="text-align: center">
                    <h4 style="text-align: center">end subject</h4>
                    <?php Action::getSubjectsSelector('deleteSub'); ?>
                    <input type="submit" name="end_subject" value="END SUBJECT" />
                </form>
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
            Action::insertSubjectToPerson($_POST['i_id'], $_POST['i_subject_name'], $_POST['i_lecture'], $_POST['i_exercise']);
        }else{Action::insertSubjectToPerson($_POST['i_id'], $_POST['i_subject_name']);}
        $_POST = array();
    }elseif(isset($_POST['s_leave'])) {
        Action::leave((int)$_POST['stt']);
        $_POST = array();
    }elseif(isset($_POST['s_sub_leave'])) {
        Action::leaveSubject((int)$_POST['leave'],(int)$_POST['leave_s']);
        $_POST = array();
    }elseif(isset($_POST['d_subject'])) {
        Action::deleteSubject((int)$_POST['deleteSub']);
        $_POST = array();
    }elseif(isset($_POST['d_person'])) {
        Action::deletePerson((int)$_POST['deletePer']);
        $_POST = array();
    }elseif(isset($_POST['end_subject'])) {
        Action::endSubjectProperly((int)$_POST['deleteSub']);
        $_POST = array();
    }
?>

</body>
</html>
