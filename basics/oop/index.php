<?php

    class Person{
        private $firstName,$lastName;
        private $birth = array();

        public function setFirstName($firstName){ $this->firstName = $firstName;}
        public function getFirstName(){ return $this->firstName;}

        public function setLastName($lastName){ $this->lastName = $lastName;}
        public function getLastName(){ return $this->lastName;}
    
        public function setBirth($day,$month,$year){
            $this->birth["day"] = $day;
            $this->birth["month"] = $month;
            $this->birth["year"] = $year;
        }
        public function getBirth(){ return $this->birth["day"]."/".$this->birth["month"]."/".$this->birth["year"];}    
    }

    //------------------------------------------------

    class Student extends Person{
        private $credits;
        public $subjects = array();

        private $enrollDate = array();
        public function setEnrollDate($day,$month,$year){
            $this->enrollDate["day"] = $day;
            $this->enrollDate["month"] = $month;
            $this->enrollDate["year"] = $year;
        }
        public function getEnrollDate(){ return $this->enrollDate["day"]."/".$this->enrollDate["month"]."/".$this->enrollDate["year"];}
        
        public function setCredits($credits){ $this->credits = $credits;}
        public function getCredits(){ return $this->credits;}
        
        public function leave($subject){
            foreach($this->subjects as $key=>$value){
                if($value == $subject){
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
                // if($value )
                array_push($this->subjects,$value);  
            }
        }

        public function getSubjects(){
            foreach($this->subjects as $value){
                echo $value . " " ; 
            }
        }
    
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
        private $credits,$semester,$garant;
        private $teachers = array();

        public function setCredits($credits){ $this->credits = $credits;}
        public function getCredits(){ return $this->credits;}

        public function setSemester($semester){ $this->semester = $semester;}
        public function getSemester(){ return $this->semester;}

        public function setGarant($firstName,$lastName){ $this->garant = $garant;}
        public function getGarant(){ return $this->firstName . " " . $this->lastName;}
    }

    class Exercise{
        private $needOwnPc;
        public function setPc($needOwnPc){ $this->needOwnPc = $needOwnPc;}
        public function getPc(){ return $this->needOwnPc;}
    }

    //------------------------------------------------

    $subjects = array("Math","English","Physics");
    $subjects = array("Math","English","Physics");

    $studentOne = new Student();
    $studentOne->setBirth(4,5,2000);
    $studentOne->setEnrollDate(4,8,2000);
    $studentOne->setSubjects($subjects);

    $teacherOne = new Teacher();
    $teacherOne->setDegree("Mgr.");

    //var_dump($studentOne->birth);

    echo $studentOne->getEnrollDate();
    echo $teacherOne->getDegree();
    $studentOne->getSubjects();
    $studentOne->setCredits(180);
    $studentOne->leave('Math');
    $studentOne->getSubjects();

    
    /*
    $end = false;
    while($end == false){
        $wantToCreate = readline();
        if(strtolower($wantToCreate) == "Teacher"){
            echo "LLL";
        }elseif(strtolower($wantToCreate) == "Student"){
            echo "NIc";
        }
    }
    Asi sem narvu formuláře, pro základní user input readline() mi moc nefungovalo.
    */
