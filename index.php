<?php include("template/header.php");
include("funciones.php");
menuNormal();
?>

<!-- Carousel -->

<section id="Carousel">
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/3.png" class="img-fluid" alt="...">
            </div>

            <div class="carousel-item">
                <img src="img/1.png" class="img-fluid" alt="...">

            </div>
            <div class="carousel-item">
                <img src="img/2.png" class="img-fluid" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>













<section id="reviews" class="bg-light my-5">
    <div class="container-lg">
        <div class="text-center">
            <h2><i class="bi bi-stars"></i>Reviews</h2>
            <p class="lead">En esta seccion colocamos las reviews de diferentes clientes que nos han dado el honor de probar nuestros servicios.</p>
        </div>

        <div class="row justify-content-center my-5">
            <div class="col-lg-8">
                <div class="list-group">
                    <div class="list-group-item py-3">
                        <div class="pb-2">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <h5 class="mb-1">
                            <p> Me ayudo a bajar de peso.</p>
                        </h5>
                        <p class="mb-1">Gracias a la dieta, ejercicio y masajes reductivos puedo tener el cuerpo que hoy tengo, un servicio muy recomendado.</p>
                        <small>Review by: Maria Villanueva.</small>
                    </div>
                    <!--  -->
                    <div class="list-group-item py-3">
                        <div class="pb-2">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <h5 class="mb-1">
                            Reduje mi estres con estos masajes.
                        </h5>
                        <p class="mb-1">Antes tenia que acudir a remedios medicados para dormir, pero ahora puedo descansar de mejor manera, muchas gracias</p>
                        <small>Review by: Samara Castillo.</small>
                    </div>
                    <!--  -->
                    <div class="list-group-item py-3">
                        <div class="pb-2">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <h5 class="mb-1">
                            Nos ayudo mucho, gran terapeuta.
                        </h5>
                        <p class="mb-1">Con sus cursos de masaje pude conseguir un buen trabajo en un spa.</p>
                        <small>Review by: Sarahi Esquivel.</small>
                    </div>
                    <!--  -->
                </div>
            </div>
        </div>

    </div>
</section>





<?php include("template/footer.php")
?>