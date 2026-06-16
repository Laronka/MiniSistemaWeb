<?php
	    // --------------------------------------------
		// CONEXÃO COM O BANCO DE DADOS
		// --------------------------------------------		
		try{
			$conn = mysqli_connect("mysql", "root", "1234", "loja"); 
		} catch (mysqli_sql_exception $e){
			die("Erro ao conectar");

		}
?>