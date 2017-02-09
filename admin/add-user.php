<?php include("../codelibrary/global.php");
	$mydb		=	new dbclass(); 
 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include('includes/head.php'); ?>
  </head>
  <body>
  <?php include('includes/top.php'); ?>
    <div class="container">
   
<div class="row">
<div class="col-md-4">
<h3 class="title">Login Information</h3>
<div class="panel panel-default">
  <div class="panel-body" >
    <form method="post" action="action.php" >
  <div class="form-group">
    <label for="exampleInputEmail1">First Name</label>
    <input type="text" class="form-control"   placeholder="Username" name="admin_user" required />
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Last Name</label>
    <input type="text" class="form-control"   placeholder="Username" name="admin_user" required />
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email Address</label>
    <input type="email" class="form-control"   placeholder="Email Address" name="admin_user" required />
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" placeholder="Password" name="admin_pwd" required />
  </div>
  
   
 
</form>
  </div>
</div></div><div class="col-md-4">
<h3 class="title">Billing Information</h3>
<div class="panel panel-default">
  <div class="panel-body" >
   
   <div class="form-group">
    <label for="exampleInputEmail1">First Name</label>
    <input type="text" class="form-control"   placeholder="First Name" name="fname" id="fname" required />
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Last Name</label>
    <input type="text" class="form-control"   placeholder="Last Name"  name="fname" id="fname" required />
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email Address</label>
    <input type="text" class="form-control"   placeholder="Username"  name="fname" id="fname" required />
  </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Phone Number</label>
    <input type="text" class="form-control"   placeholder="Username"  name="fname" id="fname" required />
  </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Address</label>
    <input type="text" class="form-control"   placeholder="Username"  name="fname" id="fname" required />
  </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Address1</label>
    <input type="text" class="form-control"   placeholder="Username"  name="fname" id="fname" required />
  </div>
       <div class="form-group">
    <label for="exampleInputEmail1">City</label>
    <input type="text" class="form-control"   placeholder="Username"  name="fname" id="fname" required />
  </div>
         <div class="form-group">
    <label for="exampleInputEmail1">Country</label>
    <select class="form-control"  name="fname" id="fname" >
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
</select>
  </div>
     <div class="form-group">
    <label for="exampleInputEmail1">State</label>
    <select class="form-control"  name="fname" id="fname" >
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
</select>
  </div>
     
       <div class="form-group">
    <label for="exampleInputEmail1">Zip Code</label>
    <input type="text" class="form-control"   placeholder="Username"  name="fname" id="fname"  required />
  </div>
  </div>
</div></div>
 <div class="col-md-4">
<h3 class="title">Shipping Information</h3>
<div class="panel panel-default">
  <div class="panel-body" >
   
   <div class="form-group">
    <label for="exampleInputEmail1">First Name</label>
    <input type="text" class="form-control"   placeholder="Username"  name="fname" id="fname"  required />
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Last Name</label>
    <input type="text" class="form-control"   placeholder="Username"  name="fname" id="fname" required />
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email Address</label>
    <input type="text" class="form-control"   placeholder="Username"  name="fname" id="fname"  required />
  </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Phone Number</label>
    <input type="text" class="form-control"   placeholder="Username"  name="fname" id="fname"  required />
  </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Address</label>
    <input type="text" class="form-control"   placeholder="Username"  name="fname" id="fname"  required />
  </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Address1</label>
    <input type="text" class="form-control"   placeholder="Username"  name="fname" id="fname"  required />
  </div>
       <div class="form-group">
    <label for="exampleInputEmail1">City</label>
    <input type="text" class="form-control"   placeholder="Username"  name="fname" id="fname"  required />
  </div>
              <div class="form-group">
    <label for="exampleInputEmail1">Country</label>
    <select class="form-control"  name="fname" id="fname" >
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
</select>
  </div>    <div class="form-group">
    <label for="exampleInputEmail1">State</label>
    <select class="form-control"  name="fname" id="fname" >
  <option>1</option>
  <option>2</option>
  <option>3</option>
  <option>4</option>
  <option>5</option>
</select>
  </div>

 
       <div class="form-group">
    <label for="exampleInputEmail1">Zip Code</label>
    <input type="text" class="form-control"   placeholder="Username"  name="fname" id="fname"  required />
  </div>
  </div>
</div></div>
</div>

<div class="row">
<div class="col-md-12"><button type="submit" class="btn btn-primary">Submit</button></div></div>

 
      

    </div> 

    <?php include('includes/footer.php'); ?>
  </body>
</html>