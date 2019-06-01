<head>
<link rel="shortcut icon" type="image/png" href="/iissiMotor/img/image.png" />
<link  rel="stylesheet" href="css/main.css" type="text/css"/> 
</head>
<header>
	<body id="page1">
<div class="body1">
			
			<div class="wrapper" >
				<div class="left"style="padding-left:3%" >
					
					<div class="left"  id="logo"></div>
					<div class="right" >
				<h1 >
					IISSIMOTOR<span id="slogan">The best or nothing </span>
				</h1></div></div>
				<div class="right" >
				
					<nav style="padding-top:3%;pading-right:30%" >
						<ul id="menu"  >
							<li id="menu_active"><a href="index.php">Home</a></li>
							<li><a href="VistaCita.html">Pedir Cita </a></li>
							<li><a href="vistaIncidencia.html">Incidencia</a></li>
							<li><a href="factura.php">Facturación</a></li>
							<li><a href="agente.php">Agente</a></li>
						
							<?php
					
							if (isset  ($_SESSION["login"])){
								echo '<li><a href="logout.php">Logout</a></li>';
								
							}else{
								echo '<li><a href="login.php">Login</a></li>';
							}
							
							?>
							
							</ul>
							
     						 
    						
					</nav>
				</div>
			</div>
			</div>
			</body>
		</header>