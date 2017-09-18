<?php
	$dirToRead ="../../Pictures/";
	// kuna tahan ainult pildi faile, siis filtreerin
	$picFileTypes = ["jpg", "jpeg", "png", "gif"]
	$picFiles =[];
	//$allFiles =scandir($dirToRead);
	//loen kataloogi ja viskan kaks esimest massiivi liiget (. ja ..) välja
	$allFiles = array_slice(scandir($dirToRead),2);
	
	
	//tsükkel, mis töötab ainult massiividega
	foreach ($allFiles as $file){
		$fileType = pathinfo($file, PATHINFO_EXTENSION);
		//Kas see tüüp on lubatud nimekirjas
		if (in_array($fileType, $picFileTypes) == true){
			array_push($picFiles, $file);
			//picFiles[] = $file;
			
			
		}
	}
		//mitu pilit on$
		$fileCount= count($picFiles);
		$picNumber= mt_rand(0, $fileCount - 1);
		$picToShow= $picFiles[$picNumber];
?>
<!DOCTYPE html>
<html>


<head>
	<meta charset="utf-8">
	<title> Riho Noormets Veebiproge asjad</title>
</head>


<body>
	<h1>Greeny leht</h1>
	<p>Greeny</p>
	
	<p>Üks pilt Tallinna Ülikoolist!</p>
	<img src="../../Pictures/tlu_42.jpg" alt="Tallinna Ülikool">
	<img src="<?php echo $dirToRead .$picToShow ?>" alt="Tallinna Ülikool">
	
</body>
</html>