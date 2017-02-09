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
<div class="col-md-4"></div>
<div class="col-md-4">
<h2 class="text-center">Administartor Login</h2>
<div class="panel panel-default">
  <div class="panel-body">
    <form method="post" action="action.php">
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control"   placeholder="Username" name="admin_user" required />
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" placeholder="Password" name="admin_pwd" required />
  </div>
  
   
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
  </div>
</div></div>
<div class="col-md-4"></div>
</div>

      

    </div> 

    <?php include('includes/footer.php'); ?>
  </body>
</html>