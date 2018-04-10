<?php
/* loyalty_procs.php */
 

include "loyalty_globals.inc";
mysqli_select_db($con, $db);

if( isset($_REQUEST['addnewpoints']) && $_REQUEST['addnewpoints'] != "0") {

    global $db, $con;
    $p = $_REQUEST['phone'];
    $q = "select points, email, logins from users where phone = '$p' limit 1";
    $r = mysqli_query($con, $q);
    $a = mysqli_fetch_assoc($r); 
    $pts = $a['points'] + 20;
    $logins = $a['logins'] + 1;
    $t = intval($_REQUEST['timestamp']);
    $q = "update users set logins='$logins', lastlogin='$t', points='$pts' where phone = '$p'";
    $r = mysqli_query($con, $q);

    $to      = $a['email'];
    $subject = "You've earned anther 20 points!";
    $message = "Congratulations!\n\nYou've earned 20 more points!";
    $headers = "From: <noreply>@trybaker.com" . "\r\n" .
        "Reply-To: <noreply>@trybaker.com" . "\r\n" .
        "X-Mailer: PHP/" . phpversion();
    if($DEVELOPMENT) {error_reporting(0);}
    mail($to, $subject, $message, $headers);
    if($DEVELOPMENT) {error_reporting(E_ALL & ~E_NOTICE);}
    echo $pts;
   
}  else if(isset($_REQUEST['newuser']) ){  
    $f = $_REQUEST['firstname'];
    $l = $_REQUEST['lastname'];
    $e = $_REQUEST['email'];
    $p = $_REQUEST['phone'];
    $t = intval($_REQUEST['timestamp']);
    $pts = 50;

    $stmt = $con->prepare("insert into users (firstname,lastname,email,phone,points,lastlogin) values(?,?,?,?,?,?)");
    $stmt->bind_param("ssssii", $f,$l,$e,$p,$pts,$t);
    $stmt->execute();
    $stmt->close();

    $to      = $e;
    $subject = "You've earned anther 20 points!";
    $message = "Congratulations!\n\nYou've earned your first 50 points!";
    $headers = "From: <noreply>@trybaker.com" . "\r\n" .
        "Reply-To: <noreply>@trybaker.com" . "\r\n" .
        "X-Mailer: PHP/" . phpversion();
    
    if($DEVELOPMENT) {error_reporting(0);}
    mail($to, $subject, $message, $headers);
    if($DEVELOPMENT) {error_reporting(E_ALL & ~E_NOTICE);}

    return "ok";
} else if(isset($_REQUEST['phone'])) {
    global $db, $con;
    $p = $_REQUEST['phone'];
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
} else {
        return "no data sent";
}   


?>
 