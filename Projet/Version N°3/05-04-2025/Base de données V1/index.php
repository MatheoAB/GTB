<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
		//ECHO "Lycée Charles Carnus<br>";
		//echo "BTS Charles Carnus<br>";
		//EcHo "Etablisement scolaire<br>";

		//$txt = "BTS CIEL";
		//echo "Je suis étudiant au " . $txt . "!";

		//$x = 38;
		//$y = 12;
		//echo $x + $y;



		//$x = 5; // variable globale
		//function myTest() 
		//	{
 		// l'utilisation de x dans cette fonction générera une erreur
 		//	echo "<p>La variable x à l'intérieur de la fonction est : $x</p>";
		//	}		
		//myTest();
		//	echo "<p>La variable x en dehors de la fonction est : $x</p>";

		//function myTest() 
		//	{
 		//		$x = 12; // variable locale
 		//		echo "<p>La variable x à l'intérieur de la fonction est : $x</p>";
		//	} 
		//myTest();
		// l'utilisation de x en dehors de la fonction générera une erreur
		//	echo "<p>La variable x en dehors de la fonction est : $x</p>";



		//$x = 5.366554;
		//$y = 1445.15558;
		//function myTest() 
		//	{
 		//		global $x, $y;
 		//		$y = $x + $y + $x;
		//	}
		//myTest();
		//	echo $y; // Sortie 15

		//$x = 19;
		//$y = 258;
		//function myTest() 
		//	{
 		//		$GLOBALS['y'] = $GLOBALS['x'] + $GLOBALS['y'];
		//	} 
		//myTest();
		//	echo $y; // Sortie 15



		//function myTest()
		//	{
 		//		static $x = 3;
 		//		echo $x;
 		//		echo "<br>";
 		//		$x++;
		//	}
		//myTest();
		//myTest();
		//myTest();

		//echo "<h2>PHP</h2>";
		//echo "Charles Carnus<br>";
		//echo "C'est aussi un texte<br>";
		//echo "Cette ", "chaîne ", "a été ", "faite ", "avec plusieurs paramètres !";


		//$txt1 = "PHP";
		//$txt2 = "Informatique et réseaux";
		//$x = 89.15;
		//$y = 4.9855;
		//echo "<h2>" . $txt1 . "</h2>";
		//echo "Etudier le PHP en " . $txt2 . "<br>";
		//echo $x + $y;

		//print "<h2>PHP</h2>";
		//print "Bonjour<br>";
		//print "C'est parfait!";

		//$txt1 = "PHP";
		//$txt2 = "Informatique";
		//$x = 579;
		//$y = 14;
		//print "<h2>" . $txt1 . "</h2>";
		//print "Cours d'" . $txt2 . "<br>";
		//print $x + $y;
	
		//$x = "Hello world !";
		//$y = 'Hello world !';
		//echo $x;
		//echo "<br>"; 
		//echo $y;



		//$x = 2023;
		//var_dump($x);

		//$x = 2023;
		//var_dump(is_numeric($x));
		//$x = "2023";
		//var_dump(is_numeric($x));
		//$x = "20.23" + 10;
		//var_dump(is_numeric($x));
		//$x = "Bonjour";
		//var_dump(is_numeric($x));

		// Cast float to int 
		//$x = 123465.789;
		//$int_cast = (int)$x;
		//echo $int_cast;
		//echo "<br>";
		//// Cast string to int
		//$x = "1789";
		//$int_cast = (int)$x;
		//echo $int_cast;

		//class Ordinateur 
		//{
			//public $processeur;
			//public $marque;
		 	//public function __construct($processeur, $marque)
		 		//{
		 			//$this->processeur = $processeur;
		 			//$this->marque = $marque;
		 		//}
			//public function message()
				//{
					//return " Mon ordinateur est un " . $this->marque . " " . 
					//$this->processeur . "!";
 				//}
		//}
		//$monOrdinateur = new Ordinateur("M2", "Apple");
		//echo $monOrdinateur -> message();
		//echo "<br>";
		//$monOrdinateur = new Ordinateur("i7", "HP");
		//echo $monOrdinateur -> message();

		//$x = "Bonjour";
		//$x = null;
		//var_dump($x)

		//echo strlen("Hello world! "); // sortie : 12
		//echo str_word_count("Hello world! "); // sortie : 2
		//echo strrev("Hello world! "); // sortie : !dlrow olleH
		//echo strpos("Hello world! ", "world "); // sortie : 6
		//echo str_replace("world ", "Carnus ", "Hello world !"); // sortie Hello 

		//echo(pi()); // Sortie 3.1415926535898
		//echo(min(0, 150, 30, 20, -8, -200)); // Sortie -200
		//echo(max(0, 150, 30, 20, -8, -200)); // Sortie 150
		//echo(abs(-6.7)); // Sortie 6.7
		//echo(sqrt(64)); // Sortie 8
		//echo(round(0.60)); // Sortie 1
		//echo(round(0.49)); // Sortie 0
		//echo(rand());
		//echo(rand(10, 100));
		// define(name, value, case-insensitive)
		//define("MAVARIABLE", "Charles Carnus ");
		//echo MAVARIABLE;
		//define("GREETINGS", "Charles Carnus ", true);
		//echo GREETINGS;
		//define("ordinateurs", [
		// "Apple",
		// "HP",
		// "DELL"
		//]);
		//echo ordinateurs[0];

		//$t = date("H");
		//if ($t < "18")
		//	{
 		//		echo "Bonjour !";
 		//	}

 		//$t = date("H");
		//if ($t < "18")
		//	{
 		//		echo "Bonjour !";
		//	}
		//else 
		//	{
 		//		echo "Bonsoir !";
		//	}

		$t = date("H");
		if ($t < "10")
			{
 				echo "Bonjour !";
			}
		elseif ($t < "14")
			{
				echo "Bonne journée !";
			}
		else
			{
				echo "Bonsoir !";
			}
	?>
</body>
</html>