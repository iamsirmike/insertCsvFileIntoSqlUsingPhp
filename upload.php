<?php
$con = mysqli_connect("localhost", "root", "", "tut");
if ($con) {
    $file = $_FILES['csvfile']['tmp_name'];
    $handle = fopen($file, "r");
    $i = 0;
    while (($cont = fgetcsv($handle, 1000, ",")) !== false) {
        $table = 'stud_results';
        if ($i == 0) {

            $student_id = $cont[0];
            $level = $cont[1];
            $semester = $cont[2];
            $courses = $cont[3];
            $grades = $cont[4];
            $cgpa = $cont[5];
            $sgpa = $cont[6];

            $query = "CREATE TABLE $table ($student_id VARCHAR(50), $level VARCHAR(50), $semester VARCHAR(50), $courses VARCHAR(50), $grades VARCHAR(50), $cgpa VARCHAR(50), $sgpa VARCHAR(50));";

            mysqli_query($con, $query);
        } else {
            $query = "INSERT $table ($student_id, $level, $semester, $courses, $grades, $cgpa, $sgpa) VALUES ('$cont[0]', '$cont[1]', '$cont[2]','$cont[3]','$cont[4]','$cont[5]','$cont[6]');";

            echo "<script type='text/javascript'>alert('Upload successful');window.location.href='index.php';</script>";
            mysqli_query($con, $query);
        }
        $i++;

    }


}

?>