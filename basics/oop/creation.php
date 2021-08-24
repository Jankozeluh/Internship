<?php
require_once "models.php";

class StudentsFactory{
    public static function createBjergsen():Student{return new Student('Soren','Bjerg', array(1996,2,21),array(2010,6,2),20);}
    public static function createFaker():Student{return new Student('Lee','Sang-hjok', array(1996,5,7),array(2017,4,8),102/*6*/);}
    public static function createMithy():Student{return new Student('Alfonso','Rodriguez', array(1994,10,5),array(2016,3,22),55);}
    public static function createDoublelift():Student{return new Student('Yiliang','Peng', array(1993,7,19),array(2019,10,9),28);}
    public static function createFreeze():Student{return new Student('Ales','Knezinek', array(1994,6,6),array(2020,10,11),27);}
}

class SubjectsFactory{
    public static function createMath(): Subject{return new Subject('Math',4, 2,1,1);}
    public static function createHistory(): Subject{return new Subject('History',6, 1,10,2);}
    public static function createGeography(): Subject{return new Subject('Geography',7, 2,7,1);}
    public static function createArt(): Subject{return new Subject('Art',5, 2,3,1);}
}

class TeachersFactory{
    public static function createHolly(): Teacher{return new Teacher('MFA.','Holly', 'Holm',array(1976,2,5));}
    public static function createKarel(): Teacher{return new Teacher('PhD.','Karel', 'Vavra',array(1956,7,8));}
    public static function createPaul(): Teacher{return new Teacher('MD.','Paul', 'Horak',array(1986,12,6));}
    public static function createAlbert(): Teacher{return new Teacher('MS.','Albert', 'Klokocka',array(1944,10,13));}
    public static function createBilly(): Teacher{return new Teacher('BAS.','Billy', 'Farmer',array(1982,1,30));}
}

//$StudentsFactory = new StudentsFactory();
//$TeachersFactory = new TeachersFactory();
//$SubjectsFactory = new SubjectsFactory();
//
//$Bjergsen = $StudentsFactory::createBjergsen();
//$Faker = $StudentsFactory::createFaker();
//$Mithy = $StudentsFactory::createMithy();
//$Doublelift = $StudentsFactory::createDoublelift();
//$Freeze = $StudentsFactory::createFreeze();
//$Holly = $TeachersFactory::createHolly();
//$Albert = $TeachersFactory::createAlbert();
//$Billy = $TeachersFactory::createBilly();
//$Karel = $TeachersFactory::createKarel();
//$Paul = $TeachersFactory::createPaul();
//
//$Math = $SubjectsFactory::createMath();
//$History = $SubjectsFactory::createHistory();
//$Geography = $SubjectsFactory::createGeography();
//$Art = $SubjectsFactory::createArt();

$Lukas = new Teacher('BA.','Lukas','Topol','2021/08/19');

echo '<div class="container px-4 py-3"><div class="row"><div class="col-sm">';
    Action::getStudents();
echo '</div><div class="col-sm">';
    Action::getTeachers();
echo '</div><div class="col-sm">';
    Action::getSubjects();
echo '</div></div></div>';
//Action::insertSubjectToPerson($Lukas,'Art',35,5);
