
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .content-header {
            background-color: #46A5BD;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            display: grid;
        }

        .breadcrumb {
            background-color: transparent;
            margin-top: 5px;
            font-size: 16px;
            font-weight: 500;
        }

        #carouselExampleIndicators {
            width: 100%;
            max-height: 1000px; /* Puedes ajustar esta altura según tus necesidades */
            overflow: hidden;
        }

        .carousel-inner img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .carousel-info {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .centrado {
            text-align: center;
            margin-top: 20px;
            font-size: 32px;
            color: #fff;
        }

        .contenedor-centro {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 65vh;
        }

        .dashboard-item {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .dashboard-item h4 {
            color: #3e4095;
            font-size: 24px;
        }

        .dashboard-item p {
            color: #777;
            font-size: 16px;
        }

        .dashboard-images {
            display: flex;
            justify-content: space-around;
            margin-top: 40px;
            position: relative;
        }

        .dashboard-images img {
            max-width: 200px;
            height: auto;
            border-radius: 8px;
            margin: 10px;
            transition: transform 0.3s ease-in-out;
        }

        .dashboard-images img:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 text-center"> <h1>Bienvenidos al Sistema Cambio Climatico</h1>
                <h1 class="m-0"></h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#" style="color: #1F09F7 ;">Inicio</a></li>
                    <li class="breadcrumb-item active"></li>
                </ol>
            </div>
        </div>
    </div>
</div>

    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/images/p5.jpg" class="d-block w-100" alt="Slide 1">
                <div class="carousel-info">
                    <h2>Cambio climático</h2>
                    <p>El cambio climático es el principal desafío para el futuro de la vida en el planeta tal y como la concebimos hoy.
                         Las emisiones de CO₂ han aumentado cerca de un 50 % desde 1990, contribuyendo así al aumento de temperatura mundial
                          y poniendo en riesgo el objetivo del Acuerdo de París de mantener el calentamiento global por debajo de 2 ºC.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/images/p2.jpg" class="d-block w-100" alt="Slide 2">
                <div class="carousel-info">
                    <h2>Cambio climático</h2>
                    <p>Los efectos del cambio climático incluyen:

                        Aumento de las temperaturas
                        Aumento de la frecuencia e intensidad de los fenómenos meteorológicos extremos, como las sequías, las inundaciones y los huracanes
                        Aumento del nivel del mar
                        Derretimiento de los glaciares
                        Pérdida de biodiversidad</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/images/p6.jpg" class="d-block w-100" alt="Slide 3">
                <div class="carousel-info">
                    <h2>Cambio climático</h2>
                    <p>La atmósfera terrestre está compuesta por diferentes gases que tienen como función mantener una temperatura
                         apropiada para la vida. A este fenómeno natural se le llama efecto invernadero.Es necesario que exista equilibrio
                          en la emisión de gases de efecto invernadero para conservar su justa proporción. Sin embargo, las actividades
                           humanas han aumentado la producción de estos gases provocando el llamado calentamiento global, la principal 
                           de las causas del cambio climático.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden"></span>
        </button>
    </div>

    <script>
        $(document).ready(function () {
            $.ajax({
                url: "ajax/dashboard .ajax.php",
                dataType: 'json',
                success: function (respuesta) {
                    console.log("respuesta", respuesta);
                }
            });
        })
    </script>
    <!-- Bootstrap JS -->



