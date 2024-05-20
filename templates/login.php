
<?php echo $message; ?>

<!-- <form name="frmLogin" action="authenticate.php" method="post">
   Student ID:
   <input name="txtid" type="text" />
   <br/>
   Password:
   <input name="txtpwd" type="password" />
   <br/>
   <input type="submit" value="Login" name="btnlogin" />
</form> -->

<form name="frmLogin" action="authenticate.php" method="post" class="mt-5">
  <div class="mb-3">
    <label for="txtid" class="form-label">Student ID</label>
    <input type="text" class="form-control" id="txtid" name="txtid">
  </div>
  <div class="mb-3">
    <label for="txtpwd" class="form-label">Password</label>
    <input type="password" class="form-control" id="txtpwd" name="txtpwd">
  </div>
  <input type="submit" name="btnlogin" class="btn btn-primary" value="Login" />
</form>