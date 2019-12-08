
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ssdu2";

//Define variables
$name = $lastname = $number = $average = "";

//ir
//validation
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  // Name
  if (empty($_POST["name"])) //patikrina ar vardas yra tuscias
  {
    echo "Name is required<br />";
    exit();// Jei Suvedama netinkama informacija, sustabdoma programa ir parasoma jos priezastis
    //header("Location: S_SDU2html.html"); // jei laukelis tuscias ismeta atgal i homepage
  } 
  else 
   {
     $name = test_input($_POST["name"]);
     // Patikrina ar vardas turi tik raides
     if (!preg_match("/^[a-zA-Z]*$/",$name))
        {
        echo "Only Letters allowed<br />";
        exit();
        }
   }
   //Lastname
   if (empty($_POST["lastname"])) //patikrina ar pavarde yra tuscia
  {
    echo "lastName is required<br />";
    exit();
  } 
  else 
   {
     $name = test_input($_POST["lastname"]);
     // Patikrina ar vardas turi tik raides
     if (!preg_match("/^[a-zA-Z]*$/",$lastname))
        {
        echo "Only Letters allowed<br />";
        exit();
        }
   }
   //Number
   if (empty($_POST["number"])) //patikrina ar numeris yra tuscia
  {
    echo "number is required<br />";
    exit();
  } 
  else 
   {
     $number = test_input($_POST["number"]);
     // Patikrina ar numeris turi tik raides
     if (!preg_match("/^[1-200]*$/",$number))
        {
        echo "Only number from 1 to 200 allowed<br />";
        exit();
        }
   }
   //Average
   if (empty($_POST["average"])) //patikrina ar vidurkis yra tuscia
  {
    echo "average is required<br />";
    exit();
  } 
  else 
   {
     $average = test_input($_POST["average"]);
     // Patikrina ar vardas turi tik raides
     if (!preg_match("/^[0.0-10.0]*$/",$average))
        {
        echo "Only float numbers allowed<br />";
        exit();
        }
   }

}

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Duomenu irašymas i db
$sql = "INSERT INTO ssdu21 (Studpavarde, Studvardas, Numeris, Pazvidurkis)
VALUES ('$name', '$lastname', '$number', '$average')";

//Duomenu irašymo patvirtinimas
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully<br />";
    echo "used by ";
    echo get_current_user();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$conn->close();
