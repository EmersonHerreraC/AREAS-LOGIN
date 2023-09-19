<?php
	$conn = new mysqli('databases-auth.000webhost.com', 'id20636071_emeheco', '19082001@Emer', 'id20636071_asis_sa');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	

	if(isset($_POST['login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM usuario WHERE userUsuario = '$username'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'No se puede encontrar la cuenta con el nombre de usuario';
		}
		else{
			$row = $query->fetch_assoc();
			if(password_verify($password, $row['claveUsuario'])){
				$_SESSION['usuario'] = $row['id'];
			}
			else{
				$_SESSION['error'] = 'Clave Incorrecta';
			}
		}
		
	}
	else{
		$_SESSION['error'] = 'Ingrese las credenciales de administrador primero';
	}

	header('location: index.php');

?>