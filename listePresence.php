
<?php
	session_start();
	 require_once('connexionbd.php');

	 if (empty($_SESSION['email'])) {
		
		header('location:login.php');
	}

	
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

				<button type="button" class="btn btn-primary" onclick="getPresence('Repetition')">Repetition</button>
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp;
				<button class="btn btn-primary">Culte Francophone</button>
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp;
				<button class="btn btn-primary">Priere</button>
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
				&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp;
				<button class="btn btn-primary">Louange</button>
				
					<table class="table table-hover" id="table-presence" style="display: none;">
						<thead>
							<tr>
								<th>Appel </th>
								<th>Nom </th> 
								<th>Prenom</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								
							</tr>
						</tbody>
					</table> 
				
			</div>
		</div>

	</div>

	<script type="text/javascript">

		
		function getPresence(type_activite){
			$.ajax({
					url: 'get_presence.php',
					type:'POST';
					data:{type_activite: type_activite},
					success:function(data){
						$("#table-presence").html(data);

						$("#table-presence").show();
					},
					error:function(jqXHR, testStatus, errorThrown) {
						console.log(textStatus, errorThrown);
					}
				});
		}

		;
	</script>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popped.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/boostrap@5.1.3/dist/js/boostrap.min.js"></script>
</body>
</html>