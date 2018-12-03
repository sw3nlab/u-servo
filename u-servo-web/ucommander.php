<?php

/********************ucommander.php********************/
/******************************************************/
/*************Модуль формирования команд***************/
/******************************************************/
/******************************************************/
/******************************************************/

$id = $_GET['id'];

$name = $_POST['name'];
$cmd = $_POST['cmd'];

function get_commands(){

		$buff = "";

			$files = glob("commands/*.txt");

			for($i=0;$i<count($files);$i++){

					$cname = str_replace("commands/","",str_replace(".txt","",$files[$i]));

					$buff.= ($i+1)." <a href='?id=".$cname."'>".$cname."</a><br/>";

							}


		return $buff;

			}


function get_cmd($id){

if(!$id){return "";}

$content = file_get_contents("commands/".$id.".txt");

return $content;
}


function save_command($name,$cmd){

		$fname = htmlspecialchars(trim($name));

if(!$fname or $fname == ""){return "Name is empty ";}


			$fp = fopen("commands/".$fname.".txt",w);
			fwrite($fp,$cmd);
			fclose($fp);

return "<center>OK</center>";

			}




echo "

<html>
<head>
<title>ARM u-servo WEB interface</title>
</head>

<body>

<center>

<h1><tt>U-servo COMMAND TRAINER</tt></h1>
<hr>
".save_command($name,$cmd)."
<table border='0' width='90%' height='90%'>

<tr>
<td width='30%' align='left' valign='top'>COMMAND FRAME<br/><form action='' method='post'><textarea name='cmd' cols='50' rows='30'>".get_cmd($id)."</textarea></td>

<td width='30%' align='center' valign='top'>

<br/>--------><br/>
<br/>СОхранить этот набор команд как:<br/>
<br/>--------><br/>
<br/>NAME:<input type='text' value='Взять ложку =)' name='name'><br/>
<input type='submit' value='SAVE'>
</form>

</td>

<td width='30%' align='left' valign='top'>COMMAND LIST<br/>".get_commands()."</td>

</tr>

</table>
<hr>
<center><small>1/12/2018 (<a href='https://vk.com/cyberunit'>cyberunit</a>)<br/>github: https://github.com/sw3nlab/u-servo</small></center>

</body>

</html>

"


;?>
