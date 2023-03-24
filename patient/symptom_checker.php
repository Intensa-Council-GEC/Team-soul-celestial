<?php
// Define an array of symptoms and associated conditions
$symptoms = array(
    'Fever' => array('Flu', 'COVID-19', 'Malaria'),
    'fever' => array('Flu', 'COVID-19', 'Malaria'),
    'Cough' => array('Flu', 'COVID-19', 'Pneumonia'),
    'cough' => array('Flu', 'COVID-19', 'Pneumonia'),
    'Headache' => array('Migraine', 'Tension headache', 'Sinusitis'),
    'headache' => array('Migraine', 'Tension headache', 'Sinusitis'),
    'Nausea' => array('Food poisoning', 'Gastroenteritis', 'Migraine'),
    'nausea' => array('Food poisoning', 'Gastroenteritis', 'Migraine'),
    'Fatigue' => array('Flu', 'COVID-19', 'Anemia'),
    'fatigue' => array('Flu', 'COVID-19', 'Anemia'),
    'Sore throat' => array('Flu', 'COVID-19', 'Strep throat'),
    'sore throat' => array('Flu', 'COVID-19', 'Strep throat'),
    'Shortness of breath' => array('COVID-19', 'Pneumonia', 'Asthma'),
    'shortness of breath' => array('COVID-19', 'Pneumonia', 'Asthma')
);

// Get the symptoms from the form submission
$symptoms_str = $_POST['symptoms'];

// Split the symptoms into an array
$symptoms_arr = explode("\n", $symptoms_str);

// Loop through the symptoms and find the associated conditions
$conditions = array();
foreach ($symptoms_arr as $symptom) {
    $symptom = trim($symptom);
    if (array_key_exists($symptom, $symptoms)) {
        $conditions = array_merge($conditions, $symptoms[$symptom]);
    }
}

// Remove duplicate conditions and sort alphabetically
$conditions = array_unique($conditions);
sort($conditions);


// Display the diagnosis results

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Symptom checker</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="./symptom.css">
    <link rel="stylesheet" href="../css/st1.css">
</head>

<body>
    <div class="nav1">
        <a href="#" class="logo">myhealthcompass</a>
        <ul>
            <li><a href="./home.php">home</a></li>
            <li><a href="./profile.php">Profile</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="content contt ss">
        <div class="sss">


            <?php
            echo '<h2>Diagnosis Results:</h2><div class="triple">';

            if (empty($conditions)) {
                echo '<p>No conditions found based on the symptoms entered.</p>';
            } else {
                echo '<ul>';
                foreach ($conditions as $condition) {
                    echo '<li>' . $condition . '</li>';
                }
                echo '</ul></div>';
            }
            ?>


        </div>
    </div>
    <script type="text/javascript">
        window.addEventListener("scroll", function() {
            var nav = document.querySelector(".nav1");
            nav.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
</body>

</html>