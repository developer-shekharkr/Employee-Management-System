<?php
include "connection.php";
$q1="select * from form ";
$sql= mysqli_query($con,$q1);
$data= mysqli_fetch_array($sql);

?>

<!-- php for id search -->
<?php
if(isset($_POST['search'])){
    $id = $_POST['searchid'];

    $q1="select * from form where id = '$id'";
    $sql= mysqli_query($con,$q1);
    $data= mysqli_fetch_array($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="container">
<h1>Employee Data Entery Automation Software</h1>
<form action="#" method="POST">
<div class="form">
<input type="text" name="searchid" class="textfield" placeholder="Search ID" value="<?php if(isset($_POST['search'])){echo $data['id'];} ?>">
<input type="text" name="ename" class="textfield" placeholder="Employee Name" value="<?php if(isset($_POST['search'])){echo $data['ename'];}?>">

<!-- gender section -->
<select name="gender" class="textfield" >
    <option value="not selected">Select Gender</option>
    <option  value="Male" 
    <?php
    
    if($data['gender'] == 'Male')
    {
        echo "selected";
    }
    ?>
    >Male</option>
    <option value="Female"
    <?php if ($data['gender'] == 'Female'){echo "selected";}?>
    >Female</option>
</select>

<!-- email -->
<input type="text" name="email" class="textfield" placeholder="Email Address"  value="<?php 
if(isset($_POST['search'])){
   echo $data['email'];
}
?>">
<select name="department" class="textfield">
    <option value="not selected">Select Department</option>
    <option  value="IT" 
    
    <?php 
    if ($data['department'] == 'IT')
    {
        echo "selected";
    }
    ?> >IT</option>
    <option  value="HR" 
    <?php 
    if ($data['department'] == 'HR')
    {
        echo "selected";
    }
    ?> 
    >HR</option>
    <option  value="Account"
    <?php 
    if ($data['department'] == 'Account')
    {
        echo "selected";
    }
    ?> 
    >Account</option>
    <option  value="Sales" 
    <?php 
    if ($data['department'] == 'Sales')
    {
        echo "selected";
    }
    ?> 
    >Sales</option>
    <option value="Marketing" <?php 
    if ($data['department'] == 'Marketing')
    {
        echo "selected";
    }
    ?> >Marketing</option>
    <option value="Business Development" 
    <?php 
    if ($data['department'] == 'Business Development')
    {
        echo "selected";
    }
    ?> 
    >Business Development</option>
</select>
<textarea name="address" placeholder="Address"><?php 
if(isset($_POST['search'])){
   echo $data['address'];}?></textarea>
<input  type="submit" name="search" class="btn" value="Search">
<input type="submit" style="background-color: blue;" name="save" class="btn" value="Save">
<input type="submit" style="background-color: green;" name="modify" class="btn" value="Modify">
<input type="submit" style="background-color: orange;" name="delete" class="btn" value="Delete" onclick='return confirmdelete()'>
<input type="reset" style="background-color: red;" name="clear" class="btn" value="Clear">
</div>
</form>
    </div>
    </body>
</html>

<!-- javascript function to confirm before delete -->
<script>
function confirmdelete(){
   return confirm("Are you sure you want to delete this record");
}

</script>


<!-- php for data submition-->

<?php

if(isset($_POST['save'])){
    $ename=trim($_POST['ename']);
    $gender=$_POST['gender'];
    $email=trim($_POST['email']);
    $department=$_POST['department'];
    $add=trim($_POST['address']); 
    include "connection.php";

    $q="insert into form (ename,gender,email,department,address)
    values('".$ename."', '".$gender."', '".$email."', '".$department."', '".$add."')";
    $sql=mysqli_query($con,$q);
    if($sql){
        echo "data submited";
    }
    else{
        echo "data submition failed...!";
        echo mysqli_error($con);
    }

}
?>


<!-- php for delete function -->
<?php
if(isset($_POST['delete'])){
    $id= $_POST['searchid'];
   
    $q= "delete from form where id = '$id'";
    $sql= mysqli_query($con, $q);
    if($sql){
        echo "data deleted";
    }
    else{
        echo "data not deleted...!";
        echo mysqli_error($con);
    }
}
?>

<!-- php for update -->

<?php
if(isset($_POST['modify'])){
    $id = $_POST['searchid'];
    $name = $_POST['ename'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $add = $_POST['address'];

    $q = "update form set id = '$id', ename = '$name', gender = '$gender', email = '$email', department = '$department', address = '$add' where id = '$id' ";

    $sql = mysqli_query($con, $q);
    if($sql){
        echo "<script>alert('Data updated')</script>";
    }
    else{
        echo "<script>alert('data not updated')</script>";
    }

}
?>
