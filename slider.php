<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
section {box-sizing: border-box}
section {font-family: Verdana, sans-serif; margin:0}
.mySlides {display: none; transition: opacity 1s ease-in-out;}
.image img{vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}
.image img{
    width: 100%;
    height: 400px;
    border-radius: 15px;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.5s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  animation-name: fade;
  animation-duration: 3.6s;
}

@keyframes fade {
  from {opacity: .6} 
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
</style>
</head>
<body>
<section>
<div class="slideshow-container">

<?php
$image_urls = '[
    "https://lipglossandcrayons.com/wp-content/uploads/2017/02/makeup-stock-3.png",
    "https://wallpapercave.com/wp/wp2004258.jpg",
    "https://file.tesmino.ir/images/2022/07/images_1658301534.jpg"
]';

$image_urls = json_decode($image_urls);

foreach ($image_urls as $key => $url) {
    echo '
    <div class="mySlides fade">
        <div class="numbertext">' . ($key + 1) . ' / ' . count($image_urls) . '</div>
        <div class="image">
            <img src="' . $url . '" style="width:100%">
        </div>
    </div>';
}
?>

<a class="prev" onclick="plusSlides(-1)">❮</a>
<a class="next" onclick="plusSlides(1)">❯</a>

</div>
<br>

<div style="text-align:center">
<?php
foreach ($image_urls as $key => $url) {
    echo '<span class="dot" onclick="currentSlide(' . ($key + 1) . ')"></span>';
}
?>
</div>
</section>
<script>
let slideIndex = 1;
showSlides();

let slideInterval = setInterval(plusSlides, 3500, 1);

function plusSlides(n) {
  clearInterval(slideInterval);
  slideIndex += n;
  if (slideIndex > document.getElementsByClassName("mySlides").length) {
    slideIndex = 1;
  }
  if (slideIndex < 1) {
    slideIndex = document.getElementsByClassName("mySlides").length;
  }
  showSlides();
  slideInterval = setInterval(plusSlides, 3500, 1);
}

function currentSlide(n) {
  clearInterval(slideInterval);
  slideIndex = n;
  showSlides();
  slideInterval = setInterval(plusSlides, 3500, 1);
}

function showSlides() {
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("dot");
  for (let i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (let i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex - 1].style.display = "block";
  dots[slideIndex - 1].className += " active";
}
</script>

</body>
</html>
