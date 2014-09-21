<?php
	// L'utilisation des classes Groupes et Planning sont obligatoires !
	// Sinon on se sent un peu con sans planning ni groupes.
	
	require 'class/planning.php';
	require 'class/groupes.php';
	define('ROOT', dirname( __FILE__ ));
?>
<html lang="fr">
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>Planning #SWAG</title>

	    <!-- Bootstrap -->
	    <link href="css/bootstrap.css" rel="stylesheet">
	    <link href="css/navbar.css" rel="stylesheet">

	    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
	<body>
		<!-- Activation de fastclick -->
		<script>
				$(function() {
		    FastClick.attach(document.body);
		});
		</script>
		<!-- Fixed navbar -->
	    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="index.php"><b>Planning #SWAG</b></a>
	        </div>
	        <div class="navbar-collapse collapse">
		        <div class="nav navbar-nav">
		          <?php
		          	$test = new Groupes();
		          	$test->listerGroupes();
		          ?>
		         </div>
	        </div><!--/.nav-collapse -->
	      </div>
	    </div>
					<div class="row">
					<div class="col-md-12">
					
						<span id="planning"><?php require 'affplanning.php'; ?></span>
				
						<!-- OUI JE SAIS -->
						<center>
							<div class="btn-group btn-group-lg" id="bouttons">
								<button type="button" class="btn btn-default" onclick="showPlanning(<?php echo '' .$annee. ',' .$groupe. ',' .($numsem - 1). ''; ?>)">Précédent</button>
								<button type="button" class="btn btn-default" onclick="showPlanning(<?php echo '' .$annee. ',' .$groupe. ',' .($numsem + 1). ''; ?>)">Suivant</button>
							</div>
						</center>
					</div>
			</div>
	</div>
</div>
		<!-- Script permettant de supprimer le délai de 300ms au clic pour les smartphone (https://github.com/ftlabs/fastclick)-->
		<script type='application/javascript' src='/path/to/fastclick.js'></script>
		<!-- Script permettant la navigation en AJAX -->
		<script src="js/ajax_nav.js"></script>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	    <!-- Include all compiled plugins (below), or include individual files as needed -->
	    <script src="js/bootstrap.min.js"></script>
	    <!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["setCookieDomain", "*.thomasmunoz.fr"]);
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u=(("https:" == document.location.protocol) ? "https" : "http") + "://thomasmunoz.fr/piwik/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', 1]);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0]; g.type='text/javascript';
    g.defer=true; g.async=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="http://thomasmunoz.fr/piwik/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->

	</body>
</html>
