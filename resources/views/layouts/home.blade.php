<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NUTSTREE</title>
    <link rel="shortcut icon" href="{{ asset('storage/layouts/logo.jpeg') }}" type="image/x-icon">
    <meta name="keywords" content="tailwind,tailwindcss,tailwind css,css,starter template,free template,store template, shop layout, minimal, monochrome, minimalistic, theme, nordic">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">

    <style>
        .work-sans {
            font-family: 'Work Sans', sans-serif;
        }

        #menu-toggle:checked + #menu {
            display: block;
        }

        .hover\:grow {
            transition: all 0.3s;
            transform: scale(1);
        }

        .hover\:grow:hover {
            transform: scale(1.02);
        }

        .carousel-open:checked + .carousel-item {
            position: static;
            opacity: 100;
        }

        .carousel-item {
            -webkit-transition: opacity 0.6s ease-out;
            transition: opacity 0.6s ease-out;
        }

        #carousel-1:checked ~ .control-1,
        #carousel-2:checked ~ .control-2,
        #carousel-3:checked ~ .control-3 {
            display: block;
        }

        .carousel-indicators {
            list-style: none;
            margin: 0;
            padding: 0;
            position: absolute;
            bottom: 2%;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 10;
        }

        #carousel-1:checked ~ .control-1 ~ .carousel-indicators li:nth-child(1) .carousel-bullet,
        #carousel-2:checked ~ .control-2 ~ .carousel-indicators li:nth-child(2) .carousel-bullet,
        #carousel-3:checked ~ .control-3 ~ .carousel-indicators li:nth-child(3) .carousel-bullet {
            color: #000;
        }
    </style>

</head>

<body class="bg-white text-gray-600 work-sans leading-normal text-base tracking-normal">

    <!--Nav-->
     @include('layouts.nav')

    <main class="my-8">
        <div class="container mx-auto px-6">
            <div id="image-slider" class="h-64 rounded-md overflow-hidden bg-cover bg-center transition-all duration-700" style="background-image: url('https://ortan-nature.com/wp-content/uploads/2024/02/fruits-secs-.jpeg')">
                <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
                    <div class="px-10 max-w-xl">
                        <h2 class="text-2xl text-white font-semibold">Offres spéciales</h2>
                        <p class="mt-2 text-gray-200">
                            Profitez de nos offres exclusives pour découvrir nos produits à prix réduits !
                            Abonnez-vous à notre newsletter pour être informé de nos promotions et de nos nouveautés.
                        </p>
                        <button class="flex items-center mt-4 px-3 py-2 bg-yellow-400 text-black text-sm uppercase font-medium rounded hover:bg-yellow-500 focus:outline-none focus:bg-yellow-500">
                            <span>Shop Now</span>
                            <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <script>
                // Liste des images à afficher
                const images = [
                    'https://ortan-nature.com/wp-content/uploads/2024/02/fruits-secs-.jpeg',
                    'https://www.shutterstock.com/image-photo/dried-fruit-that-has-had-260nw-2489832773.jpg',
                    'https://media.istockphoto.com/id/639201332/fr/photo/composition-avec-un-assortiment-de-noix-et-de-fruits-secs.jpg?s=612x612&w=0&k=20&c=V3yJly3jsN-NlTaCMzIs0DAc7iwZf9RiCjUom3Tn_hs=',
                    'https://img-3.journaldesfemmes.fr/klQXxQDCaHGIjU2rDYHs2Y7sR_w=/1500x/smart/1be07b6379f941f484764e5f4693a067/ccmcms-jdf/16962606.jpg'
                ];

                const slider = document.getElementById('image-slider');

                function changeBackgroundImage() {
                    // Sélectionner une image aléatoire
                    const randomImage = images[Math.floor(Math.random() * images.length)];
                    // Mettre à jour l'image de fond
                    slider.style.backgroundImage = `url('${randomImage}')`;
                }
                // Changer l'image toutes les 5 secondes
                setInterval(changeBackgroundImage, 2000);
            </script>


            <!-- Section supplémentaires -->
            {{-- <div class="md:flex mt-8 md:-mx-4">
                <div class="w-full h-64 md:mx-4 rounded-md overflow-hidden bg-cover bg-center md:w-1/2" style="background-image: url('https://media.istockphoto.com/id/183803376/fr/photo/assortiment-de-noix-et-fruits-s%C3%A9ch%C3%A9s.jpg?s=612x612&w=0&k=20&c=IgSdHQcfe263cEGuDNgsvY0RLT0JuXas2G-5ZlM6TaE=')">
                    <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
                        <div class="px-10 max-w-xl">
                            <h2 class="text-2xl text-white font-semibold">Nos Fruits Secs</h2>
                            <p class="mt-2 text-gray-400">Découvrez une large sélection de fruits secs de qualité supérieure pour agrémenter vos recettes ou pour une collation saine et savoureuse.</p>
                            <button class="flex items-center mt-4 text-white text-sm uppercase font-medium rounded hover:underline focus:outline-none">
                                <span>Shop Now</span>
                                <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </button>
                        </div>
                    </div>
                </div> --}}

                {{-- <div class="w-full h-64 mt-8 md:mx-4 rounded-md overflow-hidden bg-cover bg-center md:mt-0 md:w-1/2" style="background-image: url('')">
                    <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
                        <div class="px-10 max-w-xl">
                            <h2 class="text-2xl text-white font-semibold">Avantages exclusifs</h2>
                            <p class="mt-2 text-gray-400">
                                Ne manquez pas l'occasion de découvrir nos produits délicieux.
                                Parcourez notre boutique en ligne dès maintenant et commencez à remplir votre panier !
                            </p>
                            <button class="flex items-center mt-4 text-white text-sm uppercase font-medium rounded hover:underline focus:outline-none">
                                <span>Join Now</span>
                                <svg class="h-5 w-5 mx-2" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                            </button>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </main>


    <section class="bg-white py-8">
        <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
            <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
                    <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl" href="#">
                        Nutstree Store
                    </a>
                    <div class="flex items-center" id="store-nav-content">
                        <a class="pl-3 inline-block no-underline hover:text-black" href="#">
                            <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M7 11H17V13H7zM4 7H20V9H4zM10 15H14V17H10z" />
                            </svg>
                        </a>
                        <a class="pl-3 inline-block no-underline hover:text-black" href="#">
                            <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M10,18c1.846,0,3.543-0.635,4.897-1.688l4.396,4.396l1.414-1.414l-4.396-4.396C17.365,13.543,18,11.846,18,10 c0-4.411-3.589-8-8-8s-8,3.589-8,8S5.589,18,10,18z M10,4c3.309,0,6,2.691,6,6s-2.691,6-6,6s-6-2.691-6-6S6.691,4,10,4z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </nav>

            <!-- Product Cards Section -->
            <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                <a href="#">
                    <img class="hover:grow hover:shadow-lg rounded-md" src="https://ortan-nature.com/wp-content/uploads/2024/02/fruits-secs-.jpeg" alt="Dried Fruits Mix" />
                    <div class="pt-3 flex items-center justify-between">
                        <p class="text-gray-900 font-semibold">Dried Fruits Mix</p>
                    </div>
                    <p class="pt-1 text-gray-900 font-semibold">2.99dhs</p>
                </a>
            </div>

            <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                <a href="#">
                    <img class="hover:grow hover:shadow-lg rounded-md" src="https://media.istockphoto.com/id/183803376/fr/photo/assortiment-de-noix-et-fruits-s%C3%A9ch%C3%A9s.jpg?s=612x612&w=0&k=20&c=IgSdHQcfe263cEGuDNgsvY0RLT0JuXas2G-5ZlM6TaE=" alt="Assortment of Dried Nuts and Fruits" />
                    <div class="pt-3 flex items-center justify-between">
                        <p class="text-gray-900 font-semibold">Assortment of Dried Nuts</p>
                    </div>
                    <p class="pt-1 text-gray-900 font-semibold">14.50dhs</p>
                </a>
            </div>

            <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                <a href="#">
                    <img class="hover:grow hover:shadow-lg rounded-md" src="https://www.aussiecandlesupplies.com.au/cdn/shop/files/chocolatefragrance_1200x.jpg?v=1706592291" alt="Premium Dried Mango" />
                    <div class="pt-3 flex items-center justify-between">
                        <p class="text-gray-900 font-semibold">Premium Dried Mango</p>
                    </div>
                    <p class="pt-1 text-gray-900 font-semibold">10.99dhs</p>
                </a>
            </div>

            <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                <a href="#">
                    <img class="hover:grow hover:shadow-lg rounded-md" src="https://www.aussiecandlesupplies.com.au/cdn/shop/files/chocolatefragrance_1200x.jpg?v=1706592291" />
                    <div class="pt-3 flex items-center justify-between">
                        <p class="text-gray-900 font-semibold">Dried Apple Rings</p>
                    </div>
                    <p class="pt-1 text-gray-900 font-semibold">8.99dhs</p>
                </a>
            </div>

        </div>
    </section>
     </div>

  <!-- End Card Blog -->
  <section class="relative h-[515px] overflow-hidden lg:block hidden">
    <div class="container-fluid">
      <div class="flex flex-wrap lg:flex-nowrap">
        <!-- Image -->
        <div class="lg:w-1/2 w-full pr-0">
          <div class="image">
            <img src="https://www.shutterstock.com/image-photo/mix-various-nuts-raisins-white-600nw-2454025339.jpg" alt="#" class="w-full h-full object-cover">
          </div>
        </div>

        <!-- Contenu -->
        <div class="lg:w-1/2 w-full pl-0">
          <div class="content text-center bg-[#FDFBEF] h-full relative">
            <div class="absolute left-0 top-1/2 transform -translate-y-1/2 px-6 py-12">
              <p class="text-sm text-gray-500 uppercase font-semibold mb-2">Deal of day</p>
              <h3 class="text-xl font-semibold capitalize mb-5">Beautiful dress for women</h3>
              <p class="text-base text-gray-600 mb-5">Suspendisse massa leo, vestibulum cursus nulla sit amet, frungilla placerat lorem. Cars fermentum, sapien.</p>
              <h1 class="text-3xl font-bold text-[#F7941D] mt-8">$1200 <s class="text-xl font-medium text-gray-600">$1890</s></h1>
              <div class="coming-time mt-8">
                <!-- Compte à rebours -->
                <div id="countdown" class="text-3xl font-semibold text-gray-800"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Inclure jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Inclure Countdown.js -->
  <script src="https://cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>

  <script>
    $(document).ready(function() {
      // Date d'expiration définie manuellement (exemple: 31 décembre 2024)
      var promoEndDate = "2024/12/31 23:59:59";  // Assurez-vous que la date est correcte

      // Initialisation du compte à rebours
      $('#countdown').countdown(promoEndDate, function(event) {
        $(this).html(event.strftime('%D jours %H:%M:%S'));
      });
    });
  </script>

<!-- Section Best Sellers -->
<section class="bg-gray-100 py-16">
    <div class="container mx-auto text-center pb-8">
        <h2 class="text-3xl font-semibold text-gray-800">Best Sellers</h2>
        <p class="mt-2 text-lg text-gray-600">Découvrez nos produits les plus populaires!</p>
    </div>

    <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
        <!-- Produit 1 -->
        <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
            <a href="#">
                <img class="hover:grow hover:shadow-lg rounded-md" src="https://ortan-nature.com/wp-content/uploads/2024/02/fruits-secs-.jpeg" alt="Dried Fruits Mix" />
                <div class="pt-3 flex items-center justify-between">
                    <p class="text-gray-900 font-semibold">Dried Fruits Mix</p>
                </div>
                <p class="pt-1 text-gray-900 font-semibold">2.99dhs</p>
            </a>
            <!-- Bouton Shop Now -->
            <a href="#" class="mt-4 inline-block bg-green-600 text-white py-2 px-6 rounded-md text-center hover:bg-green-700 transition duration-300">
                Shop Now
            </a>
        </div>

        <!-- Produit 2 -->
        <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
            <a href="#">
                <img class="hover:grow hover:shadow-lg rounded-md" src="https://media.istockphoto.com/id/183803376/fr/photo/assortiment-de-noix-et-fruits-s%C3%A9ch%C3%A9s.jpg?s=612x612&w=0&k=20&c=IgSdHQcfe263cEGuDNgsvY0RLT0JuXas2G-5ZlM6TaE=" alt="Assortment of Dried Nuts" />
                <div class="pt-3 flex items-center justify-between">
                    <p class="text-gray-900 font-semibold">Assortment of Dried Nuts</p>
                </div>
                <p class="pt-1 text-gray-900 font-semibold">14.50dhs</p>
            </a>
            <!-- Bouton Shop Now -->
            <a href="#" class="mt-4 inline-block bg-green-600 text-white py-2 px-6 rounded-md text-center hover:bg-green-700 transition duration-300">
                Shop Now
            </a>
        </div>

        <!-- Produit 3 -->
        <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
            <a href="#">
                <img class="hover:grow hover:shadow-lg rounded-md" src="https://www.aussiecandlesupplies.com.au/cdn/shop/files/chocolatefragrance_1200x.jpg?v=1706592291" alt="Premium Dried Mango" />
                <div class="pt-3 flex items-center justify-between">
                    <p class="text-gray-900 font-semibold">Premium Dried Mango</p>
                </div>
                <p class="pt-1 text-gray-900 font-semibold">10.99dhs</p>
            </a>
            <!-- Bouton Shop Now -->
            <a href="#" class="mt-4 inline-block bg-green-600 text-white py-2 px-6 rounded-md text-center hover:bg-green-700 transition duration-300">
                Shop Now
            </a>
        </div>

        <!-- Produit 4 -->
        <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
            <a href="#">
                <img class="hover:grow hover:shadow-lg rounded-md" src="https://www.aussiecandlesupplies.com.au/cdn/shop/files/chocolatefragrance_1200x.jpg?v=1706592291" />
                <div class="pt-3 flex items-center justify-between">
                    <p class="text-gray-900 font-semibold">Dried Apple Rings</p>
                </div>
                <p class="pt-1 text-gray-900 font-semibold">8.99dhs</p>
            </a>
            <!-- Bouton Shop Now -->
            <a href="#" class="mt-4 inline-block bg-green-600 text-white py-2 px-6 rounded-md text-center hover:bg-green-700 transition duration-300">
                Shop Now
            </a>
        </div>

        <!-- Ajoutez d'autres produits populaires ici en dupliquant les sections ci-dessus -->

    </div>
</section>



   @include('layouts.footer') ;

</body>


</html>
