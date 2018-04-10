<?php
/* loyalty_procs.php */

include "js/loyalty_globals.inc";

    //$db = "loyaltydb";
    //$con = mysqli_connect("localhost", "root", "");
    mysqli_select_db($con, $db);

if(isset($_POST['phonenumber'])) {
    global $db, $con;
    $p = $_POST['phonenumber'];
    $q = "select * from users where phone = '$p' limit 1";
    $r = mysqli_query($con, $q);
    $c = mysqli_num_rows($r);
    $s="";
    if($c) {
        $a = mysqli_fetch_assoc($r);        
        $i = 0;
        $l = count($a);
        foreach($a as $v ) {
            $s .= $v;
            if($i < $l ) {
                $s .= "|";
            }
            $i++;
        }
        echo $s;
    } else {
        return "";
    }
}  else if(isset($_POST['newuser']) ){  
    $f = $_POST['firstname'];
    $l = $_POST['lastname'];
    $e = $_POST['email'];
    $p = $_POST['phone'];

    $pts = 50;
    
    //echo $f, $l, $e, $p;
    //exit();

    $stmt = $con->prepare("insert into users (firstname,lastname,email,phone,points) values(?,?,?,?,?)");
    $stmt->bind_param("ssssi", $f,$l,$e,$p,$pts);
    $stmt->execute();
    $stmt->close();

    return "ok";
} else {
        return "no data sent";
}
    


?>
 