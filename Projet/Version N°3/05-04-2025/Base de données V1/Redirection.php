<!DOCTYPE html>
<!--[if gt IE 8]><html class="no-js ie9-plus" lang="fr-FR"><![endif]-->
<html class="no-js" lang="fr-FR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="refresh" content="5; URL=admin.php">
  <meta http-equiv="refresh" content="5; URL=Visuel.html">

<!-- Plugin tableau d'information début -->

<script type="text/javascript" src="ckeditor/ckeditor.js"></script>


<!-- Plugin tableau d'information fin -->

 <style type="text/css">  
 #empty {  
  background-color: rgba(132,125,255,0.2);  
  border: 3px solid rgb(0,0,0);  
  border-radius: 20px;  
  height: 20px;  
  width: 200px;  
  padding: 0px;  
  margin: auto;  
  margin-top: 5%;  
 }  

 #d2 {  
  position: absolute;  
  overflow: hidden;  
  clip: rect(0px,0px,20px,0px);  
  background-color: rgba(71,62,255,0.7);  
  height:20px;  
  width: 200px;  
  padding:0px;  
  border-radius: 20px;  
 }  
 
 h1{
   color: black;
   text-align: center;
   background-color: #dacbae;
   border-radius: 10px;
   border-color: black;
   border: 3px solid;
   align-content: center;
   margin-left: 35%;
   margin-right: 35%;
 }
 
 </style>  
 <script type="text/javascript">  
 <!--  
  function mTimeStamp() {  
   var time = new Date();  
   time = Date.parse(time)+time.getMilliseconds()  
   return time;  
  }  
   
  function progBar() {  
   elm = document.getElementById('d2');  
   elm.timeStart = mTimeStamp();  
   var duree = 5000;  
   var valEnd = 200;  
   var valActu = 0;  
   elm.interval = setInterval(function() {  
    valActu = (mTimeStamp() - elm.timeStart) / duree * valEnd;  
    if(valActu > valEnd) valActu = valEnd;  
    elm.style.clip= 'rect(0px,' + valActu + 'px,20px,0px)';  
     if(valActu == valEnd) clearInterval(elm.interval);  
   },10);  
  }  
  
 </script>  
 
<!-------------------------------------------------------------->
</head> 
<body style="background:url('fond.jpg') repeat;">


<Font color=#FFFFF align=center>
<h1>Enregistrement des modifications...</H1>
</Font>

<div id="empty">  
<div id="d2"></div>  
</div>  
<script type="text/javascript">  

  progBar();  
 
</script> 



<!-- Enregistrement début -->

<?php
if (isset($_POST['contenu']))
{
  $file = fopen('Visuel.html','w');
  echo fwrite($file,$_POST['contenu']);
  fclose($file);
}
?>

<!-- Enregistrement fin -->

</body>
  
</html>