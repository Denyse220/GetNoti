<?php
session_start();
include('includes/header.php');
include('includes/navbar.php');
?>
<div class="container-fluid">

<!--DataTales Exampes-->
<div class="card shadow mb-4">
    <div class=" card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">EDIT PROFILE</h6>
</div>
<div class="card-body">
<?php
$connection=mysqli_connect("localhost","root","","notification");

if(isset($_POST['edit_id']))
{
    $id= $_POST['edit_id'];
    $query= "SELECT*FROM register WHERE id='$id' ";
    $query_run =mysqli_query($connection,$query);

    foreach($query_run as $row)
    {
        ?>

 <form action="code.php" method="POST">  
     <input type="hidden" name="edit_id" value="<?php echo $row['id']?> "  >
<div class="form-group">
<label> Username</label>
<input type="text" name="edit_username" value="<?php echo $row['username']?>" class="form-control" placeholder="enter username">
</div>
<div class="form-group">
<label>Email</label>
<input tpe="email" name="edit_email"  value="<?php echo $row['email']?>" class="form-control" placeholder="Enter email">
</div>

<div class="form-group">
<label>Password</label>
<input tpe="password" name="edit_password" value="<?php echo $row['password']?>" class="form-control" placeholder="Enter password">

</div>
<a href="register.php" class="btn btn-danger">CANCEL</a>
<button type="submit" name="updatebtn" class="btn btn-primary"> Update </button>
    </form>
     <?php 
    }
}
?>

</div>
</div>
</div>

<?php
include('includes/script.php');
include('includes/footer.php');
?>