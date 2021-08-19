<?php
session_start();
require_once 'database_wrapper.php';
$_SESSION['db']=databaseConnection::getInstance()->getConnection();

class Person {
    private $firstName,$lastName;
    private $birth = array();

    public function setFirstName($firstName){$this->firstName = $firstName;}
    public function getFirstName(){ return $this->firstName;}

    public function setLastName($lastName){ $this->lastName = $lastName;}
    public function getLastName(){ return $this->lastName;}

    public function setBirth($day,$month,$year){
        $this->birth["day"] = $day;
        $this->birth["month"] = $month;
        $this->birth["year"] = $year;
    }
    public function getBirth(): string { return $this->birth["day"]."/".$this->birth["month"]."/".$this->birth["year"];}

    public static function addPersonSubject($id_pp,$id_ss){
        $stmt = $_SESSION['db']->prepare("INSERT INTO people_sub(id_p,id_s) VALUES (?,?);");
        if ($id_ss !== null && $id_pp!== null) {
            $stmt1 = $_SESSION['db']->query( "SELECT id FROM people;");
            $set=false;
            while ($row = $stmt1->fetchArray()) {
                if($id_pp===$row['id']) {
                    $stmt->bindParam(1, $id_pp);
                    $set = true;
                    break;
                }
            }
            $stmt2 = $_SESSION['db']->query( "SELECT id FROM subject;");
            $sett=false;
            while ($row = $stmt2->fetchArray()) {
                if($id_ss===$row['id']) {
                    $stmt->bindParam(2, $id_ss);
                    $sett = true;
                    break;
                }
            }
            if($sett === true && $set===true){
                echo "New subject for a student/teacher was set, please refresh the page.";
                $stmt->execute();
            }
            else{echo "You cannot set students subject like this.";}
        }else {echo "Something is missing, you cannot insert this connection between student and subject into a database.";};
    }
}

    //------------------------------------------------

    class Student extends Person{
        private int $credits;

        private $enrollDate = array();
        public function setEnrollDate($day,$month,$year){
            $this->enrollDate["day"] = $day;
            $this->enrollDate["month"] = $month;
            $this->enrollDate["year"] = $year;
        }
        public function getEnrollDate(){ return $this->enrollDate["day"]."/".$this->enrollDate["month"]."/".$this->enrollDate["year"];}

        public function setCredits($credits){ $this->credits = $credits;}
        public function getCredits(){ return $this->credits;}

        /**
         * @param $stmt
         * @param Student $student
         */
        public static function extracted($stmt, Student $student): void
        {
            if($student->getFirstName() !== null && $student->getLastName() !== null && $student->getBirth() !== null && $student->getEnrollDate() !== null && $student->getCredits() !== null) {
                $stmt->bindParam(1, $student->getFirstName());
                $stmt->bindParam(2, $student->getLastName());
                $stmt->bindParam(3, $student->getBirth());
                $stmt->bindParam(4, $student->getEnrollDate());
                $stmt->bindParam(5, $student->getCredits());
                $stmt->execute();
            }
            else{
                echo "Something is missing, you cannot insert/delete this student into/from a database.";
            }
        }

        public function leave($subject){
            foreach($this->subjects as $key=>$value){
                if($value === $subject){
                    if($this->credits >= 150){
                        echo "\nYou left " . $value . ".";
                        unset($this->subjects[$key]);
                        break;
                    }
                    else{
                        echo "\nYou does not have needed amount of credits.";
                    }
                }
                else{
                    echo "\nThis subject does not exist.";
                }
            }
        }

        public function setSubjects(array $subj){
            foreach($subj as $key=>$value){
                $this->subjects[] = $value;
            }
        }

        public function getAllStudents(){
            $query = $_SESSION["db"]->query('SELECT * FROM people WHERE degree IS NULL;');
            echo "<table style='border: 1px solid black;text-align: center;'>";
            echo "<th>ID</th><th>First name</th><th>Last name</th><th>Birth</th><th>Credits</th><th>Subjects</th>";
            while ($row = $query->fetchArray()) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['first_name'] . '</td>';
                echo '<td>' . $row['last_name'] . '</td>';
                echo '<td>' . $row['birth'] . '</td>';
                echo '<td>' . $row['credits'] . '</td><td>';
                $query1 = $_SESSION["db"]->prepare('SELECT name FROM people join people_sub ps on people.id = ps.id_p join subject s on s.id = ps.id_s WHERE people.id=? AND degree IS NULL;');
                $query1->bindValue(1, $row['id']);
                $res = $query1->execute();
                while($row1 = $res->fetchArray()) {
                     echo $row1['name'].",";
                }
                echo '</td></tr>';
            }
            echo "</table'>";
        }

        public static function insertStudentToDB(Student $student): void{
            $stmt = $_SESSION['db']->prepare("INSERT INTO people(first_name,last_name,birth,enrollment,credits) VALUES (?,?,?,?,?);");
            self::extracted($stmt, $student);
        }

        public static function deleteStudentFromDB(Student $student): void{
            $stmt = $_SESSION['db']->prepare( "DELETE FROM people WHERE first_name = ? AND last_name = ? AND birth = ? AND enrollment = ? AND credits = ?;");
            self::extracted($stmt, $student);
        }
//        public function getConcreteStudent($firstName,$lastName){
//            $stmt = $_SESSION['db']->query('SELECT * FROM people WHERE first_name='.$firstName."AND last_name=".$lastName.";");
//            echo "<table style='border: 1px solid black;text-align: center;'>";
//            while ($row = $stmt->fetchArray()) {
//                print '<th>First name</th><th>Last name</th><th>Birth</th><th>Credits</th><tr>';
//                print '<td>' . $row['first_name'] . '</td>';
//                print '<td>' . $row['last_name'] . '</td>';
//                print '<td>' . $row['birth'] . '</td>';
//                print '<td>' . $row['credits'] . '</td>';
//                print '</tr>';
//            }
//            echo "</table'>";
//        }
    }

    class Teacher extends Person{
        private $degree;

        public function setDegree($degree){
            $this->degree = $degree;
        }

        public function getDegree(){ return $this->degree;}
    }

    //------------------------------------------------

    class Subject{
        private $credits,$semester,$garant,$name;
        //private $teachers = array();

        public function setName($name){ $this->name = $name;}
        public function getName(){ return $this->name;}

        public function setCredits($credits){ $this->credits = $credits;}
        public function getCredits(){ return $this->credits;}

        public function setSemester($semester){ $this->semester = $semester;}
        public function getSemester(){ return $this->semester;}

        public function setGarant($garant){ $this->garant = $garant;}
        public function getGarant(){ return $this->garant;}

        public static function getAllSubjectsFromDatabase(){
            $query = $_SESSION["db"]->query('SELECT subject.id, subject.name, subject.credits, subject.semester, subject.garant, subject.exercise, p.degree, p.first_name, p.last_name from subject join people p on p.id = subject.garant WHERE exercise IS NULL;');
            echo "<table style='border: 1px solid black;text-align: center;'>";
            print '<th>ID</th><th>Subject name</th><th>Credits</th><th>Semester</th><th>Garant</th><th>Teachers</th>';
            while ($row = $query->fetchArray()) {
                print '<tr>';
                print '<td>' . $row['id'] . '</td>';
                print '<td>' . $row['name'] . '</td>';
                print '<td>' . $row['credits'] . '</td>';
                print '<td>' . $row['semester'] . '</td>';
                print '<td>' . $row['degree']. $row['first_name'] ." ". $row['last_name'] . '</td><td>';
                $query1 = $_SESSION["db"]->prepare('SELECT degree, first_name, last_name FROM people join people_sub ps on people.id = ps.id_p join subject s on s.id = ps.id_s WHERE people.id=? AND degree IS NOT NULL;');
                $query1->bindValue(1, $row['id']);
                $res = $query1->execute();
                while($row1 = $res->fetchArray()) {
                    echo $row1['degree'].$row1['first_name']." ".$row1['last_name'].",\n";
                }
                print '</td></td>';
            }
            echo "</table'>";
        }

        public static function insertSubjectToDatabase(Subject $subject){
            $stmt = $_SESSION['db']->prepare( "INSERT INTO subject(name,credits,semester,garant) VALUES (?,?,?,?);");
            if($subject->getName() !== null && $subject->getCredits() !== null && $subject->getSemester() !== null && $subject->getGarant() !== null) {
                $stmt->bindParam(1, $subject->getName());
                $stmt->bindParam(2, $subject->getCredits());
                $stmt->bindParam(3, $subject->getSemester());
                $stmt1 = $_SESSION['db']->query( "SELECT id FROM people WHERE degree IS NOT NULL;");
                $set=false;
                while ($row = $stmt1->fetchArray()) {
                    if($subject->getGarant()===$row['id']) {
                        $stmt->bindParam(4, $subject->getGarant());
                        $stmt->execute();
                        $set = true;
                        break;
                    }
                }
                if($set === true){
                    echo "New subject set, please refresh the page.";
                }
                else{
                    echo "You cannot set student to a garant of a subject, please choose different id.";
                }
            }
            else{
                echo "Something is missing, you cannot insert this subject into a database.";
            }

//            $stmt = $_SESSION['db']->prepare( "INSERT INTO garant_sub(id_g,id_s) VALUES (?,?);");
//            $lastOne = $_SESSION['db']->lastInsertRowID();
//            echo $lastOne;
        }
}

    class Exercise{
        private $needOwnPc;
        public function setPc($needOwnPc){ $this->needOwnPc = $needOwnPc;}
        public function getPc(){ return $this->needOwnPc;}
    }

    //------------------------------------------------

    $subjects = array("Math","English","Physics");

    $studentOne = new Student();
    $studentOne->setFirstName("Leoš");
    $studentOne->setLastName("Brichta");
    $studentOne->setBirth(4,5,2000);
    $studentOne->setEnrollDate(4,8,2000);
    $studentOne->setSubjects($subjects);

    $studentTwo = new Student();
    $studentTwo->setFirstName("Karel");
    $studentTwo->setLastName("Polivka");
    $studentTwo->setBirth(4,5,2000);
    $studentTwo->setEnrollDate(7,9,2020);
    $studentTwo->setSubjects((array)$subjects[0]);
    //$studentTwo->setCredits(20);

    $subjectOne = new Subject();
    $subjectOne->setName("English");
    $subjectOne->setCredits(10);
    $subjectOne->setSemester(2);
    //$subjectOne->setGarant(7);

    $teacherOne = new Teacher();
    $teacherOne->setDegree("Mgr.");

    echo $studentOne->getEnrollDate();
    echo $teacherOne->getDegree();
    $studentOne->getSubjects();
    $studentOne->setCredits(180);
    $studentOne->leave('Math');
    $studentOne->getSubjects();
    $studentOne->getAllStudents();
    $studentOne->getSubjects();
    Subject::getAllSubjectsFromDatabase();
    //Subject::insertSubjectToDatabase($subjectOne);
    //Student::insertStudentToDB($studentTwo);
    //$studentOne->getConcreteStudent('Jan','Kozeluh');
    //Student::deleteStudentFromDB($studentTwo);
    //Person::addPersonSubject(1,7);





    // $db = new SQLite3('oopP.sqlite');
    //$version = $db->querySingle('SELECT SQLITE_VERSION()');
    //echo $version . "\n";
//    $db = new PDO('oopP.sqlite');
//    if($db!=null) {
    //    $stmt = $db->query('SELECT * FROM people');
        //$data = $stmt->fetchAll();
//    while($row = mysqli_fetch_assoc($fetch1)){
//        $array[] = $row;
//    }
    //while ($row = $stmt->fetchArray()) {
//        echo "<tr><td>{$row['id']}</td>
//                  <td>{$row['first_name']}</td>
//                  <td>{$row['last_name']}</td>
//                  <td>{$row['birth']}</td>
//                  <td>{$row['enrollment']}</td>
//                  <td>{$row['credits']}</td>
//                  </tr> \n";
     //   $array[] = $row;
   // }
//    echo "<table>";
//    while ($row = $stmt->fetchArray()) {
//        print '<tr>';
//        print '<td>' . $row['id'] . '</td>';
//        print '<td>' . $row['first_name'] . '</td>';
//        print '<td>' . $row['last_name'] . '</td>';
//        print '</tr>';
//    }
//echo "</table'>";

//    }
//    else{
//        echo "ani to nezkoušej nebo něco rozmláááátím";
//    }

//    if(isset($_POST["submit"])){
//        $studentsFirstName = $_POST["studentsFirstName"];
//        $studentsLastName = $_POST["studentsLastName"];
//        $studentsBirth = $_POST["studentsBirth"];
//        $studentsEnrollment = $_POST["studentsEnrollment"];
//
//
//        if(strlen($studentsFirstName)>0 && strlen($studentsLastName)>0){
//            //$student = array('firstName' => $studentsFirstName,'lastName' => $studentsLastName);
//            //file_put_contents('results.json', json_encode($student), FILE_APPEND | LOCK_EX);
//            //echo $studentsLastNameArray[studentId+1];
//        }
//
//        $newDate = is_string($studentsEnrollment);
//        echo $newDate;
//    }
// destroy the session
session_destroy();
