<?php 
include('../user/assets/config/dbconn.php');

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('../user/inc/header.php');
    ?>
    
</head>
    
    <div class="loader-mask">
        <div class="loader">
            <div></div>
            <div></div>
        </div>
    </div>
    
 
  <body class="vertical  light">
    <div class="wrapper">
    <div class="wrapper">


    <?php include('../user/inc/navbar.php');
        ?>
    <?php include('../user/inc/sidebar.php');
        ?>

      <main role="main" class="main-content">

<!--For Notification header naman ito-->
        <?php include('../user/inc/notif.php'); 
        ?>

<!--YOUR CONTENTHERE-->
<div class="data-card">
    <div class="card">
        <div class="card-header">
        </div>


        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                <div class="image-container">
                <img class="stretched" src="images/.jpg" alt="Stretched Image">

                </div>
                <div class="card__container">
                <article class="card__article">
                <img src="images/zoning.jpg" alt="image" class="card__img">

                <div class="card__data">
                  <span class="card__description">HMMM</span>
                  <h2 class="card__title">Zoning</h2>
                  <a href="#" class="card__button">Click</a>
               </div>
            </article>

            <article class="card__article">
               <img src="assets/img/landscape-2.png" alt="image" class="card__img">

               <div class="card__data">
                  <span class="card__description">HMMM</span>
                  <h2 class="card__title">Permit</h2>
                  <a href="#" class="card__button">Click</a>
               </div>
            </article>

            <article class="card__article">
               <img src="assets/img/landscape-3.png" alt="image" class="card__img">

               <div class="card__data">
                  <span class="card__description">HMMM</span>
                  <h2 class="card__title">About</h2>
                  <a href="#" class="card__button">Read More</a>
               </div>
<style>
:root {
  /*========== Colors ==========*/
  /*Color mode HSL(hue, saturation, lightness)*/
  --first-color: hsl(82, 60%, 28%);
  --title-color: hsl(0, 0%, 15%);
  --text-color: hsl(0, 0%, 35%);
  --body-color: hsl(0, 0%, 95%);
  --container-color: hsl(0, 0%, 100%);

  /*========== Font and typography ==========*/
  /*.5rem = 8px | 1rem = 16px ...*/
  --body-font: "Poppins", sans-serif;
  --h2-font-size: 1.25rem;
  --small-font-size: .813rem;

}

/*========== Responsive typography ==========*/
@media screen and (min-width: 1120px) {
  :root {
    --h2-font-size: 1.5rem;
    --small-font-size: .875rem;
  }
}

/*=============== CARD ===============*/
.container {
  display: grid;
  place-items: center;
  margin-inline: 1.5rem;
  padding-block: 5rem;
}

.card__container {
  display: grid;
  row-gap: 3.5rem;
}

.card__article {
  position: relative;
  overflow: hidden;
}

.card__img {
  width: 328px;
  border-radius: 1.5rem;
}
.image-container {
            width: 100%;    /* Full width of the container */
            height: 300px;  /* Fixed height for the image */
            border: 1px solid #ccc;
        }
        img.stretched {
            width: 100%;    /* Stretch the image to fill the container's width */
            height: 100%;   /* Stretch the image to fill the container's height */
            
        }
.card__data {
  width: 280px;
  background-color: var(--container-color);
  padding: 1.5rem 2rem;
  box-shadow: 0 8px 24px hsla(0, 0%, 0%, .15);
  border-radius: 1rem;
  position: absolute;
  bottom: -9rem;
  left: 0;
  right: 0;
  margin-inline: auto;
  opacity: 0;
  transition: opacity 1s 1s;
}

.card__description {
  display: block;
  font-size: var(--small-font-size);
  margin-bottom: .25rem;
}

.card__title {
  font-size: var(--h2-font-size);
  font-weight: 500;
  color: var(--title-color);
  margin-bottom: .75rem;
}

.card__button {
  text-decoration: none;
  font-size: var(--small-font-size);
  font-weight: 500;
  color: var(--first-color);
}

.card__button:hover {
  text-decoration: underline;
}

/* Naming animations in hover */
.card__article:hover .card__data {
  animation: show-data 1s forwards;
  opacity: 1;
  transition: opacity .3s;
}

.card__article:hover {
  animation: remove-overflow 2s forwards;
}

.card__article:not(:hover) {
  animation: show-overflow 2s forwards;
}

.card__article:not(:hover) .card__data {
  animation: remove-data 1s forwards;
}

/* Card animation */
@keyframes show-data {
  50% {
    transform: translateY(-10rem);
  }
  100% {
    transform: translateY(-7rem);
  }
}

@keyframes remove-overflow {
  to {
    overflow: initial;
  }
}

@keyframes remove-data {
  0% {
    transform: translateY(-7rem);
  }
  50% {
    transform: translateY(-10rem);
  }
  100% {
    transform: translateY(.5rem);
  }
}

@keyframes show-overflow {
  0% {
    overflow: initial;
    pointer-events: none;
  }
  50% {
    overflow: hidden;
  }
}

/*=============== BREAKPOINTS ===============*/
/* For small devices */
@media screen and (max-width: 340px) {
  .container {
    margin-inline: 1rem;
  }

  .card__data {
    width: 250px;
    padding: 1rem;
  }
}

/* For medium devices */
@media screen and (min-width: 768px) {
  .card__container {
    grid-template-columns: repeat(2, 1fr);
    column-gap: 1.5rem;
  }
}

/* For large devices */
@media screen and (min-width: 1120px) {
  .container {
    height: 100vh;
  }

  .card__container {
    grid-template-columns: repeat(3, 1fr);
  }
  .card__img {
    width: 348px;
  }
  .card__data {
    width: 316px;
    padding-inline: 2.5rem;
  }
}
</style>
</div>  


</div> 
</div>
</div>
</div>
</div>
    </main>
    </div>
    </div>
      
    
    <!-- Include jQuery (once) -->
    <?php 
include('../user/inc/footer.php');
?> 
</body>
</html>