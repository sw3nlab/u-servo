<?php

$id = $_GET['id'];

$name = $_POST['name'];
$cmd = $_POST['cmd'];

function get_commands(){

		$buff = "";

			$files = glob("commands/*.txt");

			for($i=0;$i<count($files);$i++){

					$cname = str_replace("commands/","",str_replace(".txt","",$files[$i]));

					$buff.= "<tr><td>".($i+1)." <a href='?id=".$cname."'>".$cname."</a> </td><td> <a href='run.php?id=".$cname."'>Выполнить</a><br/></td></tr>";

							}


		return "<table border='0'>".$buff."</table>";

			}


function get_cmd($id){

if(!$id){return "";}

$content = file_get_contents("commands/".$id.".txt");

return $content;
}


function save_command($name,$cmd){

		$fname = htmlspecialchars(trim($name));

if(!$fname or $fname == ""){return " ";}


			$fp = fopen("commands/".$fname.".txt",w);
			fwrite($fp,$cmd);
			fclose($fp);

return "<center>сохранено</center>";

			}

echo "

<html>
<head>
<title>ARM u-servo WEB interface</title>
</head>

<body>

<center>

<h1><tt>U-servo Формирование команд</tt></h1>
<hr>
".save_command($name,$cmd)."
<table border='0' width='90%' height='90%'>

<tr>
<td width='20%' align='left' valign='top'>Набор команд<br/><form action='' method='post'><textarea name='cmd' cols='30' rows='15'>".get_cmd($id)."</textarea></td>

<td width='40%' align='center' valign='top'>

Сохранить набор в алиас:<br/>
<br/>--------><br/>
<br/>Название алиаса:<br/><input type='text' value='".$id."' name='name'><br/>
<input type='submit' value='Сохранить'>
</form>

</td>

<td width='30%' align='left' valign='top'>Алиасы:<br/>".get_commands()."</td>

</tr>

</table>
<hr>
<center><small>1/12/2018 (<a href='https://vk.com/cyberunit'>cyberunit</a>)<br/>github: https://github.com/sw3nlab/u-servo</small></center>

</body>

</html>
"
;?>
