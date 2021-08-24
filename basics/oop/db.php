<?php
session_start();
$_SESSION['db'] = databaseConnection::getInstance()->getConnection();
$_SESSION['db']->exec("
    CREATE TABLE IF NOT EXISTS people (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        degree TEXT,
        first_name TEXT NOT NULL,
        last_name TEXT NOT NULL,
        birth TEXT NOT NULL,
        enrollment TEXT,
        credits INTEGER
    );
    CREATE TABLE IF NOT EXISTS subject(
        id INTEGER UNIQUE PRIMARY KEY AUTOINCREMENT,
        name TEXT UNIQUE NOT NULL,
        credits INTEGER NOT NULL,
        semester INTEGER NOT NULL,
        garant INTEGER NOT NULL,
        pc INTEGER NOT NULL,
        FOREIGN KEY(garant) REFERENCES people(id)
    );
    CREATE TABLE IF NOT EXISTS people_sub(
        id_p INTEGER NOT NULL,
        id_s INTEGER NOT NULL,
        lecture INTEGER,
        exercise INTEGER,
        FOREIGN KEY(id_s) REFERENCES subject(id),
        FOREIGN KEY(id_p) REFERENCES people(id)
);");

class databaseConnection
{
    private static $instance = null;
    private $conn;

    private function __construct()
    {
        $this->conn = new SQLite3('oopP.sqlite');
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new databaseConnection();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}

class Action
{
    public static function insertPerson(object $obj): void
    {
        if ($obj->getFirstName() !== null && $obj->getLastName() !== null && $obj->getBirth() !== "//") {
            if (($obj instanceof \Student) && $obj->getCredits() !== null && $obj->getEnrollDate() !== "//") {
                $stmt = $_SESSION['db']->prepare("INSERT INTO people(first_name,last_name,birth,enrollment,credits) VALUES (?,?,?,?,?);");
                self::studentBind($stmt, $obj);
                echo("[STUDENT " . $obj->getFirstName() . " WAS SET]");
            } elseif ($obj instanceof \Teacher && $obj->getDegree() !== null) {
                //echo($obj->getDegree() . " " . $obj->getFirstName() . " " . $obj->getLastName() . " " . $obj->getBirth());
                $stmt1 = $_SESSION['db']->prepare("INSERT INTO people(degree,first_name,last_name,birth) VALUES (?,?,?,?);");
                self::teacherBind($stmt1, $obj);
                echo("[TEACHER " . $obj->getFirstName() . " WAS SET]");
            } else {
                echo("!Instance of object has been rejected, because you probably dont set right/all parameters!");
            }
        } else {
            echo("!First/Last name or birthday cannot be set for neither Student or Teacher!");
        }
    }
    public static function insertSubject(object $obj): void
    {
        if ($obj instanceof \Subject) {
            $stmt = $_SESSION['db']->prepare("INSERT INTO subject(name,credits,semester,garant,pc) VALUES (?,?,?,?,?);");
            if ($obj->getName() !== null && $obj->getCredits() !== null && $obj->getSemester() !== null && $obj->getGarant() !== null && $obj->getPc() !== null) {
                $stmt->bindParam(1, $obj->getName());
                $stmt->bindParam(2, $obj->getCredits());
                $stmt->bindParam(3, $obj->getSemester());
                $stmt->bindParam(5, $obj->getPc());
                $stmt1 = $_SESSION['db']->query("SELECT id FROM people WHERE degree IS NOT NULL;");
                while ($row = $stmt1->fetchArray()) {
                    if ($obj->getGarant() === $row['id']) {
                        $stmt->bindParam(4, $obj->getGarant());
                        $stmt->execute();
                        echo "[NEW SUBJECT " . $obj->getName() . " SET]";
                        break;
                    }
                }
            } else {
                echo "!Something is missing, you cannot insert this subject into a database.!";
            }
        }
    }
    public static function insertSubjectToPerson($id, $subject, $lecture = null, $exercise = null): void
    {
        if ($id !== null && $subject !== null) {
            if ($lecture !== null && $exercise !== null) {
                $stmt = $_SESSION['db']->prepare("INSERT INTO people_sub(id_p,id_s,lecture,exercise) VALUES(?,?,?,?);");
                $stmt->bindParam(1, $id);
                $stmt->bindParam(3, $lecture);
                $stmt->bindParam(4, $exercise);
                self::stmt2($subject, $stmt);
            } elseif ($lecture === null && $exercise === null) {
                $stmt = $_SESSION['db']->prepare("INSERT INTO people_sub(id_p,id_s) VALUES(?,?);");
                $stmt->bindParam(1, $id);
                self::stmt2($subject, $stmt);
            }
        }
    }

    public static function leave($id): void
    {
        if ($id !== null) {
            $stmt = $_SESSION['db']->prepare("DELETE FROM people WHERE id=? AND degree IS NULL;");
            $stmt->bindParam(1, $id);
            $stmt->execute();
        } else {
            echo "! This id does not exits !";
        }
    }
    public static function leaveSubject($id_stu, $id_sub): void
    {
        $stmt = $_SESSION['db']->prepare("SELECT id_p,id_s FROM subject join people_sub ps on subject.id = ps.id_s join subject s on s.id = ps.id_s WHERE ps.id_p=? AND ps.id_s=?;");
        $stmt->bindParam(1, $id_stu);
        $stmt->bindParam(2, $id_sub);
        $tt = $stmt->execute();
        while ($row = $tt->fetchArray()) {
            if ($id_stu === $row['id_p'] && $id_sub === $row['id_s']) {
                $stmt1 = $_SESSION['db']->prepare("DELETE FROM people_sub WHERE id_p=? AND id_s=? AND lecture IS NULL AND exercise IS NULL ;");
                $stmt1->bindParam(1, $id_stu);
                $stmt1->bindParam(2, $id_sub);
                $stmt1->execute();
                echo "LEFT SUCCESSFULLY";
                break;
            }
        }
    }
    public static function deleteSubject($id): void
    {
        if ($id !== null) {
            $stmt = $_SESSION['db']->prepare("DELETE FROM subject WHERE id = ?;");
            $stmt->bindParam(1, $id);
            $stmt->execute();
        } else {
            echo "!Set a proper subject name as a parameter!";
        }
    }
    public static function deletePerson($id): void
    {
        if ($id !== null) {
            $stmt = $_SESSION['db']->prepare("DELETE FROM people WHERE id = ?;");
            $stmt->bindParam(1, $id);
            $stmt->execute();
        } else {
            echo "!Set a proper person id as a parameter!";
        }
    }
    public static function endSubjectProperly($id): void
    {
        if ($id !== null) {
            $query1 = $_SESSION["db"]->prepare('SELECT s.name, people.id, s.credits FROM people join people_sub ps on people.id = ps.id_p join subject s on s.id = ps.id_s WHERE s.id=? AND degree IS NULL;');
            self::extracted($query1, $id);
            $stmt1 = $_SESSION['db']->prepare("DELETE FROM subject WHERE id = ?;");
            $stmt1->bindParam(1, $id);
            $stmt1->execute();
            echo("[SUBJECT WAS PROPERLY ENDED]");
        } else {
            echo "!Set a proper subject name as a parameter!";
        }
    }

    public static function getPeopleSelector($name): void
    {
        $query = $_SESSION["db"]->query('SELECT * FROM people;');
        echo "<select name='".$name."' required>";
        while ($row = $query->fetchArray()) {
            echo '<option value="' . $row['id'] . '">' . $row['degree'] . " " . $row['first_name'] . " " . $row['last_name'] . "</option>";
        }
        echo "</select>";
    }
    public static function getTeachersSelector($name): void
    {
        $query = $_SESSION["db"]->query('SELECT * FROM people WHERE credits IS NULL;');
        echo "<select name='".$name."' required>";
        while ($row = $query->fetchArray()) {
            echo '<option value="' . $row['id'] . '">' . $row['first_name'] . " " . $row['last_name'] . "</option>";
        }
        echo "</select>";
    }
    public static function getStudentsSelector($name): void
    {
        $query = $_SESSION["db"]->query('SELECT * FROM people WHERE credits IS NOT NULL;');
        echo "<select name='".$name."' required>";
        while ($row = $query->fetchArray()) {
            echo '<option value="' . $row['id'] . '">' . $row['first_name'] . " " . $row['last_name'] . "</option>";
        }
        echo "</select>";
    }
    public static function getSubjectsSelector($name): void
    {
        $query = $_SESSION["db"]->query('SELECT * FROM subject;');
        echo "<select name='".$name."' required>";
        while ($row = $query->fetchArray()) {
            echo '<option value="' . $row['id'] . '">' . $row['name']."</option>";
        }
        echo "</select>";
    }
    public static function getSubjects(): void
    {
        $query = $_SESSION["db"]->query('SELECT subject.id, subject.name, subject.credits, subject.semester, subject.garant, subject.pc,p.degree, p.first_name, p.last_name from subject join people p on p.id = subject.garant;');
        echo "<table style='border: 1px solid black;text-align: center;' class='table table-hover table-sm'><h3>SUBJECTS</h3>";
        print ' <thead><tr><th>ID</th><th>Subject name</th><th>Credits</th><th>Semester</th><th>Garant</th><th>Teachers</th><th>Own pc for exercises</th></tr></thead><tbody>';
        while ($row = $query->fetchArray()) {
            print '<tr>';
            print '<td>' . $row['id'] . '</td>';
            print '<td>' . $row['name'] . '</td>';
            print '<td>' . $row['credits'] . '</td>';
            print '<td>' . $row['semester'] . '</td>';
            print '<td>' . $row['degree'] . $row['first_name'] . " " . $row['last_name'] . '</td><td>';
            $query1 = $_SESSION["db"]->prepare('SELECT degree, first_name, last_name, exercise,lecture FROM people join people_sub ps on people.id = ps.id_p join subject s on s.id = ps.id_s WHERE s.id=? AND degree IS NOT NULL;');
            $query1->bindValue(1, $row['id']);
            $res = $query1->execute();
            while ($row1 = $res->fetchArray()) {
                echo $row1['degree'] . $row1['first_name'] . $row1['last_name'] . "(" . $row1['lecture'] . "/" . $row1['exercise'] . "),";
            }
            if ($row['pc'] === 1) {
                echo '</td><td>YES</td></tr>';
            } else {
                echo '</td><td>NO</td></tr>';
            }
        }
        echo "</tbody></table>";
    }
    public static function getStudents(): void
    {
        $query = $_SESSION["db"]->query('SELECT * FROM people WHERE degree IS NULL;');
        self::getStudentsBase($query);
    }
    public static function getTeachers(): void
    {
        $query = $_SESSION["db"]->query('SELECT * FROM people WHERE degree IS NOT NULL;');
        echo "<table style='border: 1px solid black;text-align: center;' class='table table-hover table-sm'><h3>TEACHERS</h3>";
        echo "<th>ID</th><th>Degree</th><th>First name</th><th>Last name</th><th>Birth</th><th>Subjects(n.of lectures/exercises)</th>";
        while ($row = $query->fetchArray()) {
            echo '<tr><td>' . $row['id'] . '</td>';
            echo '<td>' . $row['degree'] . '</td>';
            self::personRow($row);
            echo "<td>";
            $query1 = $_SESSION["db"]->prepare('SELECT name, lecture ,exercise FROM people join people_sub ps on people.id = ps.id_p join subject s on s.id = ps.id_s WHERE people.id=? AND degree IS NOT NULL;');
            $query1->bindValue(1, $row['id']);
            $res = $query1->execute();
            while ($row1 = $res->fetchArray()) {
                echo $row1['name'] . "(" . $row1['lecture'] . "/" . $row1['exercise'] . "),";
            }
            echo '</td></tr>';
        }
        echo "</table>";
    }
    public static function getStudentsDescById(): void
    {
        $query = $_SESSION["db"]->query('SELECT * FROM people WHERE degree IS NULL ORDER BY id DESC;');
        self::getStudentsBase($query);
    }
    public static function getStudentsAZByLastName(): void
    {
        $query = $_SESSION["db"]->query('SELECT * FROM people WHERE degree IS NULL ORDER BY last_name;');
        self::getStudentsBase($query);
    }

    /**
     * @param $row
     */
    private static function personRow($row): void
    {
        echo '<td>' . $row['first_name'] . '</td>';
        echo '<td>' . $row['last_name'] . '</td>';
        echo '<td>' . $row['birth'] . '</td>';
    }
    /**
     * @param $subject
     * @param $stmt
     */
    private static function stmt2($subject, $stmt): void
    {
        $stmt2 = $_SESSION['db']->query("SELECT * FROM subject;");
        while ($row = $stmt2->fetchArray()) {
            if ($subject === $row['name']) {
                $stmt->bindParam(2, $row['id']);
                $stmt->execute();
                echo "[SUBJECT " . $subject . " WAS INSERTED TO A PROPER PERSON YOU SPECIFIED]";
                break;
            }
        }
    }
    /**
     * @param $stmt
     * @param $obj
     */
    private static function studentBind($stmt, $obj): void
    {
        $stmt->bindParam(1, $obj->getFirstName());
        $stmt->bindParam(2, $obj->getLastName());
        $stmt->bindParam(3, $obj->getBirth());
        $stmt->bindParam(4, $obj->getEnrollDate());
        $stmt->bindParam(5, $obj->getCredits());
        $stmt->execute();
    }
    /**
     * @param $stmt1
     * @param $obj
     */
    private static function teacherBind($stmt1, $obj): void
    {
        $stmt1->bindParam(1, $obj->getDegree());
        $stmt1->bindParam(2, $obj->getFirstName());
        $stmt1->bindParam(3, $obj->getLastName());
        $stmt1->bindParam(4, $obj->getBirth());
        $stmt1->execute();
    }
    /**
     * @param $query
     */
    private static function getStudentsBase($query): void
    {
        echo "<table style='border: 1px solid black;text-align: center;' class='table table-hover table-sm'><h3>STUDENTS</h3>";
        echo "<th>ID</th><th>First name</th><th>Last name</th><th>Birth</th><th>Enrollment</th><th>Credits(finish studies?)</th><th>Subjects</th>";
        while ($row = $query->fetchArray()) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            self::personRow($row);
            echo '<td>' . $row['enrollment'] . '</td>';
            if ($row['credits'] >= 80) {
                echo '<td>' . $row['credits'] . " (Can)" . '</td><td>';
            } else {
                echo '<td>' . $row['credits'] . " (Cannot)" . '</td><td>';
            }
            $query1 = $_SESSION["db"]->prepare('SELECT name FROM people join people_sub ps on people.id = ps.id_p join subject s on s.id = ps.id_s WHERE people.id=? AND degree IS NULL;');
            $query1->bindValue(1, $row['id']);
            $res = $query1->execute();
            while ($row1 = $res->fetchArray()) {
                echo $row1['name'] . ",";
            }
            echo '</td></tr>';
        }
        echo "</table>";
    }
    /**
     * @param $query1
     * @param $id
     */
    private static function extracted($query1, $id): void
    {
        $query1->bindValue(1, $id);
        $res = $query1->execute();
        $stmt = $_SESSION['db']->prepare("UPDATE people SET credits = credits+? WHERE degree IS NULL AND people.id=?;");
        while ($row1 = $res->fetchArray()) {
            $stmt->bindValue(1, $row1['credits']);
            $stmt->bindValue(2, $row1['id']);
            $stmt->execute();
        }
    }

}
