

<?php
    $month=date("Y-m", time());
    $services=num_month_services($cn,$month);
    arsort($services);
    foreach ($services as $serv => $num){
        echo "<tr>";
            echo "<td>".date("F",time())." (".$serv.") sessions:</td>";
            echo "<td>".$num."</td>";
        echo"</tr>";
    }

?>




