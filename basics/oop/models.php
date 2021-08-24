<?php
require_once 'db.php';
class Person {
    private $firstName,$lastName,$birth;
    //private array $birth = array();

    public function __construct($firstName,$lastName,$birth){
        $this->firstName=$firstName;
        $this->lastName=$lastName;
        $this->birth=$birth;
//        $this->birth["day"] = $birth[2];
//        $this->birth["month"] = $birth[1];
//        $this->birth["year"] = $birth[0];
    }

    public function getFirstName(){ return $this->firstName;}
    public function getLastName(){ return $this->lastName;}
    public function getBirth(): string{ return $this->birth;}
    //public function getBirth(): string{ return ($this->birth["year"]."/".$this->birth["month"]."/".$this->birth["day"]);}
    /*public function setFirstName($firstName): void{$this->firstName = $firstName;}
    public function setLastName($lastName): void{ $this->lastName = $lastName;}
    public function setBirth($year,$month,$day): void{
        $this->birth["day"] = $day;
        $this->birth["month"] = $month;
        $this->birth["year"] = $year;
    }
    */
}

class Student extends Person{
    private int $credits;
    private string $enrollDate;
    //private array $enrollDate = array();

    public function __construct($firstName, $lastName, $birth, $enrollDate, $credits) {
        parent::__construct($firstName,$lastName,$birth);
//        $this->enrollDate["day"] = $enrollDate[2];
//        $this->enrollDate["month"] = $enrollDate[1];
//        $this->enrollDate["year"] = $enrollDate[0];
        $this->enrollDate=$enrollDate;
        $this->credits=$credits;
    }

    //public function getEnrollDate(): string{ return $this->enrollDate["year"]."/".$this->enrollDate["month"]."/".$this->enrollDate["day"];}
    public function getCredits(): int{ return $this->credits;}
    public function getEnrollDate(): string{ return $this->enrollDate;}

    /*public function setEnrollDate($year,$day,$month): void{
        $this->enrollDate["day"] = $day;
        $this->enrollDate["month"] = $month;
        $this->enrollDate["year"] = $year;
    }
    public function setCredits($credits): void{ $this->credits = $credits;}
    */
}

class Teacher extends Person{
    private string $degree;

    public function __construct($degree,$firstName, $lastName, $birth) {
        parent::__construct($firstName,$lastName,$birth);
        $this->degree=$degree;
    }

    public function getDegree(): string{ return $this->degree;}
    //public function setDegree($degree): void{ $this->degree = $degree;}
}

class Subject{
    private $credits,$semester,$garant,$name,$pc;

    public function __construct($name,$credits,$semester,$garant,$pc){
        $this->name=$name;
        $this->credits=$credits;
        $this->semester=$semester;
        $this->garant=$garant;
        $this->pc=$pc;
    }

    public function getName(){ return $this->name;}
    public function getCredits(){ return $this->credits;}
    public function getSemester(){ return $this->semester;}
    public function getGarant(){ return $this->garant;}
    public function getPc(){ return $this->pc;}

    /*public function setName($name): void{ $this->name = $name;}
    public function setCredits($credits): void{ $this->credits = $credits;}
    public function setSemester($semester): void{ $this->semester = $semester;}
    public function setGarant($garant): void{ $this->garant = $garant;}
    */
}
