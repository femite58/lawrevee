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
		header('location:login.php'); exit();
	}
		//now go ahead with database verification of password
		$query = "SELECT * FROM users WHERE username='$email'";
		$result = mysqli_query($link,$query);
		 while($row = mysqli_fetch_assoc($result)){
		$hashed_p[] = $row['password'];
         }
if(password_verify($password, @$hashed_p[0])){
			$sqlog = "SELECT * FROM users WHERE username='$email'";
    $querylog = mysqli_query($link,$sqlog);
    while($fchlog = mysqli_fetch_assoc($querylog)){
        
        $id[]= $fchlog["id"];
		$authen[]= $fchlog["authen"];
    }
    /* $_SESSION['uid']= $id[0];
         $_SESSION['eml']= $email;
    
    */
		setcookie("uid", $id[0], time() + (86400 * 30), "/");
        setcookie("eml", $authen[0], time() + (86400 * 30), "/");
   
    if(!empty($rdr)){
        header("location:".$rdr); exit();
    }else{
      header("location:myaccount.php"); exit();
    }
		}else{
     
return "Invalid username or password!!";
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
		$result = mysqli_query($link,$query);
		 while($row = mysqli_fetch_assoc($result)){
		$hashed_p[] = $row['pass'];
			 $id[]= $row["id"];
			 $authen[]= $row["authen"];
         }
if(password_verify($password, @$hashed_p[0])){
			
     
		setcookie("uid", $id[0], time() + (86400 * 30), "/");
        setcookie("eml", $authen[0], time() + (86400 * 30), "/");
   
    if(!empty($rdr)){
        header("location:".$rdr); exit();
    }else{
		header("location:dashboard.php");
      //return "true"; exit();
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
    $querylogip = mysqli_query($link,$sqlogip);
            
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
    $pool = array_merge(range(0,9), range('a', 'z'),range('A', 'Z'));

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
		$result = mysqli_query($link,$query);
		 while($fch = mysqli_fetch_assoc($result)){
             
             $eml = $fch['email'];
         }
if(!empty($eml)){
    $token = randomCode(12);
    $expire = time()+10800;
		$sqlog = "UPDATE  `beagle`.`users` set rstoken='$token', expire='$expire'  WHERE `users`.`email`='$email'";
    $querylog = mysqli_query($link,$sqlog);
    

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
		$result = mysqli_query($link,$query);
		 while($fch = mysqli_fetch_assoc($result)){
             
             $pass[] = $fch['pass'];
             $expire[] = $fch['expire'];
             $id[] = $fch['id'];
         }
if(!empty($expire[0]) && $expire[0] > time()){
    
		$sqlog = "UPDATE  `beagle`.`users` set pass='$newpass', oldpass='$pass[0]'  WHERE `users`.`email`='$email'";
    $querylog = mysqli_query($link,$sqlog);
    

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
		$result = mysqli_query($link,$query);
		 while($row = mysqli_fetch_assoc($result)){
		$hashed_p[] = $row['pass'];
             $id[] = $row['id'];
             
         }
    if(password_verify($password, $hashed_p[0])){
        $passwordnew = protectPass($passwordnew);
			$sqlog = "UPDATE  `beagle`.`users` set pass='$passwordnew', oldpass='$hashed_p[0]'  WHERE `users`.`email`='$email'";
    $querylog = mysqli_query($link,$sqlog);
    
    
    //Log activity
     //   include_once("activitylog.php");
     //       log_activity($id[0], 'Changed Password');
     return "Password changed Successfully!";

		}else{
			
return "invalid password";
		}

    
}

function addToCart($item, $qty, $wholesale){
	if(isset($_COOKIE["cart"])){
		$cart = json_decode($_COOKIE["cart"]);
	}else{
		$cart = array();
		}
	$pd = array($item, $qty, $wholesale);
	array_push($cart, $pd);
	
	setcookie("cart", json_encode($cart), time() + (86400*30), "/");
}

function updateCart($qty, $index){
	if(isset($_COOKIE["cart"])){
		$cart = json_decode($_COOKIE["cart"]);
	}
	$cartnew= array();
	
	for($i=0; $i<count($cart); $i++){
		if($i==$index){
			$pd = array($cart[$i][0], $qty, $cart[$i][2]);
	array_push($cartnew, $pd);
		}else{
	$pd = array($cart[$i][0], $cart[$i][1], $cart[$i][2]);
	array_push($cartnew, $pd);
	}
	}
	setcookie("cart", json_encode($cartnew), time() + (86400*30), "/");
}

function removeFromCart($index){
	if(isset($_COOKIE["cart"])){
		$cart = json_decode($_COOKIE["cart"]);
	}
	$cartnew= array();
	
	for($i=0; $i<count($cart); $i++){
		if($i==$index){
			continue;
		}
	$pd = array($cart[$i][0], $cart[$i][1], $cart[$i][2]);
	array_push($cartnew, $pd);
	
	}
	setcookie("cart", json_encode($cartnew), time() + (86400*30), "/");
}

function totalCart(){
	if(isset($_COOKIE["cart"])){
		$cart = json_decode($_COOKIE["cart"]);
	}
	$carttotal= 0;
	
	for($i=0; $i<count($cart); $i++){
	if($cart[$i][2]>=1){
		$carttotal +=
		(genfetch("products", $cart[$i][0], "wholesale_price")-((genfetch("products", $cart[$i][0], "wholesale_price")*genfetch("products", $cart[$i][0], "discount"))/100))*$cart[$i][1]; 
	}else{
			$carttotal += (genfetch("products", $cart[$i][0], "price")-((genfetch("products", $cart[$i][0], "price")*genfetch("products", $cart[$i][0], "discount"))/100))*$cart[$i][1];
										}
	}
	
	return $carttotal;
}

function countCart(){
	$countcart=0;
	if(isset($_COOKIE["cart"])){
		$cart = json_decode($_COOKIE["cart"]);
		$countcart = count($cart);
	}
	return $countcart;
}

function addAdmin($username, $password){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO admin (username, pass, authen) VALUES ('$username','$password','$password')";
		$result = mysqli_query($link, $query);
		
}

function addInspection($land, $name, $phone, $email, $date, $time){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO inspection (land, name, phone, email, date, time) VALUES ('$land', '$name', '$phone', '$email', '$date', '$time')";
		$result = mysqli_query($link, $query);
		
}

function addInvestment($order_id, $user, $property, $investment_type, $qty, $price, $duration, $interest_rate, $due_date){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO investments  (order_id, user, property, investment_type, qty, price, duration, interest_rate, date, status, due_date) VALUES ('$order_id', '$user', '$property', '$investment_type', '$qty', '$price', '$duration', '$interest_rate', '$dt', 'Awaiting Payment', '$due_date')";
		$result = mysqli_query($link, $query);
		
}

function addLand($name, $location, $neighborhood, $size, $title, $price, $promo, $promo_start, $promo_end, $form, $images, $video, $description, $use_type, $added_by, $popular){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO lands (name, location, neighborhood, size, title, price, promo, promo_start, promo_end, form, images, video, description, use_type, added_by, active, date, popular) VALUES ('$name', '$location', '$neighborhood', '$size', '$title', '$price', '$promo', '$promo_start', '$promo_end', '$form', '$images', '$video', '$description', '$use_type', '$added_by', '1', '$dt', '$popular')";
		$result = mysqli_query($link, $query);
		
}

function editLand($lid, $name, $location, $neighborhood, $size, $title, $price, $promo, $promo_start, $promo_end, $form, $images, $video, $description, $use_type, $edit_by, $popular){
    include("connect.php");
	
	$dt = date("d-M-Y");
	$last_edit = time();
	
    $query = "UPDATE lands SET name='$name', location='$location', neighborhood='$neighborhood', size='$size', title='$title', price='$price', promo='$promo', promo_start='$promo_start', promo_end='$promo_end', form='$form', images='$images', video='$video', description='$description', use_type='$use_type', edit_by='$edit_by', last_edit='$last_edit', popular='$popular' WHERE id=".$lid;
		$result = mysqli_query($link, $query);
		
}

function addTrading($location, $estate, $price_per_plot, $price_per_meter, $added_by){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO trading (location, estate, price_per_plot, price_per_meter, added_by, date) VALUES ('$location', '$estate', '$price_per_plot', '$price_per_meter', '$added_by', '$dt')";
		$result = mysqli_query($link, $query);
		
}

function editTrading($tid, $location, $estate, $price_per_plot, $price_per_meter, $edit_by){
    include("connect.php");
	
	$dt = date("d-M-Y");
	$last_edit = time();
	
    $query = "UPDATE trading set location='$location', estate='$estate', price_per_plot='$price_per_plot', price_per_meter='$price_per_meter', edit_by='$edit_by', last_edit='$last_edit' WHERE id=".$tid;
		$result = mysqli_query($link, $query);
		
}

function addUser($first_name, $middle_name, $surname, $email, $phone, $address, $sex, $marital_status, $nationality, $kin_first_name, $kin_surname, $kin_phone, $kin_address, $password, $username, $ref){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO users (first_name, middle_name, surname, email, phone, address, sex, marital_status, nationality, kin_first_name, kin_surname, kin_phone, kin_address, password, username, authen, ref, date) VALUES ('$first_name', '$middle_name', '$surname', '$email', '$phone', '$address', '$sex', '$marital_status', '$nationality', '$kin_first_name', '$kin_surname', '$kin_phone', '$kin_address', '$password', '$username', '$password', '$ref', '$dt')";
		$result = mysqli_query($link, $query);
		
}


function addtopslide($img){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO topslide (img, active) VALUES ('$img', '1')";
		$result = mysqli_query($link, $query);
		
}

function edittopslide($slid, $img){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "UPDATE topslide SET img='$img' WHERE id=".$slid;
		$result = mysqli_query($link, $query);
		
}

function addbottomslide($img){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO bottomslide (img, active) VALUES ('$img', '1')";
		$result = mysqli_query($link, $query);
		
}

function editbottomslide($slid, $img){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "UPDATE bottomslide SET img='$img' WHERE id=".$slid;
		$result = mysqli_query($link, $query);
		
}

function addlibrary($title, $category, $content){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO library (title, category, content, active) VALUES ('$title', '$category', '$content', '1')";
		$result = mysqli_query($link, $query);
		
}

function editlibrary($lbid, $title, $category, $content){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "UPDATE library SET title='$title', category='$category', content='$content' WHERE id=".$lbid;
		$result = mysqli_query($link, $query);
		
}


function hidebottomslide($pid){
    include("connect.php");
	
	$pid = sanitizeInput($pid);
	
    $query = "UPDATE bottomslide SET active='0' WHERE  id=$pid";
		$result = mysqli_query($link,$query);
	
}

function showbottomslide($pid){
    include("connect.php");
	
	$pid = sanitizeInput($pid);
	
    $query = "UPDATE bottomslide SET active='1' WHERE  id=$pid";
		$result = mysqli_query($link,$query);
	
}

function hidetopslide($pid){
    include("connect.php");
	
	$pid = sanitizeInput($pid);
	
    $query = "UPDATE topslide SET active='0' WHERE  id=$pid";
		$result = mysqli_query($link,$query);
	
}

function showtopslide($pid){
    include("connect.php");
	
	$pid = sanitizeInput($pid);
	
    $query = "UPDATE topslide SET active='1' WHERE  id=$pid";
		$result = mysqli_query($link,$query);
	
}

function hidelibrary($pid){
    include("connect.php");
	
	$pid = sanitizeInput($pid);
	
    $query = "UPDATE library SET active='0' WHERE id=$pid";
		$result = mysqli_query($link,$query);
	
}

function showlibrary($pid){
    include("connect.php");
	
	$pid = sanitizeInput($pid);
	
    $query = "UPDATE library SET active='1' WHERE  id=$pid";
		$result = mysqli_query($link,$query);
	
}

function addStaffs($name, $phone, $email, $username, $password, $level, $auth){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO admin (name, phone, email, username, pass, admins, authen, active, date) VALUES ('$name', '$phone', '$email', '$username', '$password', '$level', '$auth', '1', '$dt')";
		$result = mysqli_query($link, $query);
		
}

function addStaffLevels($level, $privileges){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO staff_levels (level, privileges, date) VALUES ('$level', '$privileges', '$dt')";
		$result = mysqli_query($link, $query);
		
}

function addShipping($location, $cost){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO shipping (location, cost) VALUES ('$location', '$cost')";
		$result = mysqli_query($link, $query);
		
}


function newblogpost($topic, $category, $content,$tags, $url){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO blog (topic, category, content, tags, url, date) VALUES ('$topic', '$category', '$content','$tags', '$url', '$dt')";
		$result = mysqli_query($link,$query);
	if($result){
		
	
		return "true";
	}else{
		return "false";
	}
}

function updateblogpost($topic, $category, $content,$tags, $pid){
    include("connect.php");
	
	
	$dt = date("d-M-Y");
	
    
	$query = "UPDATE blog SET topic = '$topic', category='$category', tags='$tags', content='$content' WHERE id= $pid";
		$result = mysqli_query($link,$query);
		
	if($result){
		
		
		return "true";
	}else{
		return "false";
	}
}

function addcomment($post, $name, $email, $message){
    include("connect.php");
	$post= sanitizeInput($post); 
	$name= sanitizeInput($name); 
	$email= sanitizeInput($email); 
	$message= sanitizeInput($message); 
	
	$dt = time();
	
    $query = "INSERT INTO comments (post,name,email,comment, date) VALUES ('$post', '$name', '$email','$message', '$dt')";
		$result = mysqli_query($link,$query);
	if($result){
		
	
		return "true";
	}else{
		return "false";
	}
}


function publish($pid){
    include("connect.php");
	
	$pid = sanitizeInput($pid);
	
    $query = "UPDATE blog SET publish='1' WHERE  id=$pid";
		$result = mysqli_query($link,$query);
	if($result){
		
		return "true";
	}else{
		return "false";
	}
}

function unpublish($pid){
    include("connect.php");
	
	$pid = sanitizeInput($pid);
	
    $query = "UPDATE blog SET publish='0' WHERE  id=$pid";
		$result = mysqli_query($link,$query);
	if($result){
		
		return "true";
	}else{
		return "false";
	}
}

function addblogview($pid){
	include("connect.php");
	$view = getblogviews($pid)+1;
   
    
    $querytr1 = "UPDATE blog SET  views='$view' WHERE id=".$pid;
		$resulttr1 = mysqli_query($link,$querytr1);
}

function getcommentcount($gid){
    include("connect.php");
    $sqlgn = "SELECT * FROM comments WHERE post=".$gid;
    $querygn = mysqli_query($link,$sqlgn);
    while($fchgn = mysqli_fetch_assoc($querygn)){
        
       
        $gname[]= $fchgn["post"];
}
    if(!empty($gname)){
    return count($gname);
        }else{
		return 0;
	}
}

function getcommentname($gid){
    include("connect.php");
    $sqlgn = "SELECT * FROM comments WHERE id=".$gid;
    $querygn = mysqli_query($link,$sqlgn);
    while($fchgn = mysqli_fetch_assoc($querygn)){
        
       
        $gname[]= $fchgn["name"];
}
    if(!empty($gname)){
    return $gname[0];
        }
}

function getcommentemail($gid){
    include("connect.php");
    $sqlgn = "SELECT * FROM comments WHERE id=".$gid;
    $querygn = mysqli_query($link,$sqlgn);
    while($fchgn = mysqli_fetch_assoc($querygn)){
        
       
        $gname[]= $fchgn["email"];
}
    if(!empty($gname)){
    return $gname[0];
        }
}


function getcommentmessage($gid){
    include("connect.php");
    $sqlgn = "SELECT * FROM comments WHERE id=".$gid;
    $querygn = mysqli_query($link,$sqlgn);
    while($fchgn = mysqli_fetch_assoc($querygn)){
        
       
        $gname[]= $fchgn["comment"];
}
    if(!empty($gname)){
    return $gname[0];
        }
}

function getcommentdate($gid){
    include("connect.php");
    $sqlgn = "SELECT * FROM comments WHERE id=".$gid;
    $querygn = mysqli_query($link,$sqlgn);
    while($fchgn = mysqli_fetch_assoc($querygn)){
        
       
        $gname[]= $fchgn["date"];
}
    if(!empty($gname)){
    return $gname[0];
        }
}

function getblogpublish($pid){
	include("connect.php");
	$query = "SELECT * FROM blog WHERE id=$pid";
		$result = mysqli_query($link,$query);
		 while($fch = mysqli_fetch_assoc($result)){
             
             $gt[] = $fch['publish'];
             
         }
	
	if(!empty($gt)){
    return $gt[0];
        }
}

function getblogtopic($pid){
	include("connect.php");
	$query = "SELECT * FROM blog WHERE id=$pid";
		$result = mysqli_query($link,$query);
		 while($fch = mysqli_fetch_assoc($result)){
             
             $gt[] = $fch['topic'];
             
         }
	
	if(!empty($gt)){
    return $gt[0];
        }
}

function getblogcontent($pid){
	include("connect.php");
	$query = "SELECT * FROM blog WHERE id=$pid";
		$result = mysqli_query($link,$query);
		 while($fch = mysqli_fetch_assoc($result)){
             
             $gt[] = $fch['content'];
             
         }
	
	if(!empty($gt)){
    return $gt[0];
        }
}

function getblogcategory($pid){
	include("connect.php");
	$query = "SELECT * FROM blog WHERE id=$pid";
		$result = mysqli_query($link,$query);
		 while($fch = mysqli_fetch_assoc($result)){
             
             $gt[] = $fch['category'];
             
         }
	
	if(!empty($gt)){
    return $gt[0];
        }
}

function getblogviews($pid){
	include("connect.php");
	$query = "SELECT * FROM blog WHERE id=$pid";
		$result = mysqli_query($link,$query);
		 while($fch = mysqli_fetch_assoc($result)){
             
             $gt[] = $fch['views'];
             
         }
	
	if(!empty($gt)){
    return $gt[0];
        }
}


function getblogtopicurl($pid){
	include("connect.php");
	$query = "SELECT * FROM blog WHERE id=$pid";
		$result = mysqli_query($link,$query);
		 while($fch = mysqli_fetch_assoc($result)){
             
             $gt[] = $fch['url'];
             
         }
	
	if(!empty($gt)){
    return $gt[0];
        }
}

function getblogdate($pid){
	include("connect.php");
	$query = "SELECT * FROM blog WHERE id=$pid";
		$result = mysqli_query($link,$query);
		 while($fch = mysqli_fetch_assoc($result)){
             
             $gt[] = $fch['date'];
             
         }
	
	if(!empty($gt)){
    return $gt[0];
        }
}


function listposts(){
    
		include("connect.php");

$sqlgnip = "SELECT * FROM blog WHERE publish=1";
    $querygnip = mysqli_query($link,$sqlgnip);
    while($fchgnip = mysqli_fetch_assoc($querygnip)){
        
        $bid[]= $fchgnip["id"];
       
}
	$sn=1;
	$options="";
	if(!empty($bid)){
        for($i=count($bid)-1; $i>=0; $i--){
            $options .= "<li class='nav-item'><a href='readpost.php?rp=".getblogtopicurl($bid[$i])."' class='nav-link'>".getblogtopic($bid[$i])."</a></li>";
			
			$sn  +=1;
			if($sn>9){
				break;
			}
        }
	}
    return $options;
        
}

function listposts2(){
    
		include("connect.php");

$sqlgnip = "SELECT * FROM blog WHERE publish=1";
    $querygnip = mysqli_query($link,$sqlgnip);
    while($fchgnip = mysqli_fetch_assoc($querygnip)){
        
        $bid[]= $fchgnip["id"];
       
}
	$sn=1;
	$options="";
	if(!empty($bid)){
        for($i=count($bid)-1; $i>=0; $i--){
            $options .= " <li class='d-flex '><div class='text'><h5 class='mb-0'><a href='blog/readpost.php?rp=".getblogtopicurl($bid[$i])."' class='nav-link'>".getblogtopic($bid[$i])."</a></h5></div></li>";
			
			$sn  +=1;
			if($sn>2){
				break;
			}
        }
	}
    return $options;
        
}
function imageUpload($name){
    include("connect.php");
	
	$dt = date("d-M-Y");
	
    $query = "INSERT INTO imageuploads (imgname) VALUES ('$name')";
		$result = mysqli_query($link,$query);
	
}


function listtagspost($pid){
    include("connect.php");
    $sqlgn = "SELECT * FROM blog WHERE id='$pid'";
    $querygn = mysqli_query($link,$sqlgn);
    while($fchgn = mysqli_fetch_assoc($querygn)){
        
        $pkgname[]= $fchgn["tags"];
        
        
}
    if(!empty($pkgname)){
		$pkgtags = explode(",", $pkgname[0]);
		array_unique($pkgtags);
        $options = "";
        for($i=0; $i<count($pkgtags); $i++){
            $options .= "<li><a href='search.php?srh=".$pkgtags[$i]."'>".$pkgtags[$i]."</a></li>";
        }
    return $options;
        }
}

function listtagsallpost(){
    include("connect.php");
    $sqlgn = "SELECT * FROM blog WHERE active='1'";
    $querygn = mysqli_query($link,$sqlgn);
    while($fchgn = mysqli_fetch_assoc($querygn)){
        
        $pkgname[]= $fchgn["tags"];
        
        
}
    if(!empty($pkgname)){
		$alltags ="";
		for($i=0; $i<count($pkgname); $i++){
            $alltags .= $pkgname[$i].",";
        }
		$pkgtags2 = explode(",", $alltags);
		$pkgtags =array_merge(array_unique($pkgtags2));
        $options = "";
        for($i=0; $i<count($pkgtags)-1; $i++){
            $options .= "<li><a href='search.php?srh=".$pkgtags[$i]."'>".$pkgtags[$i]."</a></li>";
        }
    return $options;
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

function uploaddoc($filename, $filetemp, $target_dir){
    $img = "";
	
   $name = $filename;
 //$target_dir = "../images/";
 $target_file = $target_dir . basename($filename);

 // Select file type
 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

 // Valid file extensions
 $extensions_arr = array("pdf","doc","docx","txt","xls");

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

function listcategories(){
    
		include("connect.php");

$sqlgnip = "SELECT * FROM categories";
    $querygnip = mysqli_query($link,$sqlgnip);
    while($fchgnip = mysqli_fetch_assoc($querygnip)){
        
        $bid[]= $fchgnip["id"];
        $catname[]= $fchgnip["name"];
       
}
	
	$options="";
	if(!empty($bid)){
        for($i=count($bid)-1; $i>=0; $i--){
            $options .= "<option value='".$bid[$i]."'>".$catname[$i]."</option>";
			
			
        }
	}
    return $options;
        
}

function listproducts(){
    
		include("connect.php");

$sqlgnip = "SELECT * FROM products";
    $querygnip = mysqli_query($link,$sqlgnip);
    while($fchgnip = mysqli_fetch_assoc($querygnip)){
        
        $bid[]= $fchgnip["id"];
        $pname[]= $fchgnip["name"];
       
}
	
	$options="";
	if(!empty($bid)){
        for($i=count($bid)-1; $i>=0; $i--){
            $options .= "<option value='".$bid[$i]."'>". $pname[$i]."</option>";
			}
        
	}
	
    return $options;
        
}

function listlevels(){
    
		include("connect.php");

$sqlgnip = "SELECT * FROM staff_levels";
    $querygnip = mysqli_query($link,$sqlgnip);
    while($fchgnip = mysqli_fetch_assoc($querygnip)){
        
        $bid[]= $fchgnip["id"];
        $pname[]= $fchgnip["level"];
       
}
	
	$options="";
	if(!empty($bid)){
        for($i=count($bid)-1; $i>=0; $i--){
            $options .= "<option value='".$bid[$i]."'>". $pname[$i]."</option>";
			}
        
	}
	
    return $options;
        
}

function listdistributions(){
    
		include("connect.php");

$sqlgnip = "SELECT * FROM distributions";
    $querygnip = mysqli_query($link,$sqlgnip);
    while($fchgnip = mysqli_fetch_assoc($querygnip)){
        
        $bid[]= $fchgnip["id"];
        $pname[]= $fchgnip["name"];
       
}
	
	$options="";
	if(!empty($bid)){
        for($i=count($bid)-1; $i>=0; $i--){
            $options .= "<option value='".$bid[$i]."'>". $pname[$i]."</option>";
			}
        
	}
	
    return $options;
        
}

function liststaffs(){
    
		include("connect.php");

$sqlgnip = "SELECT * FROM staffs";
    $querygnip = mysqli_query($link,$sqlgnip);
    while($fchgnip = mysqli_fetch_assoc($querygnip)){
        
        $bid[]= $fchgnip["id"];
        $pname[]= $fchgnip["name"];
       
}
	
	$options="";
	if(!empty($bid)){
        for($i=count($bid)-1; $i>=0; $i--){
            $options .= "<option value='".$bid[$i]."'>". $pname[$i]."</option>";
			}
        
	}
	
    return $options;
        
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
$email->Host = "ded3532.inmotionhosting.com";  // specify main and backup server

$email->SMTPAuth = true;     // turn on SMTP authentication

// When sending email using PHPMailer, you need to send from a valid email address
// In this case, we setup a test email account with the following credentials:
// email: send_from_PHPMailer@bradm.inmotiontesting.com
// pass: password
$email->SMTPSecure = 'ssl';
$email->Port = 465;
$email->Username = "no-reply@prudencepay.com";  // SMTP username
$email->Password = "prudencepay27"; // SMTP password
$email->IsHTML(true);


$email->From      = 'no-reply@prudencepay.com';
$email->FromName  = 'prudencepay';
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