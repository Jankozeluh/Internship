<?php
require_once 'db.php';
class Person {
    private $firstName,$lastName;
    private $birth = array();

    public function setFirstName($firstName): void{$this->firstName = $firstName;}
    public function getFirstName(){ return $this->firstName;}

    public function setLastName($lastName): void{ $this->lastName = $lastName;}
    public function getLastName(){ return $this->lastName;}

    public function setBirth($year,$month,$day): void{
        $this->birth["day"] = $day;
        $this->birth["month"] = $month;
        $this->birth["year"] = $year;
    }
    public function getBirth(): string{ return ($this->birth["year"]."/".$this->birth["month"]."/".$this->birth["day"]);}
}

class Student extends Person{
    private int $credits;
    private $enrollDate = array();

    public function setEnrollDate($year,$day,$month): void{
        $this->enrollDate["day"] = $day;
        $this->enrollDate["month"] = $month;
        $this->enrollDate["year"] = $year;
    }
    public function getEnrollDate(){ return $this->enrollDate["year"]."/".$this->enrollDate["month"]."/".$this->enrollDate["day"];}

    public function setCredits($credits): void{ $this->credits = $credits;}
    public function getCredits(){ return $this->credits;}
}

class Teacher extends Person{
    private $degree;
    public function setDegree($degree): void{ $this->degree = $degree;}
    public function getDegree(){ return $this->degree;}
}

class Subject{
    private $credits,$semester,$garant,$name;

    public function setName($name): void{ $this->name = $name;}
    public function getName(){ return $this->name;}

    public function setCredits($credits): void{ $this->credits = $credits;}
    public function getCredits(){ return $this->credits;}

    public function setSemester($semester): void{ $this->semester = $semester;}
    public function getSemester(){ return $this->semester;}

    public function setGarant($garant): void{ $this->garant = $garant;}
    public function getGarant(){ return $this->garant;}
}
