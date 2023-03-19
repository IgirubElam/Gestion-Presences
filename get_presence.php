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
	$typeActivite = isset($_GET['Id_activite'])?$_GET['Id_activite']:"";
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

 