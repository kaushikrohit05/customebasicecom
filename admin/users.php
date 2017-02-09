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
    <div class="container-fluid">
    <div class="row">
    <div class="col-xs-6"><h3 class="title">Users</h3></div>
    <div  class="col-xs-6 text-right"  ><a href="add-user.php"  class="btn btn-sm btn-success" role="button"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Add User</a></div>
    </div>
<div class="row">

<div class="col-md-12">
<div class="panel panel-default">
  <div class="panel-body" >
     <table class="table  table-hover"><thead><tr><th>First Name</th>
       <th>Last Name</th>
       <th>Email</th>
       <th>Created on</th>
       <th>&nbsp;</th>
     </tr>
     </thead><tbody><tr><td>sadsad</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td class="text-right"><a href="billing_shipping.php?businessid=<?php echo $row['id'];?>"  class="btn btn-sm btn-success" role="button"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Billing/Shipping</a>   <a href="operator.php?businessid=<?php echo $row['id'];?>"  class="btn btn-sm btn-success" role="button"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Orders</a>   
                 
                 <a href="adduser.php?id=<?php echo $row['id'];?>&Action_type=edit"  class="btn btn-sm btn-warning" role="button">
                 <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a>
                 <a href="action-user.php?id=<?php echo $row['id'];?>&Action_type=del" class="btn btn-sm btn-danger" role="button">
                 <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</a></td>
     </tr>
     </tbody></table>
  </div>
</div></div>
 
</div>

      

    </div> 

    <?php include('includes/footer.php'); ?>
  </body>
</html>