<!DOCTYPE html>

<?php
session_start();
//echo session_id();


$dbhost="localhost";

$user="root";
$password="";
$db="motos";
$con=mysqli_connect($dbhost,$user,$password,$db);

if(mysqli_connect_errno()){
 // echo "Failed to connect to Mysql: " .mysqli_connect_error();
  exit();
}
//echo "conexion exitosa";

function query($con,$query){
  $result=mysqli_query($con,$query);
  return $result;
}

function getSingle($con,$query){
  $result=query($con,$query);
  $row= mysqli_fetch_row($result);
  return $row[0];
}

$result=query($con,"Select * from disponibles");


if($result){
  $rows=mysqli_num_rows($result);
 // echo "returned rows are: " . $rows;
  if($rows==0){
   // echo "erocerocero: " . $rows;
    $a=1;
    while ($a <= 25) {
      query($con,"insert into disponibles(motosDisp) values(8) ");
      $a++;
    }
  }
  mysqli_free_result($result);
}

$nameErr = $username =  $usernameLog=$userFinal="";
//echo "new user: ";
//echo strlen($_POST["username"]);
//echo "user log: ";
//echo strlen($_POST["usernameLog"]);

if(strlen($_POST["usernameLog"])==0 && strlen($_POST["username"])==0){
//  echo "session user: ";
 // echo $_SESSION["user"] ;
//  echo " <<";
}else{
  if(strlen($_POST["usernameLog"])<strlen($_POST["username"])){
    $_SESSION["user"] = $_POST["username"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = test_input($_POST["username"]);
 //echo $username;
  if (empty($_POST["username"])) {
    $nameErr = "Debes ingresar un nombre de usuario";
  } else {
    $username = test_input($_POST["username"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9a-zA-Z-' ]*$/",$username)) {
      $nameErr = "Only letters, numbers and white space allowed";
    }

    //$username= mysqli_real_escape_string($con,test_input($_POST["username"]));
   
    $uid=getSingle($con,"select uid from users where name= '$username'");
    if(!$uid){
      query($con,"insert into users(name) values('$username') ");
    }
    
 
  }

 
}


  }else{
    $_SESSION["user"] = $_POST["usernameLog"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
  $usernameLog = test_input($_POST["usernameLog"]);
  if (empty($_POST["usernamelog"])) {
    $nameErr = "Debes ingresar un nombre de usuario";
  } else {
    $usernameLog = test_input($_POST["usernamelog"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9a-zA-Z-' ]*$/",$usernameLog)) {
      $nameErr = "Only letters, numbers and white space allowed";
    }
  }

  
}

  }
  //$_SESSION["user"] = $_POST["username"];
  //echo "session user: ";
  //echo $_SESSION["user"] ;
 // echo " <<";
}









$userFinal=$_SESSION["user"];


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

print <<<EOF


<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title> HolaMundo1</title>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
<title>hola mundo 1</title>
<script src="moment.js"></script>

<style>
* {
  box-sizing: border-box;
  padding: 0;
  margin: 0;
}

:root{
--background: #79b958;
--loginBG: #fffcff;
--buttonBG:#4daf50;
--submitBtnColor:#31444e;
}


html{
  font-size: 1.6em ;
}

body{
background-color:var(--background,green);
display:flex;
justify-content:center;
align-items:center;


}

main{
 width:90%;
 
}

.container{
  width:100%;
  display:flex;
  justify-content:center;
  flex-direction:column;
  padding-top:50px;
  align-items:center;
}

.container h1{
  font-weight:800;
  margin-bottom:20px;
}

.container h5{
  margin-bottom:20px;
}

.timeBtn{
  margin:10px;
  padding:10px;
  
  
}

.timeBtn:hover{
  cursor: pointer;
}

table{
  background-color:var(--loginBG,white);
  width: 90%;
  max-height: 70vh;
  overflow:auto;
  display:flex;
  flex-direction:column;
  justify-content:center;
  border-radius:10px;
  box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
  margin-bottom: 50px;
}

table tbody{
  padding:20px 0;
  
  display:flex;
  justify-content:center;
  flex-direction:column;
  
}

tr{
display:flex;
justify-content:center;
  
  
}


@media only screen and (min-width: 768px) {
  table{width:50%;}
}

@media only screen and (min-width: 992px) {
 
}

</style>

</head>
<body>

<main>

<div class="container">

<h1>Welcome $userFinal </h1>

EOF;

$res= query($con,"select ");


print <<<EOF

<h5>Selecciona un horario</h5>



EOF;


$result=query($con,"select * from disponibles");

$horarios=array();
/*
$row = mysqli_fetch_array($result);
printf (" %s (%s)\n", $row[0], $row[1]);*/

while($row= mysqli_fetch_array($result)){
  $horarios[]=$row;
}

  
//print_r($horarios);
$userID=getSingle($con,"select uid from users where name='$userFinal'");
//echo "aquiqui: ";
//echo $userID;
$r= query($con,"select horario from selections where uid=$userID ");
$timeSelected= mysqli_fetch_array($r)[0];




$r1= query($con,"select horarioId from disponibles where motosDisp=0");
$horariosNoDisp=array();
//echo $timeSelected;
while($row1= mysqli_fetch_array($r1)){
  
  if ($timeSelected!=$row1[0]){
    $horariosNoDisp[]=$row1;
  }
 else{} 
}


$initialTime="08:00";
displayHorarios($con,$horarios,$initialTime,$timeSelected,$horariosNoDisp);

function convertToHora($time){
  
  $inicio="08:00";
  if($time%60==0){
    $newTime=8+floor($time/60);
    if($newTime<10) return "0".$newTime.":00";
    else return $newTime.":00";
  }
  else{
    $n=$time/30;
    $newTime=8+($n-1)/2;
    if($newTime<10) return "0".$newTime.":30";
    else return $newTime.":30";
  }
}

function isTimeAvailable($time,$arr){
  foreach($arr as $row){
    $h=$row[0];
    if($h==$time){
      return false;
    }
  
  }
  return true;
}

function displayHorarios($con,$horarios,$initialTime,$timeSelected,$horariosNoDisp){
  print("<table border=1>");

 
 

  foreach($horarios as $row){
    
    $horario=$row[0];   
    $time= ($horario-1)*30;
    $convertedTime=convertToHora($time);

    if(!isTimeAvailable($horario,$horariosNoDisp)){

      $color="red";
    }

    else if($horario==$timeSelected){
      $color="green";
    }else{
      $color="#e5e0dd";
    }

      print <<<EOF

  
    <tr><td> <div class="timeBtn" style="background-color:$color;" onclick="selectTime()" id="$horario" > $convertedTime </div> </td></tr>
    EOF;
  }
  print("</table>");
}






print <<<EOF

</div>
</main>


<script>
  let table= document.querySelector("tbody");
  let row= document.querySelector("tbody tr:nth-child(1)");
  let title= document.querySelector("h1");  
  
  let rect = table.getBoundingClientRect();
  
  let rectRow = row.getBoundingClientRect();
  let y = rect.top;
 // console.log(y);
  let y1 = rectRow.height;
  //console.log(y1);
  let dist= 10*y1;
  
  for(let i=1;i<26;i++){
    let el=document.getElementById(i).parentNode.parentNode;
   //
    el.style.transform="translateY("+dist+"px)";
   // console.log(el.getBoundingClientRect())
  }

  let tableCont= document.querySelector("table");
  let rectContTable = tableCont.getBoundingClientRect();
  

 
  let tableClone = table.cloneNode(true);
  document.body.appendChild(tableClone);
  tableClone.style.position="absolute";
  tableClone.style.top="-10000px";
  tableClone.style.left="-10000px";
  tableClone.style.overflow="visible";
  let rectClone = tableClone.getBoundingClientRect();
  let rcHeight= rectClone.height;
  //console.log(rcHeight);

  let scrollMax=rcHeight-rectContTable.height-10;
  console.log(rectContTable.height)
  console.log(rcHeight)
  console.log(scrollMax);
  tableClone.remove();

 

  tableCont.addEventListener("scroll", function(e){
    
    let dom= e.target;       
  console.log(dom.scrollTop);
  console.log(scrollMax);
  
if(tableCont.children.length==1){
  console.log(true);
  if(dom.scrollTop==0){
     
    
    dom.scrollTop=1500;
   }

  if(dom.scrollTop>=scrollMax){
     console.log("done");
      let cln= table.cloneNode(true);
      dom.appendChild(cln);
      let ps= cln.previousSibling.previousSibling;
      ps.remove();
    }

}else{
  let dom= e.target;       
  
  if(dom.scrollTop==0){
     
    dom.scrollTop=1000;
   }


  if(dom.scrollTop-1000>=scrollMax){
    console.log("yes");
     let cln= table.cloneNode(true);
     dom.appendChild(cln);
     let ps= cln.previousSibling.previousSibling;
     ps.remove();
   }
}
    
    
  

  });
    
 

  





</script>


<script>


function elt(name, attrs, ...children) {
  let dom = document.createElement(name);
  for (let attr of Object.keys(attrs)) {
  dom.setAttribute(attr, attrs[attr]);
  }
  for (let child of children) {
  dom.appendChild(child);
  }
  return dom;
  }

function selectTime(){
  let dom=event.target;
 // console.log(dom);
//console.log(event.target.id);
let username= '$userFinal';
let time=event.target.id;
let url="timeSelector.php?username="+username+"&time="+time;
//console.log(url);
let request= new XMLHttpRequest();
request.open("GET",url,true);
request.onreadystatechange =function(){
  if (this.readyState == 4 && this.status == 200) {
    console.log(request);
   // console.log(request.responseText.length);
    //console.log(request.responseText==" inserted");
    if(request.responseText.length==14){
     // dom.setAttribute("style", "background-color:red;");
      dom.style.backgroundColor="red";
    }
    else if(request.responseText.length==9){
     // dom.setAttribute("style", "background-color:green;");
      dom.style.backgroundColor="green";



      
    }else if(request.responseText.length==8){
      //dom.setAttribute("style", "background-color:yellow;");
      dom.style.backgroundColor="#e5e0dd";
    }
  } 
};
request.send();


}
</script>


<script>
if(window.history.replaceState){
    window.history.replaceState(null,null,window.location.href);
  }
</script>


</body>

</html>


EOF;




mysqli_free_result($result);

mysqli_close($con);
?>