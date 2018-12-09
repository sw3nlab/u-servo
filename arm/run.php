<?php

$id = $_GET['id'];
$cmd_line = $_GET['l'];
$cmd_list = file("commands/".$id.".txt");
$buff = "";

if($cmd_line>=count($cmd_list))die("<meta http-equiv='refresh' content='2;url=arm.php?id=".$id."'>End command alias<br/><a href='arm.php?id=".$id."'><=Back</a>");

for($i=0;$i<count($cmd_list);$i++){
$buff.=$cmd_list[$i]."<br/>";
}

system('echo "'.trim($cmd_list[$cmd_line]).'">/dev/ttyUSB0');
sleep(1);
$cmd_line++;
echo "Выполняем алиас: ".$id." <a href='arm.php?id=".$id."'>Назад</a><br/>
Кол-во комманд:".count($cmd_list)."
<br/>Команды:
<br/>".str_replace($cmd_list[($cmd_line-1)],'<b>'.$cmd_list[($cmd_line-1)].'</b><== RUN',$buff)."<meta http-equiv='refresh' content='2;run.php?id=".$id."&l=".$cmd_line."&debug=".$cmd_list[$cmd_line]."'>";


?>
