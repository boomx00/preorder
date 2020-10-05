<?php require_once 'include/header.php'; ?>
<?php
session_start();
require_once 'php_action/db_connect.php';
if($_SESSION['username'] == ""){
  header('location:'.$store_url.'index.php');
}
 ?>
  <!-- Slideshow container -->
  <div style="margin-top:50px;margin-bottom:50px;">
  <div class="slideshow-container">

    <!-- Full-width images with number and caption text -->
    <div class="mySlides">
      <div class="numbertext">1 / 3</div>
      <img src="test6.jpg" style="width:100%">
      <div class="text">Caption Text</div>
    </div>

    <div class="mySlides">
      <div class="numbertext">2 / 3</div>
      <img src="test5.jpg" style="width:100%">
      <div class="text">Caption Two</div>
    </div>



    <!-- Next and previous buttons -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
  </div>
  <br>

  <!-- The dots/circles -->
  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
  </div>
<div>
<hr/ style="width:80%">
<div class="mainbody display-3">
  <div style="text-align:center">Our Menu</div>
</div>
</div>
</div>

<div class="cardClass" style="width:80%;margin: auto;padding-bottom:30px;">
  <div class="row">
    <div class="col-sm-6">
      <div class="card" style="width: auto;">
  <img class="card-img-top" src="food2.jpg" alt="Card image cap" style="width:600px; margin:auto">
  <div class="card-body">
    <h5 class="card-title">Burger</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="/preorder/food/burger.php" class="btn btn-primary">Order Now</a>
  </div>
</div>
    </div>

    <div class="col-sm-6">
      <div class="card" style="width: auto;">
  <img class="card-img-top" src="food2.jpg" alt="Card image cap" style="width:600px; margin:auto">
  <div class="card-body">
    <h5 class="card-title">Curry</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Order Now</a>
  </div>
</div>
    </div>
  </div>
</div>


<div class="cardClass hidden" style="width:80%;margin: auto;">
  <div class="row">
    <div class="col-sm-6">
      <div class="card" style="width: auto;">
  <img class="card-img-top" src="food2.jpg" alt="Card image cap" style="width:600px; margin:auto">
  <div class="card-body">
    <h5 class="card-title">Burger</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Order Now</a>
  </div>
</div>
    </div>

    <div class="col-sm-6">
      <div class="card" style="width: auto;">
  <img class="card-img-top" src="food2.jpg" alt="Card image cap" style="width:600px; margin:auto">
  <div class="card-body">
    <h5 class="card-title">Curry</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Order Now</a>
  </div>
</div>
    </div>
  </div>
</div>
<hr/>

<div class="footer" style="padding-left:39%;">
  <nav class="navbar navbar-expand-lg navbar-light ">

    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="#">Instagram <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Facebook</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Whatsapp</a>
        </li>
      </ul>

    </div>
  </nav>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" activeo", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " activeo";
}
</script>

</body>
</html>
