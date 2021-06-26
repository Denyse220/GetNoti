<?php
	session_start();
	include 'config.php';

	$update=false;
	$id="";
	$name="";
	$sdate="";
	$edate="";
	$pstatus="";

	if(isset($_POST['add'])){
		$name=$_POST['name'];
		$sdate=$_POST['sdate'];
		$edate=$_POST['edate'];
		$pstatus=$_POST['pstatus'];
	

		$query="INSERT INTO crudd(name,sdate,edate,pstatus)VALUES(?,?,?,?)";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("ssss",$name,$sdate,$edate,$pstatus);
		$stmt->execute();
		//move_uploaded_file($_FILES['image']['tmp_name'], $upload);

		header('location:projects.php');
		$_SESSION['response']="Successfully Inserted to the database!";
		$_SESSION['res_type']="success";
	}
	if(isset($_GET['delete'])){
		$id=$_GET['delete'];

		$sql="SELECT name FROM crudd WHERE id=?";
		$stmt2=$conn->prepare($sql);
		$stmt2->bind_param("i",$id);
		$stmt2->execute();
		$result2=$stmt2->get_result();
		$row=$result2->fetch_assoc();

		//$imagepath=$row['photo'];
		//unlink($imagepath);

		$query="DELETE FROM crudd WHERE id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->execute();

		header('location:projects.php');
		$_SESSION['response']="Successfully Deleted!";
		$_SESSION['res_type']="danger";
	}
	if(isset($_GET['edit'])){
		$id=$_GET['edit'];

		$query="SELECT * FROM crudd WHERE id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$result=$stmt->get_result();
		$row=$result->fetch_assoc();

		$id=$row['id'];
		$name=$row['name'];
		$sdate=$row['sdate'];
		$edate=$row['edate'];
		$pstatus=$row['pstatus'];

		$update=true;
	}
	if(isset($_POST['update'])){
		$id=$_POST['id'];
		$name=$_POST['name'];
		$sdate=$_POST['sdate'];
		$edate=$_POST['edate'];
		$pstatus=$_POST['pstatus'];

	//	if(isset($_FILES['image']['name'])&&($_FILES['image']['name']!="")){
		//	$newimage="uploads/".$_FILES['image']['name'];
			//unlink($oldimage);
			//move_uploaded_file($_FILES['image']['tmp_name'], $newimage);
	//	}
	//	else{
			//$newimage=$oldimage;
	//	}
		$query="UPDATE crudd SET name=?,sdate=?,edate=?,pstatus=? WHERE id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("ssssi",$name,$sdate,$edate,$pstatus,$id);
		$stmt->execute();

		$_SESSION['response']="Updated Successfully!";
		$_SESSION['res_type']="primary";
		header('location:projects.php');
	}

	if(isset($_GET['details'])){
		$id=$_GET['details'];
		$query="SELECT * FROM crudd WHERE id=?";
		$stmt=$conn->prepare($query);
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$result=$stmt->get_result();
		$row=$result->fetch_assoc();

		$vid=$row['id'];
		$vname=$row['name'];
		$vsdate=$row['sdate'];
		$vedate=$row['edate'];
		$pstatus=$row['pstatus'];
	}
?>