<?php
function protectPass($password){
	//this function utilises bcrypt to hash the password for security
	$hashedPass = password_hash($password, PASSWORD_DEFAULT);
	return $hashedPass;
}

function login($email, $password, $rdr=""){
	include("connect.php");
    
	$email = sanitizeInput($email);
	$password = sanitizeInput($password);
	if($email=='' || $password==''){
		header('location:index.php'); exit();
	}
		//now go ahead with database verification of password
		$query = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($link, $query);
		 while($row = mysqli_fetch_assoc($result)){
		$hashed_p[] = $row['pass'];
         }
if(password_verify($password, @$hashed_p[0])){
			$sqlog = "SELECT * FROM users WHERE email='$email'";
    $querylog = mysqli_query($link, $sqlog, $link);
    while($fchlog = mysqli_fetch_assoc($querylog)){
        
        $id[]= $fchlog["id"];
    }
     $_SESSION['uid']= $id[0];
         $_SESSION['eml']= $email;
    
    /*
		setcookie("uid", $id[0], time() + (86400 * 30), "/");
        setcookie("eml", $email, time() + (86400 * 30), "/");
    
    //Log activity
        include_once("activitylog.php");
            log_activity($id[0], 'Logged into this account');
            */
    if(!empty($rdr)){
        header("location:".$rdr); exit();
    }else{
      header("location:dashboard.php"); exit();
    }
		}else{
			//return false, user does not exist
	//header('location:login.php');
    if(isset($_COOKIE['xt'])){
        $times = $_COOKIE['xt'] +1;
        setcookie("xt", $times, time() + 3600, "/");
        if($_COOKIE['xt']>=10){
            $times2 = time() + 3600;
            setcookie("blk", $times2, time() + 3600, "/");
             $date = date("M-d-Y");
    $ip = $_SERVER["REMOTE_ADDR"];
    $browser = $_SERVER['HTTP_USER_AGENT'];
            $sqlogip = "INSERT INTO ipblocks (ip, browser, date) VALUES('$ip', '$browser', '$date')";
    $querylogip = mysqli_query($link, $sqlogip, $link);
            
        }
        }else{
            setcookie("xt", 1, time() + (3600), "/");
    }
     
return "Invalid email or password!!";
		}

}

function loginadmin($email, $password, $rdr=""){
	include("connect.php");
    
	$email = sanitizeInput($email);
	$password = sanitizeInput($password);
	if($email=='' || $password==''){
		header('location:index.php'); exit();
	}
		//now go ahead with database verification of password
		$query = "SELECT * FROM admin WHERE username='$email'";
		$result = mysqli_query($link, $query);
		 while($row = mysqli_fetch_assoc($result)){
		$hashed_p[] = $row['pass'];
			 $id[]= $row["id"];
			 $authen[]= $row["authen"];
         }
if(password_verify($password, @$hashed_p[0])){
			
     $_SESSION['uid']= $id[0];
         $_SESSION['eml']= $authen[0];
    
    
	//	setcookie("uid", $id[0], time() + (86400 * 30), "/");
     //   setcookie("eml", $authen[0], time() + (86400 * 30), "/");
    /*
    //Log activity
        include_once("activitylog.php");
            log_activity($id[0], 'Logged into this account');
            */
    if(!empty($rdr)){
        header("location:".$rdr); exit();
    }else{
      header("location:dashboard.php"); exit();
    }
		}else{
			//return false, user does not exist
	//header('location:login.php');
    if(isset($_COOKIE['xt'])){
        $times = $_COOKIE['xt'] +1;
        setcookie("xt", $times, time() + 3600, "/");
        if($_COOKIE['xt']>=10){
            $times2 = time() + 3600;
            setcookie("blk", $times2, time() + 3600, "/");
             $date = date("M-d-Y");
    $ip = $_SERVER["REMOTE_ADDR"];
    $browser = $_SERVER['HTTP_USER_AGENT'];
            $sqlogip = "INSERT INTO ipblocksadmin (ip, browser, date) VALUES('$ip', '$browser', '$date')";
    $querylogip = mysqli_query($link, $sqlogip, $link);
            
        }
        }else{
            setcookie("xt", 1, time() + (3600), "/");
    }
     
return "Invalid Username or password!!";
		}

}


function sanitizeInput($input){
	//sanitze an input
	include("connect.php");
	$input = strip_tags(htmlspecialchars(trim($input)));
	$input = mysqli_real_escape_string($link, $input);
	return $input;
}

function randomCode($length) {
	//we hope to use this function generate referral codes in referrals.inc.php
    $pool = array_merge(range(0,9), range('A', 'Z'));

$key='';
    for($i=0; $i < $length; $i++) {
        $key .= $pool[mt_rand(0, count($pool) - 1)];
    }
    return $key;
}

function forgotpass($email){
	include("connect.php");
    
	$email = sanitizeInput($email);
	if($email==''){
		header('location:forgotpassword.php');exit();
	}
		//now go ahead with database verification of email
		$query = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($link, $query);
		 while($fch = mysqli_fetch_assoc($result)){
             
             $eml = $fch['email'];
         }
if(!empty($eml)){
    $token = randomCode(12);
    $expire = time()+10800;
		$sqlog = "UPDATE  `beagle`.`users` set rstoken='$token', expire='$expire'  WHERE `users`.`email`='$email'";
    $querylog = mysqli_query($link, $sqlog, $link);
    

		$msg = "A link has been sent to ".$email.", follow the link to reset your password";
    
    $sub="Reset Password request";
    
    $embody = "A request to reset password was sent from your account. <br> If it was your click this link https://prudencepay.com/myoffice/resetpassword.php?u=".$email."&t=".$token." to reset password.";
    
    sendemail($embody, $email, $sub);
    return $msg;

		}else{
			//return false, user does not exist
	
return "invalid email";
		}

}

function resetPass($email, $token, $newpass){
	include("connect.php");
    
	$email = sanitizeInput($email);
    $newpass = protectPass($newpass);
	if($email==''){
		header('location:forgotpassword.php'); exit();
	}
		//now go ahead with database verification of email
		$query = "SELECT * FROM users WHERE email='$email' AND rstoken= '$token'";
		$result = mysqli_query($link, $query);
		 while($fch = mysqli_fetch_assoc($result)){
             
             $pass[] = $fch['pass'];
             $expire[] = $fch['expire'];
             $id[] = $fch['id'];
         }
if(!empty($expire[0]) && $expire[0] > time()){
    
		$sqlog = "UPDATE  `beagle`.`users` set pass='$newpass', oldpass='$pass[0]'  WHERE `users`.`email`='$email'";
    $querylog = mysqli_query($link, $sqlog, $link);
    

		$msg = "Password Reset Successfully!";
    
    
    return $msg;

		}else if(!empty($expire[0]) && $expire[0] < time()){
			//return false, user does not exist
	
return "Token Expired!";
		}

}

function changepass($email, $password, $passwordnew){
    include("connect.php");
    $query = "SELECT * FROM users WHERE email='$email'";
		$result = mysqli_query($link, $query);
		 while($row = mysqli_fetch_assoc($result)){
		$hashed_p[] = $row['pass'];
             $id[] = $row['id'];
             
         }
    if(password_verify($password, $hashed_p[0])){
        $passwordnew = protectPass($passwordnew);
			$sqlog = "UPDATE  `beagle`.`users` set pass='$passwordnew', oldpass='$hashed_p[0]'  WHERE `users`.`email`='$email'";
    $querylog = mysqli_query($link, $sqlog, $link);
    
    
    //Log activity
     //   include_once("activitylog.php");
     //       log_activity($id[0], 'Changed Password');
     return "Password changed Successfully!";

		}else{
			
return "invalid password";
		}

    
}


function addcategory($name){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO categories (name) VALUES ('$name')";
		$result = mysqli_query($link, $query);
		
}

function addbanner($img, $link){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO banners (img, link) VALUES ('$img', '$link')";
		$result = mysqli_query($link, $query);
		
}

function adddistribution($name, $address, $phone, $email){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO distributions (name, address, phone, email, date) VALUES ('$name', '$address', '$phone', '$email', '$dt')";
		$result = mysqli_query($link, $query);
		
}

function addDistributionProduct($product, $distributor, $qty){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO distribution_products (product, distributor, qty) VALUES ('$product', '$distributor', '$qty')";
		$result = mysqli_query($link, $query);
		
}

function addOrder($order_id, $user, $delivery_address, $amount, $payment_status, $order_status, $payment_method, $delivery_date){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO orders (order_id, user, delivery_address, amount, payment_status, order_status, payment_method, delivery_date, date) VALUES ('$order_id', '$user', '$delivery_address', '$amount', '$payment_status', '$order_status', '$payment_method', '$delivery_date', '$dt')";
		$result = mysqli_query($link, $query);
		
}

function addOrderProducts($order_id, $product, $qty, $cost, $type){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO order_products (order_id, product, qty, cost, type, date) VALUES ('$order_id', '$product', '$qty', '$cost', '$type', '$dt')";
		$result = mysqli_query($link, $query);
		
}

function addProducts($name, $category, $image, $description, $qty, $price, $sku, $pack_size, $wholesale_price, $vat){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO products (name, category, image, description, qty, price, sku, pack_size, wholesale_price, vat, date) VALUES ('$name', '$category', '$image', '$description', '$qty', '$price', '$sku', '$pack_size', '$wholesale_price', '$vat', '$dt')";
		$result = mysqli_query($link, $query);
		
}

function addStaffs($name, $address, $phone, $email, $password, $distribution, $level, $auth, $status, $active){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO staffs (name, address, phone, email, password, distribution, level, auth, status, active, date) VALUES ('$name', '$address', '$phone', '$email', '$password', '$distribution', '$level', '$auth', '$status', '$active', '$dt')";
		$result = mysqli_query($link, $query);
		
}

function addStaffLevels($level, $privileges){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO staff_levels (level, privileges, date) VALUES ('$level', '$privileges', '$dt')";
		$result = mysqli_query($link, $query);
		
}

function addUsers($first_name, $other_names, $surname, $street, $lga, $state, $phone, $email, $password, $auth){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO users (first_name, other_names, surname, street, lga, state, phone, email, password, auth, date) VALUES ('$first_name', '$other_names', '$surname', '$street', '$lga', '$state', '$phone', '$email', '$password', '$auth', '$dt')";
		$result = mysqli_query($link, $query);
		
}

function addvehicle($name, $model, $plate_number, $reg_number, $staff, $distribution){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO users (name, model, plate_number, reg_number, staff, distribution) VALUES ('$name', '$model', '$plate_number', '$reg_number', '$staff', '$distribution')";
		$result = mysqli_query($link, $query);
		
}

function addmarketers($name, $phone, $email, $address){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO marketers (name, phone, email, address) VALUES ('$name', '$phone', '$email', '$address')";
		$result = mysqli_query($link, $query);
		
}

function addreview($name, $occupation, $location, $phone, $email, $message){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO review (name, occupation, location, phone, email, message, date) VALUES ('$name', '$occupation', '$location','$phone', '$email', '$message', '$dt')";
		$result = mysqli_query($link, $query);
		
}

function approvereview($id){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "UPDATE review SET active='1' WHERE id=".$id;
		$result = mysqli_query($link, $query);
		
}

function disapprovereview($id){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "UPDATE review SET active='0' WHERE id=".$id;
		$result = mysqli_query($link, $query);
		
}

function editmarketers($id, $name, $phone, $email, $address){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "UPDATE marketers SET name='$name', phone='$phone', email='$email', address='$address' WHERE id=".$id;
		$result = mysqli_query($link, $query);
		
}


function adduser($first_name, $other_name, $surname, $dob, $gender, $residence, $lga, $school, $school_address, $school_state, $school_phone, $school_email, $parent_title, $parent_first_name, $parent_surname, $parent_other_names, $parent_gender, $parent_phone, $parent_email, $ticket){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO users (first_name, other_names, surname, dob, gender, residence, lga, school, school_address, school_state, school_phone, school_email, parent_title, parent_first_name, parent_surname, parent_other_names, parent_gender, parent_phone, parent_email, ticket, date) VALUES ('$first_name', '$other_name', '$surname', '$dob', '$gender', '$residence', '$lga', '$school', '$school_address', '$school_state', '$school_phone', '$school_email', '$parent_title', '$parent_first_name', '$parent_surname', '$parent_other_names', '$parent_gender', '$parent_phone', '$parent_email', '$ticket', '$dt')";
		$result = mysqli_query($link, $query);
		
}


function genfetch($table, $gid, $field, $picker="id"){
    include("connect.php");
    $sqlgn = "SELECT * FROM ".$table." WHERE ".$picker."='$gid'";
    $querygn = mysqli_query($link,$sqlgn);
    while($fchgn = mysqli_fetch_assoc($querygn)){
        
       
        $gname[]= $fchgn["$field"];
}
    if(!empty($gname)){
    return $gname[0];
        }else{
		return "";
	}
}

function uploadimage($filename, $filetemp, $target_dir){
    $img = "";
	
   $name = $filename;
 //$target_dir = "../images/";
 $target_file = $target_dir . basename($filename);

 // Select file type
 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

 // Valid file extensions
 $extensions_arr = array("jpg","jpeg","png","gif");

 // Check extension
 if( in_array($imageFileType,$extensions_arr) ){
 
 $temp = explode(".", $filename);
$newfilename = round(microtime(true)) .mt_rand(1, 999).'.' . end($temp);
  
  // Upload file
  move_uploaded_file($filetemp,$target_dir.$newfilename);

 
	$img = $newfilename;
 
	}
	return $img;
}

function count_tickets($batch){
	include("connect.php");
    $sqlgn = "SELECT * FROM tickets WHERE batch='$batch'";
    $querygn = mysqli_query($link,$sqlgn);
    while($fchgn = mysqli_fetch_assoc($querygn)){
        
        $tickets[]= $fchgn["ticket"];     
}
	return count($tickets);
	
}

function count_used_tickets($batch){
	include("connect.php");
    $sqlgn = "SELECT * FROM tickets WHERE batch='$batch' AND used=1";
    $querygn = mysqli_query($link,$sqlgn);
    while($fchgn = mysqli_fetch_assoc($querygn)){
        
        $tickets[]= $fchgn["ticket"];     
}
	return @count($tickets);
	
}

function listmarketers(){
	
	include("connect.php");
    $sqlgn = "SELECT * FROM marketers";
    $querygn = mysqli_query($link,$sqlgn);
    while($fchgn = mysqli_fetch_assoc($querygn)){
        
        $class[]= $fchgn["name"];
       
       
}
	$options="";
	
	if(!empty($class)){
            for($i=0; $i<count($class); $i++){
            $options .= "<option value='".$class[$i]."'>".$class[$i]."</option>";
	}
    return $options;
	}
        
}


function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}


function sendemail($embody, $usereml, $sub){
    require("PHPMailer-master/PHPMailerAutoload.php");
    $email = new PHPMailer();
// set mailer to use SMTP
$email->IsSMTP();

// As this email.php script lives on the same server as our email server
// we are setting the HOST to localhost
$email->Host = "mail.braindrill.ng";  // specify main and backup server

$email->SMTPAuth = true;     // turn on SMTP authentication

// When sending email using PHPMailer, you need to send from a valid email address
// In this case, we setup a test email account with the following credentials:
// email: send_from_PHPMailer@bradm.inmotiontesting.com
// pass: password
$email->SMTPSecure = 'ssl';
$email->Port = 465;
$email->Username = "info@braindrill.ng";  // SMTP username
$email->Password = "oksoftadmin123"; // SMTP password
$email->IsHTML(true);


$email->From      = 'info@braindrill.ng';
$email->FromName  = 'Brain Drill';
$email->Subject   = $sub;
$email->Body      = $embody;
$email->AddAddress($usereml);
$email->XMailer = ' ';




if(!$email->Send())
{
   
} 
    
}

function compress($source, $destination, $quality) {

		$info = getimagesize($source);

		if ($info['mime'] == 'image/jpeg') 
			$image = imagecreatefromjpeg($source);

		elseif ($info['mime'] == 'image/gif') 
			$image = imagecreatefromgif($source);

		elseif ($info['mime'] == 'image/png') 
			$image = imagecreatefrompng($source);

		imagejpeg($image, $destination, $quality);

		return $destination;
	}


function secToHR($seconds) {
  $hours = floor($seconds / 3600);
  $minutes = floor(($seconds / 60) % 60);
  $seconds = $seconds % 60;
  return "$hours hrs $minutes mins";
}

function secToHR2($seconds) {
    $days = floor($seconds / 86400);
  $hours = floor(($seconds / 3600)% 24);
  $minutes = floor(($seconds / 60) % 60);
  $seconds = $seconds % 60;
	if($days<0){ $days =0;}
	if($hours<0){ $hours =0;}
	if($minutes<0){ $minutes =0;}
	if($seconds<0){ $seconds =0;}
  return "$days days $hours hrs $minutes mins";
}

function sendSMS2($nms, $msg){
	$url = "http://smartsmssolutions.com/api/?sender=prudencepay&to=".$nms."&message=".$msg."&type=0&routing=4&token=yqWzFRcPG5T23J8FNhjwYYHxQaZcQTFtvkbYnqMGkcPu3CAGqdCFa6kZweVgPq4MpXtswujAyR6bWRE1rZR5p0z4S5fNsFjDKX2f";
	
	
	$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Set so curl_exec returns the result instead of outputting it.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Get the response and close the channel.
$response = curl_exec($ch);
curl_close($ch);

//$resp = json_decode($response);
return $response;
}


function sendpdf($uname){
	require('fpdf.php'); 
class PDF extends FPDF {
 
function Header() {
    	
	//$this->Image("logo.png", 1.7, 0.2, 5.0, 0.8, "PNG", "");
}
 
function Footer() {
//This is the footer; it's repeated on each page.
//enter filename: phpjabber logo, x position: (page width/2)-half the picture size,
//y position: rough estimate, width, height, filetype, link: click it!
    //$this->Image("bottom.jpg", 0, 10.5, 8.5, .6, "JPG", "");
}
 
}
	$dt = date("D d M Y");
 
//class instantiation
$pdf=new PDF("L","in","A4");
	

	
$pdf->SetMargins(.4,0,0);
 
$pdf->AddPage();
	
$pdf->Image("certificate.jpg", 0, 0, 11.693, 8.268, "JPG", "");
	
$pdf->SetFont('Arial','b',32);
	$pdf->SetX(2);
	$pdf->SetY(3.8);

//Cell(float w[,float h[,string txt[,mixed border[,
//int ln[,string align[,boolean fill[,mixed link]]]]]]])

$pdf->Cell(0, 0, $uname, 0, 2, "L");



 $filename="mary.pdf";
  
$pdf->Output('F', $filename);
$pdf->Output();
	
}

function newticketno(){
    for($i=0; $i<100; $i++){
    $num = randomCode(8);
    if(genfetch("tickets", $num, "ticket")==""){
        break;
       
        }
    }
     return $num;
        
}

function ticketpdf($pages, $salesperson, $batch){
	require('fpdf.php'); 
    
    
class PDF_Rotate extends FPDF
{
var $angle=0;

function Rotate($angle,$x=-1,$y=-1)
{
	if($x==-1)
		$x=$this->x;
	if($y==-1)
		$y=$this->y;
	if($this->angle!=0)
		$this->_out('Q');
	$this->angle=$angle;
	if($angle!=0)
	{
		$angle*=M_PI/180;
		$c=cos($angle);
		$s=sin($angle);
		$cx=$x*$this->k;
		$cy=($this->h-$y)*$this->k;
		$this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
	}
}

function _endpage()
{
	if($this->angle!=0)
	{
		$this->angle=0;
		$this->_out('Q');
	}
	parent::_endpage();
}

 
function RotatedText($x,$y,$txt,$angle)
{
    //Text rotated around its origin
    $this->Rotate($angle,$x,$y);
    $this->Text($x,$y,$txt);
    $this->Rotate(0);
}

function RotatedImage($file,$x,$y,$w,$h,$angle)
{
    //Image rotated around its upper-left corner
    $this->Rotate($angle,$x,$y);
    $this->Image($file,$x,$y,$w,$h);
    $this->Rotate(0);
}
	
function qrcode($ticket){
		 $qrimg = file_get_contents('https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl=http://win.braindrill.ng/index.php?tk='.$ticket.'&choe=UTF-8');
		 $ft = fopen("qrcodes/".$ticket.".png", "w");
		 fwrite($ft, $qrimg);
								    
	return "qrcodes/".$ticket.".png" ;
		
	}
}


$pdf=new PDF_Rotate();
    
    for($i=0; $i<$pages; $i++){
$pdf->AddPage();
$pdf->SetFont('Arial','',9);
	$tic1 = newticketno();
	$tic2 = newticketno();
	$tic3 = newticketno();
	$tic4 = newticketno();
	$tic5 = newticketno();
	$tic6 = newticketno();
	$tic7 = newticketno();
	$tic8 = newticketno();
	$tic9 = newticketno();

        $date = date("d-M-Y");
$pdf->RotatedText(60,10,"SALES PERSON: ".$salesperson,0);
$pdf->RotatedText(60,15,"PRODUCTION BATCH: ".$batch,0);
$pdf->RotatedText(140,10,"TICKET NOS:",0);
$pdf->RotatedText(140,15,"$tic1, $tic2, $tic3",0);
$pdf->RotatedText(140,20,"$tic4, $tic5, $tic6",0);
$pdf->RotatedText(140,25,"$tic7, $tic8, $tic9",0);
$pdf->RotatedText(60,20,"DATE OF ORDER: ".$date,0);
    
$pdf->SetFont('Arial','',12);
	
$pdf->RotatedImage($pdf->qrcode($tic1),65,40,15,15,270);
$pdf->RotatedText(15,85,"$tic1",270);
		addticket($tic1, $batch, $salesperson);
 	
$pdf->RotatedImage($pdf->qrcode($tic2),130,40,15,15,270);
$pdf->RotatedText(77,85,"$tic2",270);
		addticket($tic2, $batch, $salesperson);
   	
$pdf->RotatedImage($pdf->qrcode($tic3),195,40,15,15,270);
$pdf->RotatedText(145,85,"$tic3",270);
		addticket($tic3, $batch, $salesperson);

    
    	
$pdf->RotatedImage($pdf->qrcode($tic4),65,125,15,15,270);
$pdf->RotatedText(15,170,"$tic4",270);
		addticket($tic4, $batch, $salesperson);
 	
$pdf->RotatedImage($pdf->qrcode($tic5),130,125,15,15,270);
$pdf->RotatedText(77,170,"$tic5",270);
		addticket($tic5, $batch, $salesperson);
   	
$pdf->RotatedImage($pdf->qrcode($tic6),195,125,15,15,270);
$pdf->RotatedText(145,170,"$tic6",270);
		addticket($tic6, $batch, $salesperson);
    
    
       	
$pdf->RotatedImage($pdf->qrcode($tic7),65,215,15,15,270);
$pdf->RotatedText(15,258,"$tic7",270);
		addticket($tic7, $batch, $salesperson);
 	
$pdf->RotatedImage($pdf->qrcode($tic8),130,215,15,15,270);
$pdf->RotatedText(77,258,"$tic8",270);
		addticket($tic8, $batch, $salesperson);
   	
$pdf->RotatedImage($pdf->qrcode($tic9),195,215,15,15,270);
$pdf->RotatedText(145,258,"$tic9",270);
		addticket($tic9, $batch, $salesperson);
    }
    
$pdf->Output();
}

function sendSMS($nms){
	
	 $url = "https://api.ringcaptcha.com/u5uqu5o8iporipyhy3o1/code/sms";
	
	$fields = array(
	'phone' => urlencode($nms),
	'api_key' => urlencode("y1u6eco3a7aba9a9y8ol")
);

//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Set so curl_exec returns the result instead of outputting it.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Get the response and close the channel.
$response = curl_exec($ch);
curl_close($ch);

$resp = json_decode($response);
	return $resp;
}

function verifySMS($nms, $code){
	
	 $url = "https://api.ringcaptcha.com/u5uqu5o8iporipyhy3o1/verify";
	
	$fields = array(
	'phone' => urlencode($nms),
	'code' => urlencode($code),
	'api_key' => urlencode("y1u6eco3a7aba9a9y8ol")
	
);

//url-ify the data for the POST
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string, '&');

//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch,CURLOPT_POST, count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Set so curl_exec returns the result instead of outputting it.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Get the response and close the channel.
$response = curl_exec($ch);
curl_close($ch);

$resp = json_decode($response);
	return $resp;
}
?>