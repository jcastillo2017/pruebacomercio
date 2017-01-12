<?php
require("vendor/autoload.php");
 
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

$app->get('/', 'getPersonas');
$app->get('/editarPersona/:id', 'editPersona');
$app->post('/buscarEmail', function (Request $request, Response $response) {
	$postVars = $request->getParsedBody();
	
    $emailBuscar = $postVars["email"];

    $data = file_get_contents("employees.json");
	$personas = json_decode($data, true);

	$idPorEmail = buscarPorEmail($emailBuscar,$personas);

	if ($idPorEmail) {
		editPersona($idPorEmail);
	}
});

$app->run();

function buscarPorEmail($emailBuscar, $personas) 
{
	foreach ($personas as $persona) {
	   if ($persona['email'] == $emailBuscar) {
           return $persona['id'];
       }
	}
}

function editPersona($id){
	$data = file_get_contents("employees.json");
	$personas = json_decode($data, true);

	foreach ($personas as $persona) {
		if ($persona['id'] == $id) {
			echo '
			<table style="width:40%" border="1" bgcolor="#e6e6e6" >
				<tr>
				    <td width="30%">NOMBRE</td>
				    <td width="70%">'.$persona['name'].'</td>
				</tr>
				<tr>
				    <td width="30%">EMAIL</td>
				    <td width="70%">'.$persona['email'].'</td>
				</tr>
				<tr>
				    <td width="30%">TELEFONO</td>
				    <td width="70%">'.$persona['phone'].'</td>
				</tr>
				<tr>
				    <td width="30%">DIRECCION</td>
				    <td width="70%">'.$persona['address'].'</td>
				</tr>
				<tr>
				    <td width="30%">PUESTO</td>
				    <td width="70%">'.$persona['position'].'</td>
				</tr>
				<tr>
				    <td width="30%">SALARIO</td>
				    <td width="70%">'.$persona['salary'].'</td>
				</tr>
				<tr>
				    <td width="30%">HABILIDADES</td>
				    <td width="70%">';
				    	foreach ($persona['skills'] as $skill) {
				    		echo "- ".$skill['skill']."<br>";
				    	}
				    echo '</td>
				</tr>
			</table>';
		}
	}
}


function getPersonas() {

    $data = file_get_contents("employees.json");
	$personas = json_decode($data, true);

	echo '<form method="POST" action="/comercio/buscarEmail">
	<table style="width:60%" border="1" bgcolor="#e6e6e6" >';
	echo "<tr>
			    <th width='20%'>BUSCAR POR EMAIL:</th>
			    <th width='40%'><input type='text' name='email' required style='width: 100%'></th>
			    <th width='20%'><input type='submit' value='BUSCAR'></th>
			</tr>
			</table>
			</form>
			<p>&nbsp;</p>";

	echo '<table style="width:100%" border="1">';
	echo "<tr>
			    <th>ID</th>
			    <th>NOMBRE</th>
			    <th>PUESTO</th>
			    <th>SALARIO</th>
			    <th>TELEFONO</th>
			    <th>EMAIL</th>
			</tr>";
	foreach ($personas as $persona) {
	    echo "
		    <tr>
			    <td> <a href='/comercio/editarPersona/".$persona['id']."'>EDITAR</a></td>
			    <td>".$persona['name']."</td>
			    <td>".$persona['position']."</td>
			    <td>".$persona['salary']."</td>
			    <td>".$persona['phone']."</td>
			    <td>".$persona['email']."</td>
			</tr>";
	}
	echo '</table>';
}


?>