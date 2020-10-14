<?php
include("includes/config.php");

// 
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, DELETE, PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

// Instancerar klassen där databasanslutning och funktioner för att hantera databasen finns
$Courses = new Courses();




// Kollar mot GET-metoden ifall det finns en parameter 'code', och ifall den finns sparas den i en variabel
if (isset($_GET['code'])) {
    $code = $_GET['code'];
}
// Variabel som lagrar metoden som används vid anrop
$method = $_SERVER['REQUEST_METHOD'];
// Sats som styr vad som händer vid en viss metod
switch ($method) {
// Hämta kurser
    case "GET":
        // Finns parametern code, hämtas enbart en specifik kurs
        if (isset($code)) {
            if(count($Courses->getCourse($code)) > 0){
                $result = $Courses->getCourse($code)[0];
            }else{
                // Felmeddelande ifall ingen kurskod med den specifika kurskoden hittas
                $result = array("message" => "No course with coursecode " . $code . " could be found.");
            }
        } else {
            if(count($Courses->getCourses()) > 0){
                $result = $Courses->getCourses();
            }else{
                $result = array("message" => "No courses found.");
            }
        }
        break;
// Redigera kurser
    case "PUT":
        // Hanterar en body i JSON-format, då data ska skickas med från den som gör anropet.
        $input = json_decode(file_get_contents('php://input'));
        if($Courses->getCourse($code) == null){
            $result = array("message" => "No course with specified code could be found.");
        }else{
            // Uppdaterar kurs med nya värden
            if($Courses->updateCourse($code, $input->coursecode, $input->coursename, $input->courseprog, $input->coursesyllabus)){
                http_response_code(200);
                $result = array("message" => "Course updated.");
            }else{
                http_response_code(503);
                $result = array("message" => "Course could not be updated.");
            }
        }

        break;
// Lägga till kurser
    case "POST":
        // Hanterar en body i JSON-format, då data ska skickas med från den som gör anropet.
        $input = json_decode(file_get_contents('php://input'));
        $result = $input;
        // Datan från den som gjorde anropet hanteras och kurs skapas ifall datan är korrekt.
        if ($Courses->addCourse($input->coursecode, $input->coursename, $input->courseprog, $input->coursesyllabus)) {
            http_response_code(201);
            $result = array("message" => "Course added.");
        } else {
            http_response_code(503);
            $result = array("message" => "Course could not be added.");
        }
        break;
// Ta bort kurs
    case "DELETE":
        // Är ingen parameter satt är ingen kurs specifierad att tas bort.
        if(!isset($code)){
            $result = array("message" => "No coursecode has been specified.");
        }else{
            // Tar bort kurs enligt det som är angivet i parametern i adressen.
            if($Courses->deleteCourse($code)){
                http_response_code(200);
                $result = array("message" => "Course deleted.");
            }else{
                http_response_code(503);
                $result = array("message" => "Course could not be deleted.");
            }
        }
        break;
}

// Skriver ut resultatet av anropet i JSON-format till webbläsaren.
echo json_encode($result);
