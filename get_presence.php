<?php
	session_start();
	require_once('connexionbd.php');

	if (empty($_SESSION['email'])) {
		
		header('location:login.php');
	}
	if (setlocale(LC_TIME, 'fr_FR') == '') {
		setlocale(LC_TIME, 'FRA');
		$format_jour = '%#d';
	}else{
		$format_jour = '%e';
	}
	$typeActivite = $_GET['Id_activite'];
	$sql = "SELECT c.Nom, c.Prenom, a.Description_appel
			FROM choriste c
			JOIN presence p ON c.Id_choriste = p.Id_choriste
			JOIN appel a ON p.Id_appel = a.Id_appel 
			WHERE a.Id_type_activite = '$typeActivite' ";
	$resultat = $BaseDonnee->query($sql);

	$html = '';

	while($l_presences=$resultat->fetch()) {
		$html .= '<tr>';
		$html .= '<td>' . htmlspecialchars($l_presences['Nom']) . '</td>';
		$html .= '<td>' . htmlspecialchars($l_presences['Prenom']) . '</td>';
		$html .= '<td>' . htmlspecialchars($l_presences['Description_appel']) . '</td>';
		$html .= '<td>';
	}

	echo $html;

?>

<!-- <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Repetition</title>
</head>
<body>
	<div>
		<div>
			<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Appel </th>
							<th>Nom </th> 
							<th>Prenom</th>
						</tr>
					</thead>

					<tbody>
						<tbody id="table-presence">
							<?php while($l_presences=$resultat->fetch()){ ?>
								<tr>
									<td>
										<center><?php echo $l_presences['Nom_type_activite'] ?></center>
										<center><?php echo "Appel du ".strftime("%A $format_jour %B %Y",strtotime($l_presences['Date'])) ?></center>
									</td>

									<td><?php echo $l_presences['Nom'] ?></td>
									<td><?php echo $l_presences['Prenom'] ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</tbody>
				</table>
		</div>
	</div>

</body>
</html> -->