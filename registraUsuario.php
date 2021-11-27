<?php
	include("funciones.php");

//espacio para recuperación de datos
	if(!isset($_GET['Nombre'])||
	   !isset($_GET['Pwd'])||
	   !isset($_GET['rePwd'])||
	   !isset($_GET['Email'])||
	   !isset($_GET['Direccion'])||
	   !isset($_GET['idRol']))
	{
		header("location:" .$ruta. "registrate.php?err=1");
	}
	if($_GET['Nombre']== ""||
	   $_GET['Pwd']==""||
	   $_GET['rePwd']==""||
	   $_GET['Email']== ""||
	   $_GET['Direccion'] == ""||
	   $_GET['idRol']== "")
	{
		header("location:" .$ruta. "registrate.php?err=2");
	}
	if($_GET['Pwd'] !=$_GET['rePwd'])
	{
		header("location:" .$ruta. "registrate.php?err=3");
	}
	
	
	extract($_GET); //crea las varibales txtnombre,txtUsuario,etc...

	$conn = conectaBD();

	$consulta = "insert into 
					usuarios (Nombre, Pwd, rePwd, Email, Direccion, idRol) 
					value ('$Nombre','$Pwd','$rePwd','$Email','$Direccion','$idRol')";
	$rs = mysqli_query($conn,$consulta);

	mysqli_close($conn);

	header("location:" .$ruta. "registrate.php?err=4");
?>