<h1>Digite o e-mail ou cpf do usuário</h1>

<form method='GET'>
	<input type="text" name="campo">
	<input type="submit" value="Pesquisar">


</form>
<hr>

<?php
	if(!empty($_GET['campo'])){
		$campo = $_GET['campo'];
	
	try{
		$pdo = new PDO("mysql:dbname=blog;host=localhost", "root", "");

	}catch(PDOExcepetion $e){
		echo "ERRO: ".$e->getMessage();
		exit;
	}

	$sql = "SELECT * FROM usuario WHERE email = :email OR cpf = :cpf OR nome = :nome";
	$sql = $pdo->prepare($sql);
	$sql->bindValue(":email", $campo);
	$sql->bindValue(":cpf", $campo);
	$sql->bindValue(":nome", $campo);
	$sql->execute();

	if($sql->rowCount() > 0) {
		$sql = $sql->fetch();

		echo "NOME: ".$sql['nome'];
	}
}
