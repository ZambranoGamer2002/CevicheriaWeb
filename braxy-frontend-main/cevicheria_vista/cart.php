<?php 
session_start();


//aqui empieza el carrito
if(isset($_SESSION['carrito']) || isset($_POST['pla_comida'])){
	if(isset($_SESSION['carrito'])){
		$carrito_mio=$_SESSION['carrito'];
		if(isset($_POST['pla_comida'])){
			$pla_comida=$_POST['pla_comida'];
			$pla_precio=$_POST['pla_precio'];
			$cantidad=$_POST['cantidad'];
			$donde=-1;
			for($i=0;$i<=count($carrito_mio)-1;$i ++){
			}
			if($donde != -1){
				$cuanto=$carrito_mio[$donde]['cantidad'] + $cantidad;
				$carrito_mio[$donde]=array(
					"pla_comida"=>$pla_comida,
					"pla_precio"=>$pla_precio,
					"cantidad"=>$cuanto
				);
			}else{
				$carrito_mio[]=array(
					"pla_comida"=>$pla_comida,
					"pla_precio"=>$pla_precio,
					"cantidad"=>$cantidad);
			}
		}
	}else{
		$pla_comida=$_POST['pla_comida'];
		$pla_precio=$_POST['pla_precio'];
		$cantidad=$_POST['cantidad'];
		$carrito_mio[]=array(
			"pla_comida"=>$pla_comida,
			"pla_precio"=>$pla_precio,
			"cantidad"=>$cantidad
		);	
	}

	$_SESSION['carrito']=$carrito_mio;
}

header("Location: cevicheria_prueba.php");

?>
