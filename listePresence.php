
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

				<button class="btn btn-primary" id="btn-repetition">Repetition</button>
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp;
				<button class="btn btn-primary">Culte Francophone</button>
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp;
				<button class="btn btn-primary">Priere</button>
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp;
				<button class="btn btn-primary">Louange</button>
				<div>
					<table class="table table-striped table-bordered" id="presence_table">
						<thead>
							<tr>
								<th>Appel </th>
								<th>Nom </th> 
								<th>Prenom</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<!-- <?php while($l_presences=$resultat->fetch()){ ?> -->
									<tr>
										<td>
											<!-- <center><?php echo $l_presences['Nom_type_activite'] ?></center>
											<center><?php echo "Appel du ".strftime("%A $format_jour %B %Y",strtotime($l_presences['Date'])) ?></center> -->
										</td>

										<td><!-- <?php echo $l_presences['Nom'] ?> --></td>
										<td><!-- <?php echo $l_presences['Prenom'] ?> --></td>
									</tr>
								<!-- <?php } ?> -->
							</tr>
						</tbody>
					</table> 
				</div>
			</div>
		</div>

	</div>

	<script type="text/javascript">

		$(document).ready(function(){
			$('#btn-repetition').click(function(){
				getPresence('Repetition');
			});
		})

		function getPresence(type_activite){
			$.ajax({
					url: 'selectRepetition.php',
					type:'POST';
					data:{type_activite: type_activite},
					dataType:'json',
					success:function(data){
						var tbody = $('#presence_table tbody');
						tbody.empty();
						for (var i = 0; i < data.length; i++) {
							var row = $('<tr>');
							row.append($('<td>').text(data[i].Nom));
							row.append($('<td>').text(data[i].Prenom));
							row.append($('<td>').text(data[i].Description_appel));
							tbody.append(row);
						}
						$('#presence_table').css('display','block');
					},
					error:function(jqXHR, testStatus, errorThrown) {
						console.log(textStatus, errorThrown);
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