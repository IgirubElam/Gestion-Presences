
<?php
	session_start();
	 require_once('connexionbd.php');

	 if (empty($_SESSION['email'])) {
		
		header('location:login.php');
	}

	// if (setlocale(LC_TIME, 'fr_FR') == '') {
	// 	setlocale(LC_TIME, 'FRA');
	// 	$format_jour = '%#d';
	// }else{
	// 	$format_jour = '%e';
	// }

	// $requete="select * from  presence,appel,type_activite,choriste where presence.Id_appel=appel.Id_appel AND appel.Id_type_activite =type_activite.Id_activite AND presence.Id_choriste=choriste.Id_choriste";
	// $resultat=$BaseDonnee->query($requete); 


	// $typeActivite = $_GET['Nom_type_activite'];
	// $sql = "SELECT c.Nom, c.Prenom, a.Description_appel
	// 		FROM choriste c
	// 		JOIN presence p ON c.Id_choriste = p.Id_choriste
	// 		JOIN appel a ON p.Id_appel = a.Id_appel 
	// 		WHERE a.Id_type_activite = '$typeActivite' ";
	// $resultat = $BaseDonnee->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gestion des choristes</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/monstyle.css">
</head>
<body>
	<?php include("menu.php"); ?>

	<div class="container">
		
		<div class="panel panel-success margintop">
			<div class="panel-heading"> Liste des presences</div>
			<div class="panel-body">

				<button type="button" class="btn btn-primary" id="resultats" onclick="getPresence('Repetition')">Repetition</button>
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp;
				<button class="btn btn-primary">Culte Francophone</button>
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp;
				<button class="btn btn-primary">Priere</button>
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp;
				<button class="btn btn-primary">Louange</button>
				
					
				
			</div>
		</div>

	</div>

	<script type="text/javascript">

		
		function getPresence(typeActivite){
			$.ajax({
					url: "get_presence.php",
					type:"POST",
					data:{type_activite: typeActivite},
					dataType: "json",
					success:function(data){

						if (data.length > 0) {
							var html = "<table>";
						html += "<tr> 
							      <th> Nom </th>
							      <th> Prenom</th>
							      <th> Description appel</th>
							      </tr>;
							      for (var i = 0; i < data.length; i++) {
							      	html += "<tr>";
							      	html += "<td>" + data[i].Nom + "</td>";
									html += "<td>" + data[i].Prenom + "</td>";
							      	html += "<td>" + data[i].Description_appel + "</td>";

							      	html += "</tr>";
							      }
							      html += "</table>";

							      $("#resultats").html(html);
						} else {
							$("#resultats").html("0 resultats");
						}
					},
						error:function() {
						alert("Erreur lors de la recuperation des donnees."); 
					}
					});
					
		}


		// $(document).ready(function(){
		// 	$("#btn-repetition").click(function(){
				
		// 	});
		// });
	</script>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popped.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/boostrap@5.1.3/dist/js/boostrap.min.js"></script>
</body>
</html>