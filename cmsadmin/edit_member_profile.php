<?php
include("../lib/config.php");
// manage secure login of user account
if(!isset($_SESSION['token_id'])){
  header("Location:login.php");
}
else if(isset($_SESSION['token_id'])){
  if($_SESSION['token_id'] != md5($_SESSION['user_id'])){
    header("Location:login.php");
  }
  
  else{
  
    $condition = " where user_id ='".$_SESSION['user_id']."'";
    $sql = $obj_rep->query('*', 'admin',$condition);
	$args_user=$obj_rep->get_all_row($sql);
  }
}
// store random no for security
$_SESSION['rand'] = mt_rand(1111111,9999999); 



    $id=$_GET['id'];
    $f=mysql_fetch_array(mysql_query("select * from user_registration where id='$id' "));
    $userimage = $f['image'];
    $userid=$f['user_id'];



if(isset($_POST['submit']))
{
$first1=$_POST['first_name1'];
$first2=$_POST['first_name2'];  
$first3=$_POST['first_name3'];  
$first4=$_POST['first_name4'];  
$first5=$_POST['first_name5'];  
$first6=$_POST['first_name6'];  
$first7=$_POST['first_name7'];  
$first8=$_POST['first_name8'];  
$first9=$_POST['first_name9'];  
$first10=$_POST['first_name10'];  
$first11=$_POST['first_name11'];  
$first12=$_POST['first_name12'];  
$first13=$_POST['first_name13'];  

// echo "update user_registration set first_name='$first1', last_name='$first2', email='$first3', password='$first4', t_code='$first5', address='$first6', country='$first7', state='$first8', city='$first9',  telephone='$first11', dob='$first12', sex='$first13'  where user_id='$userid'";
// exit();

mysql_query("update user_registration set first_name='$first1', last_name='$first2', email='$first3', password='$first4', t_code='$first5', address='$first6', country='$first7', state='$first8', city='$first9', zipcode='$first10', telephone='$first11', dob='$first12', sex='$first13'  where user_id='$userid'");
/*header("location:edit_member_profile.php?id=<?php echo $f['id'];?>&msg=Profile Information Updated Successfully !");*/
echo "<script>window.location.href='edit_member_profile.php?id=". $id."&msg=Profile Information Updated Successfully !'</script>"; 

//header("location:member-list.php"); 

}


if(isset($_POST['update']))
{
  $first21=$_POST['Account1'];
  $first22=$_POST['Account2'];
  $first23=$_POST['Account3'];
  $first24=$_POST['Account4'];
  $first25=$_POST['Account5'];

mysql_query("update user_registration set acc_name='$first21', bank_nm='$first22', branch_nm='$first23', ac_no='$first24', swift_code='$first25' where user_id='$userid'");
//header("location:update-profile.php?msg=Bank Detail Updated Successfully !"); 
//header("location:member-list.php"); 
echo "<script>window.location.href='edit_member_profile.php?id=". $id."&msg1=Bank Detail Updated Successfully !'</script>"; 
}




// if(isset($_POST['modify']))
// {
// $filename12 = time()."main_".$_FILES["uploadedfile"]["name"];
// move_uploaded_file($_FILES["uploadedfile"]["tmp_name"],"images/" .$filename12);
// mysql_query("update user_registration set image='$filename12' where user_id='$userid'");
// header("location:update-profile.php?msg=Profile Picture Updated Successfully !");  
// }


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <?php include("header.php");?>

    <!--easy pie chart-->
    <link href="css/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen" />

    <!--vector maps -->
    <link rel="stylesheet" href="css/jquery-jvectormap-1.1.1.css">

    <!--right slidebar-->
    <link href="css/slidebars.css" rel="stylesheet">

    <!--switchery-->
    <link href="css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />

    <!--jquery-ui-->
    <link href="css/jquery-ui-1.10.1.custom.min.css" rel="stylesheet" />

    <!--iCheck-->
    <link href="css/all.css" rel="stylesheet">

    <link href="css/owl.carousel.css" rel="stylesheet">


    <!--common style-->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

<body class="sticky-header">

    <section>
        <!-- sidebar left start-->
     <?php include("sidebar.php");?>
        <!-- sidebar left end-->

        <!-- body content start-->
        <div class="body-content" style="min-height: 1000px;">

            <!-- header section start-->
    <?php include("top-menu.php");?>

            <!-- header section end-->

            <!-- page head start-->
            <div class="page-head">
                <h3 class="m-b-less">
                   Dashboard
                </h3>
                <!--<span class="sub-title">Welcome to Static Table</span>-->
                 <?php include("top-menu1.php");?>
           
            <!-- page head end-->

            <!--body wrapper start-->
            <div class="wrapper">

            <div class="row">
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Update member Profile<span style="float:right;color:red;"><?php echo @$_GET['msg'];?></span>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="post">
                             <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Present</label>
                                    <div class="col-lg-10">
                                         <?php $user=mysql_fetch_array(mysql_query("select * from final_e_wallet where user_id='".$_GET['id']."'")); echo number_format($user['amount'],2);?> Amount in wallet
                                
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Sponsor ID</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="sponsorid" class="form-control" placeholder="Enter Userid / Username" required value="<?php echo $f['ref_id'];?>" readonly>
                                       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Sponsor Name</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="sponsorname" class="form-control" id="inputPassword1" value="<?php $mxDb->get_field_information('user_registration', "concat_ws(' ', first_name, last_name)", " where user_id=".$f['ref_id'],'assoc',true); ?>"required readonly>
                                      
                                    </div>
                                </div>
                                        <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">User Registration Date</label>
                                    <div class="col-lg-10">
                                        <input type="test" name="regdate" class="form-control"  placeholder="Enter the description" value="<?php echo $f['registration_date'];?>" required readonly>
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label"><!-- Personal Information --></label>
                                   <div class="col-lg-10">
                                          <h3>Personal Information</h3>
                                
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Userid</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="userid" class="form-control" placeholder="Enter Userid / Username" required value="<?php echo $f['user_id'];?>" readonly readonly>
                                       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Username</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="username" class="form-control" id="inputPassword1"  value="<?php echo $f['username'];?>" required readonly>
                                        
                                    </div>
                                </div>
                                        <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">First Name</label>
                                    <div class="col-lg-10">
                                        <input type="test"name="first_name1" value="<?php echo $f['first_name'];?>" class="form-control" placeholder="Enter the First Name"  required>
                                        
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Last Name</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="first_name2" class="form-control" placeholder="Enter Last Name" required value="<?php echo $f['last_name'];?>" >
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Email</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="first_name3" class="form-control"    value="<?php echo $f['email'];?>"  placeholder="Enter the Email">
                                       
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Contactno</label>
                                    <div class="col-lg-10">
                                        <input type="number" name="first_name11" value="<?php echo $f['telephone'];?>" class="form-control" placeholder="Enter the Contactno">
                                       
                                    </div>
                                </div>
                                        <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Address</label>
                                    <div class="col-lg-10">
                                        <input type="test" name="first_name6" class="form-control" id="inputPassword1" placeholder="Enter the Address" value="<?php echo $f['address'];?>" required>
                                        
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Country</label>
                                    <div class="col-lg-10">
                                        <select class="form-control" name="first_name7">
                      <option value="<?php echo $f['country'];?>"><?php echo $f['country'];?></option>
                      <option value="United States">United States</option> 
                      <option value="United Kingdom">United Kingdom</option> 
                      <option value="Afghanistan">Afghanistan</option> 
                      <option value="Albania">Albania</option> 
                      <option value="Algeria">Algeria</option> 
                      <option value="American Samoa">American Samoa</option> 
                      <option value="Andorra">Andorra</option> 
                      <option value="Angola">Angola</option> 
                      <option value="Anguilla">Anguilla</option> 
                      <option value="Antarctica">Antarctica</option> 
                      <option value="Antigua and Barbuda">Antigua and Barbuda</option> 
                      <option value="Argentina">Argentina</option> 
                      <option value="Armenia">Armenia</option> 
                      <option value="Aruba">Aruba</option> 
                      <option value="Australia">Australia</option> 
                      <option value="Austria">Austria</option> 
                      <option value="Azerbaijan">Azerbaijan</option> 
                      <option value="Bahamas">Bahamas</option> 
                      <option value="Bahrain">Bahrain</option> 
                      <option value="Bangladesh">Bangladesh</option> 
                      <option value="Barbados">Barbados</option> 
                      <option value="Belarus">Belarus</option> 
                      <option value="Belgium">Belgium</option> 
                      <option value="Belize">Belize</option> 
                      <option value="Benin">Benin</option> 
                      <option value="Bermuda">Bermuda</option> 
                      <option value="Bhutan">Bhutan</option> 
                      <option value="Bolivia">Bolivia</option> 
                      <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
                      <option value="Botswana">Botswana</option> 
                      <option value="Bouvet Island">Bouvet Island</option> 
                      <option value="Brazil">Brazil</option> 
                      <option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
                      <option value="Brunei Darussalam">Brunei Darussalam</option> 
                      <option value="Bulgaria">Bulgaria</option> 
                      <option value="Burkina Faso">Burkina Faso</option> 
                      <option value="Burundi">Burundi</option> 
                      <option value="Cambodia">Cambodia</option> 
                      <option value="Cameroon">Cameroon</option> 
                      <option value="Canada">Canada</option> 
                      <option value="Cape Verde">Cape Verde</option> 
                      <option value="Cayman Islands">Cayman Islands</option> 
                      <option value="Central African Republic">Central African Republic</option> 
                      <option value="Chad">Chad</option> 
                      <option value="Chile">Chile</option> 
                      <option value="China">China</option> 
                      <option value="Christmas Island">Christmas Island</option> 
                      <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
                      <option value="Colombia">Colombia</option> 
                      <option value="Comoros">Comoros</option> 
                      <option value="Congo">Congo</option> 
                      <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 
                      <option value="Cook Islands">Cook Islands</option> 
                      <option value="Costa Rica">Costa Rica</option> 
                      <option value="Cote D'ivoire">Cote D'ivoire</option> 
                      <option value="Croatia">Croatia</option> 
                      <option value="Cuba">Cuba</option> 
                      <option value="Cyprus">Cyprus</option> 
                      <option value="Czech Republic">Czech Republic</option> 
                      <option value="Denmark">Denmark</option> 
                      <option value="Djibouti">Djibouti</option> 
                      <option value="Dominica">Dominica</option> 
                      <option value="Dominican Republic">Dominican Republic</option> 
                      <option value="Ecuador">Ecuador</option> 
                      <option value="Egypt">Egypt</option> 
                      <option value="El Salvador">El Salvador</option> 
                      <option value="Equatorial Guinea">Equatorial Guinea</option> 
                      <option value="Eritrea">Eritrea</option> 
                      <option value="Estonia">Estonia</option> 
                      <option value="Ethiopia">Ethiopia</option> 
                      <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
                      <option value="Faroe Islands">Faroe Islands</option> 
                      <option value="Fiji">Fiji</option> 
                      <option value="Finland">Finland</option> 
                      <option value="France">France</option> 
                      <option value="French Guiana">French Guiana</option> 
                      <option value="French Polynesia">French Polynesia</option> 
                      <option value="French Southern Territories">French Southern Territories</option> 
                      <option value="Gabon">Gabon</option> 
                      <option value="Gambia">Gambia</option> 
                      <option value="Georgia">Georgia</option> 
                      <option value="Germany">Germany</option> 
                      <option value="Ghana">Ghana</option> 
                      <option value="Gibraltar">Gibraltar</option> 
                      <option value="Greece">Greece</option> 
                      <option value="Greenland">Greenland</option> 
                      <option value="Grenada">Grenada</option> 
                      <option value="Guadeloupe">Guadeloupe</option> 
                      <option value="Guam">Guam</option> 
                      <option value="Guatemala">Guatemala</option> 
                      <option value="Guinea">Guinea</option> 
                      <option value="Guinea-bissau">Guinea-bissau</option> 
                      <option value="Guyana">Guyana</option> 
                      <option value="Haiti">Haiti</option> 
                      <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 
                      <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
                      <option value="Honduras">Honduras</option> 
                      <option value="Hong Kong">Hong Kong</option> 
                      <option value="Hungary">Hungary</option> 
                      <option value="Iceland">Iceland</option> 
                      <option value="India">India</option> 
                      <option value="Indonesia">Indonesia</option> 
                      <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
                      <option value="Iraq">Iraq</option> 
                      <option value="Ireland">Ireland</option> 
                      <option value="Israel">Israel</option> 
                      <option value="Italy">Italy</option> 
                      <option value="Jamaica">Jamaica</option> 
                      <option value="Japan">Japan</option> 
                      <option value="Jordan">Jordan</option> 
                      <option value="Kazakhstan">Kazakhstan</option> 
                      <option value="Kenya">Kenya</option> 
                      <option value="Kiribati">Kiribati</option> 
                      <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 
                      <option value="Korea, Republic of">Korea, Republic of</option> 
                      <option value="Kuwait">Kuwait</option> 
                      <option value="Kyrgyzstan">Kyrgyzstan</option> 
                      <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
                      <option value="Latvia">Latvia</option> 
                      <option value="Lebanon">Lebanon</option> 
                      <option value="Lesotho">Lesotho</option> 
                      <option value="Liberia">Liberia</option> 
                      <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
                      <option value="Liechtenstein">Liechtenstein</option> 
                      <option value="Lithuania">Lithuania</option> 
                      <option value="Luxembourg">Luxembourg</option> 
                      <option value="Macao">Macao</option> 
                      <option value="Macedonia">Macedonia</option> 
                      <option value="Madagascar">Madagascar</option> 
                      <option value="Malawi">Malawi</option> 
                      <option value="Malaysia">Malaysia</option> 
                      <option value="Maldives">Maldives</option> 
                      <option value="Mali">Mali</option> 
                      <option value="Malta">Malta</option> 
                      <option value="Marshall Islands">Marshall Islands</option> 
                      <option value="Martinique">Martinique</option> 
                      <option value="Mauritania">Mauritania</option> 
                      <option value="Mauritius">Mauritius</option> 
                      <option value="Mayotte">Mayotte</option> 
                      <option value="Mexico">Mexico</option> 
                      <option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
                      <option value="Moldova, Republic of">Moldova, Republic of</option> 
                      <option value="Monaco">Monaco</option> 
                      <option value="Mongolia">Mongolia</option> 
                      <option value="Montserrat">Montserrat</option> 
                      <option value="Morocco">Morocco</option> 
                      <option value="Mozambique">Mozambique</option> 
                      <option value="Myanmar">Myanmar</option> 
                      <option value="Namibia">Namibia</option> 
                      <option value="Nauru">Nauru</option> 
                      <option value="Nepal">Nepal</option> 
                      <option value="Netherlands">Netherlands</option> 
                      <option value="Netherlands Antilles">Netherlands Antilles</option> 
                      <option value="New Caledonia">New Caledonia</option> 
                      <option value="New Zealand">New Zealand</option> 
                      <option value="Nicaragua">Nicaragua</option> 
                      <option value="Niger">Niger</option>
                      <option value="Nigeria">Nigeria</option>
                      <option value="Niue">Niue</option> 
                      <option value="Norfolk Island">Norfolk Island</option> 
                      <option value="Northern Mariana Islands">Northern Mariana Islands</option> 
                      <option value="Norway">Norway</option> 
                      <option value="Oman">Oman</option> 
                      <option value="Pakistan">Pakistan</option> 
                      <option value="Palau">Palau</option> 
                      <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
                      <option value="Panama">Panama</option> 
                      <option value="Papua New Guinea">Papua New Guinea</option> 
                      <option value="Paraguay">Paraguay</option> 
                      <option value="Peru">Peru</option> 
                      <option value="Philippines">Philippines</option> 
                      <option value="Pitcairn">Pitcairn</option> 
                      <option value="Poland">Poland</option> 
                      <option value="Portugal">Portugal</option> 
                      <option value="Puerto Rico">Puerto Rico</option> 
                      <option value="Qatar">Qatar</option> 
                      <option value="Reunion">Reunion</option> 
                      <option value="Romania">Romania</option> 
                      <option value="Russian Federation">Russian Federation</option> 
                      <option value="Rwanda">Rwanda</option> 
                      <option value="Saint Helena">Saint Helena</option> 
                      <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
                      <option value="Saint Lucia">Saint Lucia</option> 
                      <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
                      <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 
                      <option value="Samoa">Samoa</option> 
                      <option value="San Marino">San Marino</option> 
                      <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
                      <option value="Saudi Arabia">Saudi Arabia</option> 
                      <option value="Senegal">Senegal</option> 
                      <option value="Serbia and Montenegro">Serbia and Montenegro</option> 
                      <option value="Seychelles">Seychelles</option> 
                      <option value="Sierra Leone">Sierra Leone</option> 
                      <option value="Singapore">Singapore</option> 
                      <option value="Slovakia">Slovakia</option> 
                      <option value="Slovenia">Slovenia</option> 
                      <option value="Solomon Islands">Solomon Islands</option> 
                      <option value="Somalia">Somalia</option> 
                      <option value="South Africa">South Africa</option> 
                      <option value="South Georgia">South Georgia</option> 
                      <option value="Spain">Spain</option> 
                      <option value="Sri Lanka">Sri Lanka</option> 
                      <option value="Sudan">Sudan</option> 
                      <option value="Suriname">Suriname</option> 
                      <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
                      <option value="Swaziland">Swaziland</option> 
                      <option value="Sweden">Sweden</option> 
                      <option value="Switzerland">Switzerland</option> 
                      <option value="Syrian Arab Republic">Syrian Arab Republic</option> 
                      <option value="Taiwan, Province of China">Taiwan, Province of China</option> 
                      <option value="Tajikistan">Tajikistan</option> 
                      <option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
                      <option value="Thailand">Thailand</option> 
                      <option value="Timor-leste">Timor-leste</option> 
                      <option value="Togo">Togo</option> 
                      <option value="Tokelau">Tokelau</option> 
                      <option value="Tonga">Tonga</option> 
                      <option value="Trinidad and Tobago">Trinidad and Tobago</option> 
                      <option value="Tunisia">Tunisia</option> 
                      <option value="Turkey">Turkey</option> 
                      <option value="Turkmenistan">Turkmenistan</option> 
                      <option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
                      <option value="Tuvalu">Tuvalu</option> 
                      <option value="Uganda">Uganda</option> 
                      <option value="Ukraine">Ukraine</option> 
                      <option value="United Arab Emirates">United Arab Emirates</option> 
                      <option value="United Kingdom">United Kingdom</option> 
                      <option value="United States">United States</option> 
                      <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 
                      <option value="Uruguay">Uruguay</option> 
                      <option value="Uzbekistan">Uzbekistan</option> 
                      <option value="Vanuatu">Vanuatu</option> 
                      <option value="Venezuela">Venezuela</option> 
                      <option value="Viet Nam">Viet Nam</option> 
                      <option value="Virgin Islands, British">Virgin Islands, British</option> 
                      <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
                      <option value="Wallis and Futuna">Wallis and Futuna</option> 
                      <option value="Western Sahara">Western Sahara</option> 
                      <option value="Yemen">Yemen</option> 
                      <option value="Zambia">Zambia</option> 
                      <option value="Zimbabwe">Zimbabwe</option>
                      </select>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">State</label>
                                    <div class="col-lg-10">
                                        <input type="test" name="first_name8" class="form-control"  value="<?php echo $f['state'];?>" placeholder="Enter the State">
                                        
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">City</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="first_name9" value="<?php echo $f['city'];?>" class="form-control" id="inputPassword1" placeholder="Enter the City" required>
                                        
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Password</label>
                                    <div class="col-lg-10">
                                        <input type="password" name="first_name4" class="form-control"  value="<?php echo $f['password'];?>" placeholder="Enter the Password" >
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Transaction Password</label>
                                    <div class="col-lg-10">
                                        <input type="password" name="first_name5" class="form-control"  value="<?php echo $f['t_code'];?>" placeholder="Enter the Password Transaction Password" >
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Date Of Birth</label>
                                    <div class="col-lg-10">
                                        <input type="test" name="first_name12" value="<?php echo $f['dob'];?>" class="form-control" id="inputPassword1" placeholder="Enter the Date Of Birth (yyyy-mm-dd)" >
                                        
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Gender</label>
                                    <div class="col-lg-10">
                                        <select class="form-control" name="first_name13" id="exampleInputState">
                                        <option value="<?php echo $f['sex'];?>"><?php echo $f['sex'];?></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                      </select> 
                                        
                                    </div>
                                </div>
                                
                                
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <input type="submit" class="btn btn-primary"  name="submit" value="Update">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
                <div class="col-lg-6">
                    <section class="panel">
                        <header class="panel-heading">
                            UPDATE BANK INFORMATION<span style="float:right;color:red;"><?php echo @$_GET['msg1'];?></span>
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="post">
                            <!--  <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Present</label>
                                    <div class="col-lg-10">
                                         <?php $user=mysql_fetch_array(mysql_query("select * from final_e_wallet where user_id='".$_GET['id']."'")); echo number_format($user['amount'],2);?> Amount in wallet
                                
                                    </div>
                                </div> -->
                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Account Name</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="Account1" value="<?php echo $f['acc_name'];?>" class="form-control" placeholder="Enter the Account Name"  >
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Account Number</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="Account2" value="<?php echo $f['ac_no'];?>" class="form-control" id="inputPassword1" placeholder="Enter the Account Number" >
                                        
                                    </div>
                                </div>
                              <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">Bank Name</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="Account3" value="<?php echo $f['bank_nm'];?>" class="form-control" placeholder="Enter the Bank Name" >
                                        
                                    </div>
                                </div> 

                                <div class="form-group">
                                    <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Branch Name</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="Account4" value="<?php echo $f['branch_nm'];?>" class="form-control" placeholder="Enter the Branch Name">
                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword1" class="col-lg-2 col-sm-2 control-label">
                                    Ifsc / Swift Code</label>
                                    <div class="col-lg-10">
                                        <input type="text"name="Account5" value="<?php echo $f['swift_code'];?>" class="form-control" placeholder="Ifsc / Swift Code">
                                        
                                    </div>
                                </div>


                               
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-10">
                                   <input type="submit" name="update" value="Update" class="btn btn-primary" >
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
            
            

            </div>
            <!--body wrapper end-->


            <!--footer section start-->
           <?php include("footer.php");?>
            <!--footer section end-->


        </div>
        <!-- body content end-->
        
    </section>



<!-- Placed js at the end of the document so the pages load faster -->
<script src="js/jquery-1.10.2.min.js"></script>

<!--jquery-ui-->
<script src="js/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>

<script src="js/jquery-migrate.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>

<!--Nice Scroll-->
<script src="js/jquery.nicescroll.js" type="text/javascript"></script>

<!--right slidebar-->
<script src="js/slidebars.min.js"></script>

<!--switchery-->
<script src="js/switchery.min.js"></script>
<script src="js/switchery-init.js"></script>

<!--flot chart -->
<script src="js/jquery.flot.js"></script>
<script src="js/flot-spline.js"></script>
<script src="js/jquery.flot.resize.js"></script>
<script src="js/jquery.flot.tooltip.min.js"></script>
<script src="js/jquery.flot.pie.js"></script>
<script src="js/jquery.flot.selection.js"></script>
<script src="js/jquery.flot.stack.js"></script>
<script src="js/jquery.flot.crosshair.js"></script>


<!--earning chart init-->
<script src="js/earning-chart-init.js"></script>


<!--Sparkline Chart-->
<script src="js/jquery.sparkline.js"></script>
<script src="js/sparkline-init.js"></script>

<!--easy pie chart-->
<script src="js/jquery.easy-pie-chart.js"></script>
<script src="js/easy-pie-chart.js"></script>


<!--vectormap-->
<script src="js/jquery-jvectormap-1.2.2.min.js"></script>
<script src="js/jquery-jvectormap-world-mill-en.js"></script>
<script src="js/dashboard-vmap-init.js"></script>

<!--Icheck-->
<script src="js/icheck.min.js"></script>
<script src="js/todo-init.js"></script>

<!--jquery countTo-->
<script src="js/jquery.countTo.js"  type="text/javascript"></script>

<!--owl carousel-->
<script src="js/owl.carousel.js"></script>

<!--Data Table-->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.tableTools.min.js"></script>
<script src="js/bootstrap-dataTable.js"></script>
<script src="js/dataTables.colVis.min.js"></script>
<script src="js/dataTables.responsive.min.js"></script>
<script src="js/dataTables.scroller.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.dataTables.css" />
<!--data table init-->
<script src="js/data-table-init.js"></script>

<!--common scripts for all pages-->

<script src="js/scripts.js"></script>


<script type="text/javascript">

    $(document).ready(function() {

        //countTo

        $('.timer').countTo();

        //owl carousel

        $("#news-feed").owlCarousel({
            navigation : true,
            slideSpeed : 300,
            paginationSpeed : 400,
            singleItem : true,
            autoPlay:true
        });
    });

    $(window).on("resize",function(){
        var owl = $("#news-feed").data("owlCarousel");
        owl.reinit();
    });

</script>

</body>
</html>