<?php
session_start();
if(!isset($_SESSION['username'])){
  header('Location:login');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasboard</title>
    <script type="importmap">
    {
      "imports": {
        "three": "https://unpkg.com/three@v0.162.0/build/three.module.js",
        "three/addons/": "https://unpkg.com/three@v0.162.0/examples/jsm/"
      }
    }
  </script>
  <link rel="stylesheet" href="./css/style.css">
  <style>
    *{
      margin:0;
      padding: 0;
    }
    body{
      position: relative;
    }
    
  </style>
</head>
<body>
<div class="content">

        <div class="create con">
          <div onclick="hide()" class="title">
            <h1>Create art </h1>
          </div>
          <div id="createCont" >
          <div class="uploader">
            <img style="display: none;" src="/projext_php/img/image.png" id="imgTag" alt="">
                  <label for="">Upload Art</label>
                  <input class='art-config' require name="file" onchange="getimg(event)" type="file" name="" id="file" accept="image/*">
              </div>
              <div>
                  <label for="">Name</label>
                  <input class='art-config' required name="art_name" type="text">
              </div>
              <div>
                <label for="">Category</label>
                <select class='art-config'  name="category" id="">
                  <option value="others">others</option>
                  <option value="Paint">Paint</option>
                   <option value="Photo">Photo</option>
                   <option value="Draw">Draw</option>
                   <option value="3d">Sculpture</option>
              </select>
            </div>
              <div>
                  <label for="">width</label>
                  <input class='art-config'  name="width" type="range" id="w">
              </div>
              <div>
                  <label for="">height</label>
                  <input class='art-config'  name="height" type="range" id="h">
              </div>
              <div>
                  <label for="">About</label>
                  <textarea class='art-config'  onchange="change(event)"name="discription" id="" cols="20" rows="5" maxlength="50px"></textarea>
              </div>
              <div>
                <label for="">Rs</label>
                <input class='art-config'  name="price" type="number">
              </div>
              <div>
                  <label for="">Artist Name</label>
                  <input class='art-config'  type="text" name="artist_name">
              </div>
              <div>
                  <label for="">Frame Color</label>
                  <input class='art-config' style="padding:0;" type="color" id="color" name="color">
              </div>
              <div>
                <input class='art-config' type="hidden" name="id" value="">
                <input class='art-config' type="hidden" id="position" value="" name="position">
                <button onclick="sendData(event)" type="submit">Save</button>
               
              </div>
              </div>
            </div>
            <div class="settings con">
        <div  class="title">
            <h2>Room Setting</h2>
          </div>
        <div class="settingCont">
          <div class="uploader">
            <img style='display:none;' class="roomimgTag" src="/projext_php/img/image.png" alt="walls">
                  <label for="">Upload wall texture</label>
                  <input class="roominput" name="wallimg"  type="file" accept="image/*">
              </div>
          <div class="uploader">
            <img style='display:none;'  class="roomimgTag"  src="/projext_php/img/image.png" alt="ceiling">
                  <label for="">Upload ceiling texture</label>
                  <input class="roominput" name="ceilingimg"  type="file"  accept="image/*">
              </div>
          <div class="uploader">
            <img style='display:none;'  class="roomimgTag" src="/projext_php/img/image.png"  alt="floor">
                  <label for="">Upload floor texture</label>
                  <input name="floorimg"  onchange="getRoomT(event)" class="roominput" type="file"  accept="image/*">
              </div>
          <div> 
            <label for="">Length</label>
              <input class="roominput" type="range" name="length" value="0">
          </div>
          <div>
            <label for="">Breadth</label>
            <input class="roominput" type="range" name="breadth">
          </div>
          <div>
            <button id="subtroom" type="submit">save</button>   
          </div>
        </div>
        </div>
      
          </div>
          
   </div>
   <?php 
     echo "<script> const user=".$_SESSION['user_id']."</script>";
     ?>
    <script>
      
     
     
   //   console.log(user)
      var dis={}
      function change(e){
       dis[e.target.name]=e.target.value
       // console.log(dis)
      }
      //for(let i=1;i<input.length;i++){
       
       //input[i].onchange=change
       //console.log(input[i].onchange)
      //}
     
      function getimg(e){
        
       
        var imgTag=document.getElementById('imgTag')
        var imgformat=['jpg','png']
        if(!imgformat.includes(e.target.files[0].name.split('.')[1].toLowerCase())){
          alert("file not supported")
          e.target.value=''
          dis.file=""
           return
        }
        if(imgformat.includes(e.target.files[0].name.split('.')[1].toLowerCase())){
         console.log(3)
          imgTag.style='display:block;'
          imgTag.src=URL.createObjectURL(e.target.files[0])
       // console.log('working')
       dis[e.target.name]=e.target.value
        }
        else{
          imgTag.style='display:none;'
        }
       
      }
        var create=document.querySelector('#createCont')
         var contentO=document.querySelector('.content')
         var xisHidden=true


      function hide(){
          
            if(xisHidden){
            create.style.display="block"
            xisHidden=false

            }
            else if(!xisHidden){
              console.log(create)
                create.style.display="none"
                xisHidden=true
            }
         

        }
        
    var gettexture=document.getElementsByClassName('gettexture')
    var walltextureImgs={}
   
    function getRoomT(){
      for(let i of gettexture){
      walltextureImgs[i.name]=i.src
    }
    
    console.log(walltextureImgs)
    }
    
    async function postJSON(data) {
  try {
    const response = await fetch("phpFile/art_CRUD.php", {
      method: "Post", 
      headers: {
       // "Content-Type": "multi-form-data/form-data",
      },
     body:data,
    });

    const result = await response.text();
    console.log("Success:", result);
  } catch (error) {
    alert("cannot create arts")
    console.error("Error:", error);
  }
}
var inputValues=new FormData()
function getArtInput(e){
        const artconfig=document.querySelectorAll('.art-config');
       
        for(let i of artconfig){
          
          if(i.type=='file'){
            inputValues.append(i.name,i.files[0])
            //inputValues[i.name]=i.files[0]
            //console.log(inputValues.append(i.name,i.files[0]))

          }
          else{
            //console.log(i.name,i.value)
            inputValues.append(i.name,i.value)
          }
        
        
        }
        
        //checkValid(input)
       return inputValues
      }
      function sendData(e){
        const values=getArtInput(e);
       
       console.log(values.forEach((e)=>{
console.log(e)
        }))
       // values.forEach((d)=>{console.log(d)})
        //postJSON(values)
      }
      console.log(values)
</script>

    <script type="module" src="./js/dasboard.js"></script>
    <script>console.log(inputValues)</script>
</body>
</html>