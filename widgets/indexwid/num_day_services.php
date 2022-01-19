

<?php
if(is_logged_in()) {
    if (isset($_GET['ses_day'])) {
        $ses_day = $_GET['ses_day'];
    } else {
        $ses_day = date("Y-m-d", time());
    }

    $services = num_day_services($cn, $ses_day);
    arsort($services);
    foreach ($services as $serv => $num) {
        echo "<tr>";
        echo "<td> (" . $serv . ") sessions:</td>";
        echo "<td>" . $num . "</td>";
        echo "</tr>";
    }
}

?>




