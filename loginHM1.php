<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login HolaMundo1</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>

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

  body{
    background-color:var(--background,green);
    display:flex;
justify-content:center;
align-items:center;
height:450px;

  }

  .main{
    background-color:var(--loginBG,white);
    width: 90%;
    max-width:600px;
    height:300px;
    border-radius:10px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
   
  }

  .main h1{
    text-align:center;
    padding:20px 0 10px 0;
  }

  tab-panel div:nth-child(1)
 {
    text-align:center;
    border-bottom:solid gray 2px ;
  }

  tab-panel div:nth-child(2),
  tab-panel div:nth-child(3)
 {
    text-align:center;
    border-bottom:solid gray 2px ;
    padding:20px 0;
    
  }
  

  tab-panel div button{
    margin: 0px ;
    border-bottom:none;
    padding:5px;
    background-color:var(--buttonBG,green);
  }

  tab-panel div button:active{
    background-color: green;
  }
  tab-panel div button:hover{
    background-color: green;
  }
  tab-panel div button:focus{
    background-color: green;
  }
  tab-panel div button:visited{
    background-color: green;
  }
  tab-panel div button:nth-child(1){
    
    border-right:none;
   
    
  }

  #submit,#submitLog{
    padding:5px;
    background-color:var(--submitBtnColor,black);
    color:white;
  }

</style>

</head>
<body>
  


<?php
// define variables and set to empty values
$nameErr = $username = "";






if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = test_input($_POST["username"]);
 if (empty($_POST["username"])) {
    $nameErr = "Debes ingresar un nombre de usuario";
  } else {
    $username = test_input($_POST["username"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9a-zA-Z-' ]*$/",$username)) {
      $nameErr = "Only letters, numbers and white space allowed";
    }
  }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = test_input($_POST["usernameLog"]);
 if (empty($_POST["usernameLog"])) {
    $nameErr = "Debes ingresar un nombre de usuario";
  } /*else {
    $username = test_input($_POST["usernameLog"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9a-zA-Z-' ]*$/",$username)) {
      $nameErr = "Only letters, numbers and white space allowed";
    }
  }*/
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>



<div class="main">
<h1> Welcome! </h1>

<tab-panel>
  <div data-tabname="Log In">

  <form method="post" action="holaMundo1.php">  
  Username: <input id="usernameLog"  required type="text" name="usernameLog" value="<?php echo $name;?>">
  <span class="error" id="spanLog">* <?php echo $nameErr;?></span>
  <br><br>  
  
  <input id="submitLog" type="submit" name="submit" value="Log in">  
</form>


 
  </div>

  <div data-tabname="Sign Up">
  <form method="post" action="holaMundo1.php">  
  Username: <input id="username"  required type="text" name="username" value="<?php echo $name;?>">
  <span id="span" class="error">* <?php echo $nameErr;?></span>
  <br><br>  
  
  <input id="submit"  type="submit" name="submit" value="Sign Up">  
</form>

  </div>

</tab-panel>

</div>







<script>
let result;
let changed=false;

document.querySelector("#submitLog").disabled=true;
document.querySelector("#submit").disabled=true;

console.log(changed);

function verificar(text){
 
 result= /^[\wñ]+( [\wñ]+)*$/.test(text);
  console.log(result);
  if(!result){
    document.querySelector("#submit").disabled=true;
    document.querySelector("#span").textContent="solo letras y números separados por un espacio";
   return false;
  }else{
    console.log("aqui")
    return true;
  }
}

function verificarLog(text){
  
 // console.log(document.querySelector("#usernameLog").value);
 // console.log(/^\w+( \w+)*$/.test(document.querySelector("#usernameLog").value))
  result= /^\w+( \w+)*$/.test(text);
  console.log(result);
  if(!result){
    document.querySelector("#spanLog").textContent="solo letras y números separados por un espacio";
    //document.querySelector("#submitLog").disabled=true;
  }else{
    console.log("aqui")
   // document.querySelector("#submitLog").disabled=false;
  }
  
}



function getUsername(){

  let username= document.querySelector("#username").value;
  let url="validator.php?username="+username;
  let request= new XMLHttpRequest();
  request.open("GET",url,true);
  request.onreadystatechange =function(){
    if (this.readyState == 4 && this.status == 200) {

      console.log(request.responseText.length);
      if(request.responseText.length>1){
        document.querySelector("#span").textContent="el nombre de usuario '"+ request.responseText+"' ya está siendo usado";
        let btn = document.getElementById('submit');
        btn.disabled=true;

      }else{
        let btn = document.getElementById('submit');
        document.querySelector("#span").textContent="";
        btn.disabled=false;
      }
    }
  };
  request.send();

}

function getUsernameLog(){
  
  let username= document.querySelector("#usernameLog").value;
  let url="validator.php?username="+username;
  let request= new XMLHttpRequest();
  request.open("GET",url,true);
  request.onreadystatechange =function(){
    if (this.readyState == 4 && this.status == 200) {

      console.log(request.responseText.length);
      if(request.responseText.length>1){
        let btn = document.getElementById('submitLog');
        document.querySelector("#spanLog").textContent="";
        btn.disabled=false;
       

      }else{
      
        document.querySelector("#spanLog").textContent="el nombre de usuario '"+ request.responseText+"' no existe";
        let btn = document.getElementById('submitLog');
        btn.disabled=true;
      }
    }
  };
  request.send();

}



function asTabs(node) {
    let tabs = Array.from(node.children).map(node => {
      let button = document.createElement("button");
      button.textContent = node.getAttribute("data-tabname");
      let tab = {node, button};
      button.addEventListener("click", () => selectTab(tab));
      return tab;
    });

    let tabList = document.createElement("div");
    for (let {button} of tabs) tabList.appendChild(button);
    node.insertBefore(tabList, node.firstChild);

    function selectTab(selectedTab) {
      for (let tab of tabs) {
        let selected = tab == selectedTab;
        tab.node.style.display = selected ? "" : "none";
        tab.button.style.color = selected ? "white" : "";
        tab.button.style.backgroundColor = selected ? "green" : "";
      }
    }
    selectTab(tabs[0]);
  }

  asTabs(document.querySelector("tab-panel"));


  let textarea = document.querySelector("#usernameLog");
  let timeout;
  textarea.addEventListener("input", () => {
  clearTimeout(timeout);
  timeout = setTimeout(checkUsername, 500);
  });

  function checkUsername(){
    changed=true;
    console.log(changed);
    verificarLog(textarea.value);
    console.log(textarea.value)
    getUsernameLog();
  }

  let newUser = document.querySelector("#username");
  let timeout2;
  newUser.addEventListener("input", () => {
  clearTimeout(timeout2);
  timeout2 = setTimeout(checkNewUsername, 500);
  });

  function checkNewUsername(){
    changed=true;
    console.log(changed);
    if(verificar(newUser.value)){
      console.log(newUser.value)
    getUsername();
    }
    
  }


</script>
</body>
</html>