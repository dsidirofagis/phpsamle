<?php

//$john = new Student("John","Smith");

$jane = new Student("Jane","Jones",20,"Female");

//$john->name="John";
//$john->surname="Smith";

var_dump($jane);

//echo ($jane);

echo "<br>Hello my name is: ".$jane->GetName();

//echo $jane->Report();

$jane->SetName("");

echo "<br>New name is: ".$jane->GetName();

$jane->SetGender("");

echo "<br>Gender : ".$jane->GetGender();

$jane->SetDOB(24,3,1924);

var_dump(explode("/",$jane->GetDOB()));

echo "<br>Date of Birth : ".$jane->GetDOB();

echo "<br>Age : ".$jane->GetAge()." years old";

echo "<hr>";

include_once("class_date.php");


$date=new Date(01,10,2017);

echo $date->GetDate();


class Student
{
    protected $name;
    protected $surname;
    protected $dob;
    protected $gender;


/*    //magic method
    function __construct($name, $surname)
    {
        $this->name=$name;
        $this->surname=$surname;
    }
*/

    //constructor overload via magic method!!
    function __construct($name, $surname, $gender)
    {
        $this->name=$name;
        $this->surname=$surname;
        $this->gender=$gender;
    }

    public function GetName()
    {
        return $this->name;
    }

    public function SetName($name)
    {
        if (self::validate_input($name) and is_string($name))
        {
            $this->name = $name;
            return true;
        }
        return false;
    }

    public function GetSurname()
    {
        return $this->surname;
    }

    public function SetSurname($surname)
    {
        if (self::validate_input($surname) and is_string($surname))
        {
            $this->surname = $surname;
            return true;
        }
        return false;
    }

    public function GetGender()
    {
        return $this->gender;
    }

    public function SetGender($gender)
    {
        if (self::validate_input($gender) and (strtolower($gender) == 'male' or strtolower($gender)== 'female'))
        {
            $this->gender = strtolower($gender);
            return true;
        }
        return false;
    }

    public function GetDOB()
    {
        return $this->dob;
    }

    public function SetDOB($dd,$mm,$yyyy)
    {
        if (self::validate_input($dd) or self::validate_input($mm) or self::validate_input($yyyy))
        {
            if(is_int($dd) and ($dd > 0 or $dd < 32) )
            {
                if (is_int($mm) and ($mm > 0 or $dd < 13))
                {
                    if (is_int($yyyy) and ($yyyy > 1900 or $yyyy < 2100))
                    {
                        $this->dob = $dd . "/" . $mm . "/" . $yyyy;
                    }
                }
            }
        }
        return false;
    }

    public function GetAge()
    {
        $date_array = explode("/",$this->GetDOB());
        $current_date=getdate();
        return $current_date['year']-$date_array[2];
    }

    public function GetFullName()
    {
        return $this->name." ".$this->surname;
    }

    public function Report()
    {
        var_dump(get_defined_functions());
    }

    protected function validate_input($input)
    {
        if (!empty($input) and str_replace(" ","",$input)) return true;

        return false;
    }

    public function __toString()
    {
        return $this->SayName()." ".$this->gender;
    }

}

?>