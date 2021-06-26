  <?php


include('database/dbconfig.php');
if($connection)
{
    // echo "Database Connected";
}
else
{
    header("Location: database/dbconfig.php");
}

if(isset($_SESSION['username']))
{
    //header('Location: login.php');
}
?>
