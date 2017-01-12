<?php
class changeString {

   function build($frase)
   {	
		$a = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "a");
		$b = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
		$nuevaFrase = str_replace($a, $b, $frase);


		$this->nuevaFrase = $nuevaFrase;
		return $this->nuevaFrase;
   }
} 

$obj = new changeString();

echo "<br>changeString 1: ".$obj->build("123 abcd*3");
echo "<br>changeString 2: ".$obj->build("**casa 52");
echo "<br>changeString 3: ".$obj->build("**casa 52z");


class completeRange {

	//esta funcion no depende de una serie de numeros, 
	//funciona para cualquier array, 
	//con la condicion que el primer elemento sea menor al ultimo

   function build($aNumeros)
   {	

   		foreach ($aNumeros as $numero) {
   			
   			if ($numero === end($aNumeros)) {
		        $ultimoNumero = $numero;
		    }

		    if ($numero === reset($aNumeros)) {
		        $primerNumero = $numero;
		    }	
   		}

   		for ($i=$primerNumero; $i < ($ultimoNumero + 1); $i++) { 
   			$nuevaLista[] = $i; 
   		}

   		return $nuevaLista;
   }
} 

$obj2 = new completeRange();

echo "<p></p>completeRange 1: ";
echo '<pre>';
print_r($obj2->build([2,3,5,9]));
echo '</pre>';


class ClearPar {

   function build($texto)
   {	
   		$cantidadParentesis = substr_count($texto, '()');

   		$nuevaLista = "";
   		for ($i=0; $i < $cantidadParentesis; $i++) { 
   			$nuevaLista = $nuevaLista.'()';	  
   		}
   		return $nuevaLista;
   }
} 

$obj3 = new ClearPar();

echo "<p></p>ClearPar 1: ".$obj3->build("()()))()(())(()");


?>