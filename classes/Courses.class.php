<?php
class Courses
{
    // Variabel för databasanslutning
    private $db;

    public function __construct()
    {
        // Skapar en anslutning till databasen
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        // Skriver ut ev. felmeddelanden
        if ($this->db->connect_errno > 0)
        {
            die("Fel vid anslutning: " . $this->db->connect_error);
        }
    }
    // Hämtar alla kurser
    public function getCourses()
    {
        $sql = "SELECT * FROM `dt173g_mom5_courses`";
        $result = $this->db->query($sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    // Hämtar en specifik kurs beroende på kurskod
    public function getCourse($code)
    {
        $sql = "SELECT * FROM `dt173g_mom5_courses` WHERE `coursecode`='$code'";
        $result = $this->db->query($sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    // Lägger till en ny kurs
    public function addCourse($code, $name, $prog, $plan)
    {
        $sql = "INSERT INTO `dt173g_mom5_courses`(`coursecode`,`coursename`,`courseprog`,`coursesyllabus`) VALUES('$code','$name','$prog','$plan')";
        
        $result = $this->db->query($sql);

        return $result;
    }
    // Tar bort en specifik kurs beroende på kurskod
    public function deleteCourse($code)
    {
        $sql = "DELETE FROM `dt173g_mom5_courses` WHERE `coursecode`='$code'";
        $result = $this->db->query($sql);

        return $result;
    }
    // Uppdaterar en kurs beroende på kurskods
    public function updateCourse($code, $newcode, $newname, $newprog, $newplan)
    {
        $sql = "UPDATE `dt173g_mom5_courses` SET `coursecode`='$newcode',`coursename`='$newname',`courseprog`='$newprog',`coursesyllabus`='$newplan' WHERE `coursecode`='$code'";
        $result = $this->db->query($sql);

        return $result;
    }
}