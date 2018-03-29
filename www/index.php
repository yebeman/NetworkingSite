<?PHP


   require_once("./php/formvalidator.php");
   include_once "cnncttoDataBaseofyachattwbsght.php";
 
if (isset($_COOKIE['em']) && isset($_COOKIE['sub'])) {
   $emailAddress=$_COOKIE["em"];
   $password=$_COOKIE["sub"];
	
	   $sql = mysql_query("SELECT * FROM members WHERE password='$password' AND emailAddressE='$emailAddress'"); 
        
        $login_check = mysql_num_rows($sql);
   	 // if the program founds by that name and password then sends a "all good" data to the falsh
   	 // if not then "no good"
        if($login_check > 0){
			header("Location: http://localhost/yc/apps.php");}
  } 
  
 $validation_errors='';
   //if(isset($_POST['submitted']))
   if((isset($_POST['sendRequest'])?$_POST['sendRequest']:''== "Sign up"))
   {// We need to validate only after the form is submitted
   
       //Setup Server side Validations
       //Please note that the element name is c ase sensitive 
   	
       $validator = new FormValidator();
       $validator->addValidation("userName","req","* Please fill in your Full Name.");
       $validator->addValidation("emailAddress","email","* The input for Email should be a valid email Address.");
       $validator->addValidation("emailAddress","req","* Please fill in your Email Address.");
   	$validator->addValidation("password","req","* Please fill in your password.");
   	$validator->addValidation("rePassword","req","* Please retype your password.");
	$validator->addValidation("gender","req","* Please select your gender.");
       if(((isset($_POST['password'])?$_POST['password']:'')!=(isset($_POST['rePassword'])?$_POST['rePassword']:''))&&((isset($_POST['rePassword'])?$_POST['rePassword']:'')!=""))
   $validation_errors .="* Paswords dont match."; else $validation_errors='';
       //Then validate the form
       if($validator->ValidateForm()&&$validation_errors=="")
       {
	   
   	$username = isset($_POST['userName'])?$_POST['userName']:'';
   	$password = isset($_POST['password'])?$_POST['password']:'';
   	$emailAddress = isset($_POST['emailAddress'])?$_POST['emailAddress']:'';
	$emailAddressE=md5($emailAddress."emailAddress");
	$pssw = md5 (md5 ($password) . $emailAddress);//salt
	 $country = isset($_POST['country'])?$_POST['country']:'';
	 $gender = isset($_POST['gender'])?$_POST['gender']:'';
	 echo $country;
		 $sql = mysql_query("SELECT * FROM members WHERE emailAddress='$emailAddress'"); 
        
        $login_check = mysql_num_rows($sql);
  
	 
	if($login_check > 0){ 
             $validation_errors="The email address is already taken! Please choose a different email address.";  
        } else {
   	       $validation_errors="Creating your account...";
			  $sql = mysql_query("INSERT INTO members (userName, password,emailAddress,emailAddressE,lastLogin,signUpDate, profilePic,country,gender) VALUES ('$username','$pssw','$emailAddress','$emailAddressE',NOW(),NOW(),'http://localhost/yt/profPictures/basicUser.gif','$country','$gender')");
   
            /* Cookie expires when browser closes */
     setcookie('em', $emailAddressE, false);
     setcookie('sub', $pssw, false);
	 header("Location: http://localhost/yc/apps.php");
    
	 }
	    
       } 
       else 
       {
           //Validations failed. Display Errors.
           $error_hash = $validator->GetErrors();
           foreach($error_hash as $inpname => $inp_err)
           {
              $validation_errors .= "<p>$inp_err</p>\n";//"<p>$inpname : $inp_err</p>\n";
           }  
   		     
       }
   }//if
   $disp_name  = isset($_POST['userName'])?$_POST['userName']:'';
   $disp_email = isset($_POST['emailAddress'])?$_POST['emailAddress']:'';
   
   
   $validation_errorsS='';
   if(isset($_POST['submittedS']))
   {// We need to validate only after the form is submitted
   
   	
       $validator = new FormValidator();
       $validator->addValidation("emailAddressS","email","* The input for Email should be a valid email Address");
       $validator->addValidation("emailAddressS","req","* Please fill in your Email Address");
   	$validator->addValidation("passwordS","req","* Please fill in your password");
       
       //Then validate the form
       if($validator->ValidateForm())
       {
   	     $emailAddress= isset($_POST['emailAddressS'])?$_POST['emailAddressS']:'';
        $password = isset($_POST['passwordS'])?$_POST['passwordS']:'';
   	 // cheks in the mysql directory
	 $pssw = md5 (md5 ($password) . $emailAddress);
        $sql = mysql_query("SELECT * FROM members WHERE password='$pssw' AND emailAddress='$emailAddress'"); 
        $emailAddressE=md5($emailAddress."emailAddress");
        $login_check = mysql_num_rows($sql);
   	 // if the program founds by that name and password then sends a "all good" data to the falsh
   	 // if not then "no good"
        if($login_check > 0){ 
              $validation_errorsS="loging you in...";
			  
			  if (isset($_POST['remember_me'])) {
         
	 setcookie('em', $emailAddressE, time()+60*60*24*365);
     setcookie('sub', $pssw, time()+60*60*24*365);
    
        
        } else {
            /* Cookie expires when browser closes */
      setcookie('em', $emailAddressE, false);
     setcookie('sub', $pssw, false);
    
        }
			  
		header("Location: http://localhost/yc/apps.php");			  
			  
			  
        } else {
   	       $validation_errorsS="The emailaddress or password you entered is incorrect. Please try again or sign up!";
   	 }
   	 // I need to use mysql_query( 
   	mysql_query("UPDATE members  SET lastLoginf = NOW() WHERE  emailAddress='$emailAddress'"); //updating users lastlogin tim
           
       }
       else
       {
           //Validations failed. Display Errors.
           $error_hash = $validator->GetErrors();
           foreach($error_hash as $inpname => $inp_err)
           {
              $validation_errorsS .= "<p>$inp_err</p>\n";//"<p>$inpname : $inp_err</p>\n";
           }        
       }
   }//if
   $disp_emailS = isset($_POST['emailAddressS'])?$_POST['emailAddressS']:'';
   ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>YaChatt | Home</title>
<link href="assets/demoStyles.css?1.0" rel=stylesheet type="text/css"/>
</head>
<body>
<div id=target class="backg loader">
  <div  style="position: absolute;   bottom:1%;  right: 0px; left: 0px;">
    <table cellspacing="1"   align="center"   border="0" cellpadding="0">
      <tr valign="top" align="left">
        <td   width="400"><form class="checkout checkS"    method='post' accept-charset='UTF-8'>
            <div> <span  style=" font:Arial; color:#78AB46; font-size:20px;"class='error'><?php echo $validation_errorsS; ?></span> </div>
            <input type='hidden' name='submittedS' id='submittedS' value='1'/>
            <p>
              <input type="text" class="checkout-input checkout-name" placeholder="Email Address"  id="emailAddress" title="Email Address" autocomplete="on" name="emailAddressS" required x-moz-errormessage="Fill in your Email Address"value="<?php echo $disp_emailS; ?>" autofocus>
            </p>
            <p>
              <input type="Password" class="checkout-input checkout-exp" placeholder="Password"  id="password" title="Password" required x-moz-errormessage="Fill in your Password" name="passwordS">
              &nbsp;
              <input type="submit"  value="Sign In" id="signIn"  name="SubmitS
                              " class="checkout-btn">
            </p>
            <label class="remember" style="cursor:pointer;">
              <input type="checkbox" value="1" name="remember_me" style="cursor:pointer;" checked>
              <font color="#999999" face="Arial" size="3" > Remember me</font> </label>
          </form></td>
        <td width="1" style="background-color:#CCC;"></td>
        <td width="400" valign="top" align="left"><form class="checkout checkB"    method='post' accept-charset='UTF-8' enctype="multipart/form-data">
            <div> <span  style=" font:Arial; color:#78AB46; font-size:20px;"class='error'><?php echo $validation_errors; ?></span> </div>
            <input type='hidden' name='submitted' id='submitted' value='1'/>
            <p>
              <input type="text" class="checkout-input checkout-name"  required x-moz-errormessage="Fill in your Name" placeholder="Full Name" id="nameU"  title="Full Name" name="userName" value="<?php echo $disp_name; ?>">&nbsp;&nbsp;<img src="images/accept.png" id="crrctN" style="visibility:hidden">
            </p>
          <p><input type="text" class="checkout-input checkout-name" required x-moz-errormessage="Fill in your Email Address" title="Email Address" id="emailU" placeholder="Email Address" name="emailAddress" value="<?php echo $disp_email; ?>">&nbsp;&nbsp;<img src="images/accept.png" id="crrctE" style="visibility:hidden">
            </p>
            <p>
              <input type="Password" id="passU" class="checkout-input checkout-exp" required x-moz-errormessage="Fill in your password"  title="Password" placeholder="Password" name="password">&nbsp;&nbsp; <font color="#FF0000" id="crrctP" style=" vertical-align:middle;visibility:hidden" face="Arial" size="2" > Too short</font> 
            </p>
                       
      <p>
              <input type="Password" id="passrU" class="checkout-input checkout-exp"  required x-moz-errormessage="Fill in your password"  title="Retype Password" placeholder="Retype Password" name="rePassword" >&nbsp;&nbsp;<font color="#FF0000" id="crrctRP" style=" vertical-align:middle;visibility:hidden" face="Arial" size="2" > Do not match</font> 
           </p>
              
            <p> <select id="country" name="country" class="country"><option value="AF">Afghanistan (افغانستان‎)</option><option value="AX">Aland Islands</option><option value="AL">Albania (Shqipëria)</option><option value="DZ">Algeria (الجزائر‎)</option><option value="AS">American Samoa</option><option value="AD">Andorra</option><option value="AO">Angola</option><option value="AI">Anguilla</option><option value="AQ">Antarctica</option><option value="AG">Antigua and Barbuda</option><option value="AR">Argentina</option><option value="AM">Armenia (Հայաստան)</option><option value="AW">Aruba</option><option value="AU">Australia</option><option value="AT">Austria (Österreich)</option><option value="AZ">Azerbaijan (Azərbaycan)</option><option value="BS">Bahamas</option><option value="BH">Bahrain (البحرين‎)</option><option value="BD">Bangladesh (বাংলাদেশ)</option><option value="BB">Barbados</option><option value="BY">Belarus (Беларусь)</option><option value="BE">Belgium (België)</option><option value="BZ">Belize</option><option value="BJ">Benin (Bénin)</option><option value="BM">Bermuda</option><option value="BT">Bhutan (འབྲུག)</option><option value="BO">Bolivia,Plurinational State of</option><option value="BQ">Bonaire,Sint Eustatius and Saba</option><option value="BA">Bosnia and Herzegovina (Босна и Херцеговина)</option><option value="BW">Botswana</option><option value="BV">Bouvet Island</option><option value="BR">Brazil (Brasil)</option><option value="IO">British Indian Ocean Territory</option><option value="BN">Brunei Darussalam</option><option value="BG">Bulgaria (България)</option><option value="BF">Burkina Faso</option><option value="BI">Burundi (Uburundi)</option><option value="KH">Cambodia (កម្ពុជា)</option><option value="CM">Cameroon (Cameroun)</option><option value="CA">Canada</option><option value="CV">Cape Verde (Kabu Verdi)</option><option value="KY">Cayman Islands</option><option value="CF">Central African Republic (République centrafricaine)</option><option value="TD">Chad (Tchad)</option><option value="CL">Chile</option><option value="CN">China (中国)</option><option value="CX">Christmas Island</option><option value="CC">Cocos (Keeling) Islands</option><option value="CO">Colombia</option><option value="KM">Comoros (جزر القمر‎)</option><option value="CG">Congo (Congo-Brazzaville)</option><option value="CD">Congo,the Democratic Republic of the (Jamhuri ya Kidemokrasia ya Kongo)</option><option value="CK">Cook Islands</option><option value="CR">Costa Rica</option><option value="CI">Cote d'Ivoire</option><option value="HR">Croatia (Hrvatska)</option><option value="CU">Cuba</option><option value="CW">Curacao</option><option value="CY">Cyprus (Κύπρος)</option><option value="CZ">Czech Republic (Česká republika)</option><option value="DK">Denmark (Danmark)</option><option value="DJ">Djibouti</option><option value="DM">Dominica</option><option value="DO">Dominican Republic (República Dominicana)</option><option value="EC">Ecuador</option><option value="EG">Egypt (مصر‎)</option><option value="SV">El Salvador</option><option value="GQ">Equatorial Guinea (Guinea Ecuatorial)</option><option value="ER">Eritrea</option><option value="EE">Estonia (Eesti)</option><option value="ET">Ethiopia</option><option value="FK">Falkland Islands (Islas Malvinas)</option><option value="FO">Faroe Islands (Føroyar)</option><option value="FJ">Fiji</option><option value="FI">Finland (Suomi)</option><option value="FR">France</option><option value="GF">French Guiana (Guyane française)</option><option value="PF">French Polynesia (Polynésie française)</option><option value="TF">French Southern Territories (Terres australes françaises)</option><option value="GA">Gabon</option><option value="GM">Gambia</option><option value="GE">Georgia (საქართველო)</option><option value="DE">Germany (Deutschland)</option><option value="GH">Ghana (Gaana)</option><option value="GI">Gibraltar</option><option value="GR">Greece (Ελλάδα)</option><option value="GL">Greenland (Kalaallit Nunaat)</option><option value="GD">Grenada</option><option value="GP">Guadeloupe</option><option value="GU">Guam</option><option value="GT">Guatemala</option><option value="GG">Guernsey</option><option value="GN">Guinea (Guinée)</option><option value="GW">Guinea-Bissau (Guiné Bissau)</option><option value="GY">Guyana</option><option value="HT">Haiti</option><option value="HM">Heard Island and McDonald Islands</option><option value="VA">Holy See (Vatican City State) (Città del Vaticano)</option><option value="HN">Honduras</option><option value="HK">Hong Kong (香港)</option><option value="HU">Hungary (Magyarország)</option><option value="IS">Iceland (Ísland)</option><option value="IN">India (भारत)</option><option value="ID">Indonesia</option><option value="IR">Iran,Islamic Republic of (ایران‎)</option><option value="IQ">Iraq (العراق‎)</option><option value="IE">Ireland</option><option value="IM">Isle of Man</option><option value="IL">Israel (ישראל‎)</option><option value="IT">Italy (Italia)</option><option value="JM">Jamaica</option><option value="JP">Japan (日本)</option><option value="JE">Jersey</option><option value="JO">Jordan (الأردن‎)</option><option value="KZ">Kazakhstan (Казахстан)</option><option value="KE">Kenya</option><option value="KI">Kiribati</option><option value="KP">Korea,Democratic People's Republic of (조선 민주주의 인민 공화국)</option><option value="KR">Korea,Republic of (대한민국)</option><option value="KW">Kuwait (الكويت‎)</option><option value="KG">Kyrgyzstan</option><option value="LA">Lao People's Democratic Republic (ສ.ປ.ປ ລາວ)</option><option value="LV">Latvia (Latvija)</option><option value="LB">Lebanon (لبنان‎)</option><option value="LS">Lesotho</option><option value="LR">Liberia</option><option value="LY">Libya (ليبيا‎)</option><option value="LI">Liechtenstein</option><option value="LT">Lithuania (Lietuva)</option><option value="LU">Luxembourg</option><option value="MO">Macao (澳門)</option><option value="MK">Macedonia,the former Yugoslav Republic of (Македонија)</option><option value="MG">Madagascar (Madagasikara)</option><option value="MW">Malawi</option><option value="MY">Malaysia</option><option value="MV">Maldives</option><option value="ML">Mali</option><option value="MT">Malta</option><option value="MH">Marshall Islands</option><option value="MQ">Martinique</option><option value="MR">Mauritania (موريتانيا‎)</option><option value="MU">Mauritius (Moris)</option><option value="YT">Mayotte</option><option value="MX">Mexico (México)</option><option value="FM">Micronesia,Federated States of</option><option value="MD">Moldova,Republic of (Republica Moldova)</option><option value="MC">Monaco</option><option value="MN">Mongolia (Монгол)</option><option value="ME">Montenegro (Crna Gora)</option><option value="MS">Montserrat</option><option value="MA">Morocco (المغرب‎)</option><option value="MZ">Mozambique (Moçambique)</option><option value="MM">Myanmar (မြန်မာ)</option><option value="NA">Namibia</option><option value="NR">Nauru</option><option value="NP">Nepal (नेपाल)</option><option value="NL">Netherlands (Nederland)</option><option value="NC">New Caledonia (Nouvelle-Calédonie)</option><option value="NZ">New Zealand</option><option value="NI">Nicaragua</option><option value="NE">Niger (Nijar)</option><option value="NG">Nigeria</option><option value="NU">Niue</option><option value="NF">Norfolk Island</option><option value="MP">Northern Mariana Islands</option><option value="NO">Norway (Norge)</option><option value="OM">Oman (عُمان‎)</option><option value="PK">Pakistan (پاکستان‎)</option><option value="PW">Palau</option><option value="PS">Palestine,State of (فلسطين‎)</option><option value="PA">Panama (Panamá)</option><option value="PG">Papua New Guinea</option><option value="PY">Paraguay</option><option value="PE">Peru</option><option value="PH">Philippines</option><option value="PN">Pitcairn</option><option value="PL">Poland (Polska)</option><option value="PT">Portugal</option><option value="PR">Puerto Rico</option><option value="QA">Qatar (قطر‎)</option><option value="RE">Reunion</option><option value="RO">Romania (România)</option><option value="RU">Russian Federation (Россия)</option><option value="RW">Rwanda</option><option value="BL">Saint Barth\u00e9lemy (Saint-Barthélémy)</option><option value="SH">Saint Helena,Ascension and Tristan da Cunha</option><option value="KN">Saint Kitts and Nevis</option><option value="LC">Saint Lucia</option><option value="MF">Saint Martin [French part] (Saint-Martin [partie française])</option><option value="PM">Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)</option><option value="VC">Saint Vincent and the Grenadines</option><option value="WS">Samoa</option><option value="SM">San Marino</option><option value="ST">Sao Tome and Principe (São Tomé e Príncipe)</option><option value="SA">Saudi Arabia (المملكة العربية السعودية‎)</option><option value="SN">Senegal (Sénégal)</option><option value="RS">Serbia (Србија)</option><option value="SC">Seychelles</option><option value="SL">Sierra Leone</option><option value="SG">Singapore</option><option value="SX">Sint Maarten (Dutch part)</option><option value="SK">Slovakia (Slovensko)</option><option value="SI">Slovenia (Slovenija)</option><option value="SB">Solomon Islands</option><option value="SO">Somalia (Soomaaliya)</option><option value="ZA">South Africa</option><option value="GS">South Georgia and the South Sandwich Islands</option><option value="SS">South Sudan (جنوب السودان‎)</option><option value="ES">Spain</option><option value="LK">Sri Lanka (ශ්‍රී ලංකාව))</option><option value="SD">Sudan (السودان‎)</option><option value="SR">Suriname</option><option value="SJ">Svalbard and Jan Mayen (Svalbard og Jan Mayen)</option><option value="SZ">Swaziland</option><option value="SE">Sweden (Sverige)</option><option value="CH">Switzerland (Schweiz)</option><option value="SY">Syrian Arab Republic (سوريا‎)</option><option value="TW">Taiwan (台灣)</option><option value="TJ">Tajikistan</option><option value="TZ">Tanzania,United Republic of</option><option value="TH">Thailand (ไทย)</option><option value="TL">Timor-Leste</option><option value="TG">Togo</option><option value="TK">Tokelau</option><option value="TO">Tonga</option><option value="TT">Trinidad and Tobago</option><option value="TN">Tunisia (تونس‎)</option><option value="TR">Turkey (Türkiye)</option><option value="TM">Turkmenistan</option><option value="TC">Turks and Caicos Islands</option><option value="TV">Tuvalu</option><option value="UG">Uganda</option><option value="UA">Ukraine (Україна)</option><option value="AE">United Arab Emirates (الإمارات العربية المتحدة‎)</option><option value="GB">United Kingdom</option><option value="US" selected="selected">United States</option><option value="UM">United States Minor Outlying Islands</option><option value="UY">Uruguay</option><option value="UZ">Uzbekistan (Ўзбекистон)</option><option value="VU">Vanuatu</option><option value="VE">Venezuela,Bolivarian Republic of</option><option value="VN">Vietnam (Việt Nam)</option><option value="VG">Virgin Islands,British</option><option value="VI">Virgin Islands,U.S.</option><option value="WF">Wallis and Futuna</option><option value="EH">Western Sahara (الصحراء الغربية‎)</option><option value="YE">Yemen (اليمن‎)</option><option value="ZM">Zambia</option><option value="ZW">Zimbabwe</option></select>
</p>
    <p>    
    <label class="gender">
        <input id="fem" name="gender" value="female" type="radio">
       <span>Female</span>
</label>
<label  class="gender ">
      <input   id="mal" name="gender" value="male" type="radio">
      <span >Male</span>
    </label> </p>
    <p>
             <font  class="tab">By signing up, you agree to our Terms of Service and Privacy Policy including our Cookie Use.
           </font></p>
        <p align="right"> <input type="submit" class="checkout-btn" id="signUp"  value="Sign up"  name="sendRequest" ></p> </form></td>
      </tr>
    </table>
  </div>
</div>
<header id=topdiv class=EaselJS> <a id=bottomBtn href="http://localhost/yc" class=button>Yachatt</a> </header>
<footer id=bottomdiv>
  <nav>
    <?php
		 ob_start();
		include 'data.php';
		ob_end_clean();
		 
		  for($x=0;$x<count($pages);$x++)
		 { $pieces = explode(",", $pages[$x]);
		 if($pieces[1]=="Home"){$currPage=' btnclick"';}else $currPage='"';
		 echo '<a id=bottomBtn_'.$x.' class="clicked'.$currPage.' href='.$pieces[0].'>'.$pieces[1].'</a>';}
		  ?>
    &nbsp; &nbsp; &nbsp; &copy;2013 Yachatt </nav>
</footer>
<style>
.tab{
	color:#999999;
	font-family: inherit;
	font-size: 17px;
	margin-right:130px;
}
.country {
    border-radius: 6px;
    height: 30px;
    width:300px;
	font-family: inherit;
	font-size: 18px;
	color: #555;
    border: 1px solid #c0ccea;
    cursor: pointer;
    padding: 4px 4px 4px 4px;
}
.country:focus{
	border-color: #46aefe;
	outline: none;
	-webkit-box-shadow: 0px 0px 7px #46aefe;
	-moz-box-shadow: 0px 0px 7px #78AB46;
	box-shadow: 0px 0px 7px #78AB46;}
.gender{
	cursor:pointer;
	height: 30px;
	font-size: 20px;
	color: #333333;
	}
	p { margin:5px }
</style>
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script> 
<script>
//$("#signIn").
$(function(){
 $("#signIn").attr("disabled", "disabled");
  $("#signUp").attr("disabled", "disabled");
    var validated = false,emailL=false,passL=false,nameU=false,passU=false,emailU=false,passrU=false,passU1=false,passU2=false,gend=false;
	function validateEmail(email) { 
var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}
$('#emailAddress').keyup(function () {
    validated = false
    if (validateEmail($('#emailAddress').val())) {
        emailL = true;
        if (passL) validated = true;
    } else {
        validated = false;
        $("#signIn").attr("disabled", "disabled");
        emailL = false;
    }

    if (validated) $("#signIn").removeAttr("disabled");
});

$('#password').keyup(function () {
    validated = false
    if ($('#password').val().length != 0) {
        passL = true;
        if (emailL) validated = true;
    } else {
        validated = false;
        $("#signIn").attr("disabled", "disabled");
        passL = false;
    }

    if (validated) 
			$("#signIn").removeAttr("disabled");

});


////////////////////////////////////////////////////////  

$('#emailU').keyup(function () {
    validated = false
    if (validateEmail($('#emailU').val())) {
        emailU = true;
		$('#crrctE').attr('src',"images/accept.png")
	    $('#crrctE').css('visibility','visible');
        if (gend&&nameU && (passU || passrU)) validated = true;
    } else {
        validated = false;
			$('#crrctE').attr('src',"images/error.png")
	$('#crrctE').css('visibility','visible');
        $("#signUp").attr("disabled", "disabled");
        emailU = false;
    }
	
    if (validated) {
		
		$("#signUp").removeAttr("disabled");}
});

$('#nameU').keyup(function () {
    validated = false
    if ($('#nameU').val().length != 0) {
        nameU = true;
		$('#crrctN').attr('src',"images/accept.png")
	    $('#crrctN').css('visibility','visible');
        if (gend&&emailU && (passU || passrU)) validated = true;
    } else {
        validated = false;
		$('#crrctN').attr('src',"images/error.png")
	$('#crrctN').css('visibility','visible');
        $("#signUp").attr("disabled", "disabled");
        nameU = false;
    }

    if (validated){ 
	$("#signUp").removeAttr("disabled");}	
	
});

$('#passU').keyup(function () {
    validated = false
    if ($('#passU').val().length >=6) {
        passU1 = true;
 		$('#crrctP').html('')
			$('#crrctP').css('visibility','visible');
        if (gend&&passU2 && $('#passU').val() == $('#passrU').val()) {
            passU = true;
	   	  
            if (gend&&nameU && emailU) validated = true;
        } else {
            validated = false;
            $("#signUp").attr("disabled", "disabled");
            passU = false;
        }
    }else{
			 $('#crrctP').html("Too short");
			 $('#crrctP').css('visibility','visible');
			 $("#signUp").attr("disabled", "disabled");}

    if (validated) $("#signUp").removeAttr("disabled");
});

$('#passrU').keyup(function () {
validated = false
if ($('#passrU').val().length != 0) {
    passU2 = true;

    if (passU1 && ($('#passU').val() == $('#passrU').val())) {
        passrU = true;
		$('#crrctRP').html("Match");
		$('#crrctRP').attr('color',"#6EC02A")
		$('#crrctRP').css('visibility','visible');
        if (gend&&nameU && emailU) validated = true;
    } else {
        validated = false;
		$('#crrctRP').html("Do not Match");
		$('#crrctRP').attr('color',"#FF0000")
		$('#crrctRP').css('visibility','visible');
        $("#signUp").attr("disabled", "disabled");
        passrU = false;
    }
}

if (validated) $("#signUp").removeAttr("disabled");
});



$('#fem').click(function() {
 gend=true; 
 if($('#fem').is(':checked'))
 if (nameU&&emailU && (passU || passrU)) 
  $("#signUp").removeAttr("disabled");
});


$('#mal').click(function() {
  gend=true; 
  if($('#mal').is(':checked'))
  if (nameU&&emailU && (passU || passrU)) 
	  $("#signUp").removeAttr("disabled");

})
})
</script>
</body>
</html>