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

    @vite('resources/css/app.css')

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
                    <img class="hover:grow hover:shadow-lg rounded-md" src="data:image/jpeg;base64,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" alt="Dried Apple Rings" />
                    <div class="pt-3 flex items-center justify-between">
                        <p class="text-gray-900 font-semibold">Dried Apple Rings</p>
                    </div>
                    <p class="pt-1 text-gray-900 font-semibold">8.99dhs</p>
                </a>
            </div>

        </div>
    </section>


    <section class="bg-white py-8">

       <!-- Card Blog -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Grid -->
    <div class="grid lg:grid-cols-2 lg:gap-y-16 gap-10">
      <!-- Card -->
      <a class="group rounded-xl overflow-hidden" href="{{route('prod.index')}}">
        <div class="sm:flex">
          <div class="flex-shrink-0 relative rounded-xl overflow-hidden w-full sm:w-56 h-44">
            <img class="group-hover:scale-105 transition-transform duration-500 ease-in-out size-full absolute top-0 start-0 object-cover rounded-xl" src="https://img-3.journaldesfemmes.fr/klQXxQDCaHGIjU2rDYHs2Y7sR_w=/1500x/smart/1be07b6379f941f484764e5f4693a067/ccmcms-jdf/16962606.jpg"alt="Image Description">
          </div>

          <div class="grow mt-4 sm:mt-0 sm:ms-6 px-4 sm:px-0">
            <h3 class="text-xl font-semibold text-gray-800 group-hover:text-gray-600 dark:text-neutral-600 dark:group-hover:text-red-600">
                Qualité
            </h3>
            <p class="mt-3 text-gray-600 dark:text-neutral-400">
                Nous nous engageons à offrir des produits de la plus haute qualité, fabriqués avec des matériaux durables et respectueux de l'environnement.            </p>
            <p class="mt-4 inline-flex items-center gap-x-1 text-blue-600 decoration-2 hover:underline font-medium">
              Read more
              <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </p>
          </div>
        </div>
      </a>
      <!-- End Card -->

      <!-- Card -->
      <a class="group rounded-xl overflow-hidden" href="{{route('layouts.about')}}">
        <div class="sm:flex">
          <div class="flex-shrink-0 relative rounded-xl overflow-hidden w-full sm:w-56 h-44">
            <img class="group-hover:scale-105 transition-transform duration-500 ease-in-out size-full absolute top-0 start-0 object-cover rounded-xl" src="https://bmmagazine.co.uk/wp-content/uploads/2020/03/AdobeStock_239743980-scaled-e1584008515740.jpeg" alt="Image Description">
          </div>

          <div class="grow mt-4 sm:mt-0 sm:ms-6 px-4 sm:px-0">
            <h3 class="text-xl font-semibold text-gray-800 group-hover:text-gray-600 dark:text-neutral-600 dark:group-hover:text-red-600">
                Engagement client
            </h3>
            <p class="mt-3 text-gray-600 dark:text-neutral-400">
                Nous mettons un point d'honneur à fournir un excellent service client. Votre satisfaction est notre priorité.            </p>
            <p class="mt-4 inline-flex items-center gap-x-1 text-blue-600 decoration-2 hover:underline font-medium">
              Read more
              <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </p>
          </div>
        </div>
      </a>
      <!-- End Card -->

      <!-- Card -->
      <a class="group rounded-xl overflow-hidden" href="{{route('layouts.about')}}">
        <div class="sm:flex">
          <div class="flex-shrink-0 relative rounded-xl overflow-hidden w-full sm:w-56 h-44">
            <img class="group-hover:scale-105 transition-transform duration-500 ease-in-out size-full absolute top-0 start-0 object-cover rounded-xl" src="https://www.shutterstock.com/image-photo/dried-fruit-that-has-had-260nw-2489832773.jpg" alt="Image Description">
          </div>

          <div class="grow mt-4 sm:mt-0 sm:ms-6 px-4 sm:px-0">
            <h3 class="text-xl font-semibold text-gray-800 group-hover:text-gray-600 dark:text-neutral-600 dark:group-hover:text-red-600">
                Innovation
            </h3>
            <p class="mt-3 text-gray-600 dark:text-neutral-400">
                Nous cherchons constamment à innover et à améliorer notre gamme de produits pour répondre aux besoins changeants de nos clients.            </p>
            <p class="mt-4 inline-flex items-center gap-x-1 text-blue-600 decoration-2 hover:underline font-medium">
              Read more
              <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </p>
          </div>
        </div>
      </a>
      <!-- End Card -->

      <!-- Card -->
      <a class="group rounded-xl overflow-hidden" href="{{route('layouts.contact')}}">
        <div class="sm:flex">
          <div class="flex-shrink-0 relative rounded-xl overflow-hidden w-full sm:w-56 h-44">
            <img class="group-hover:scale-105 transition-transform duration-500 ease-in-out size-full absolute top-0 start-0 object-cover rounded-xl" src="https://c7.alamy.com/comp/2K5B0G0/help!-clipart-text-illustration-vector-2K5B0G0.jpg" alt="Image Description">
          </div>

          <div class="grow mt-4 sm:mt-0 sm:ms-6 px-4 sm:px-0">
            <h3 class="text-xl font-semibold text-gray-800 group-hover:text-gray-600 dark:text-neutral-600 dark:group-hover:text-red-600">
                Besoin d'aide ?

            </h3>
            <p class="mt-3 text-gray-600 dark:text-neutral-400">
                Nous sommes là pour vous aider. Si vous avez des questions, des suggestions ou besoin d'assistance, n'hésitez pas à nous contacter.            </p>
            <p class="mt-4 inline-flex items-center gap-x-1 text-blue-600 decoration-2 hover:underline font-medium">
              Read more
              <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
            </p>
          </div>
        </div>
      </a>
      <!-- End Card -->
    </div>
    <!-- End Grid -->
  </div>
  <!-- End Card Blog -->

    </section>

   @include('layouts.footer') ;

</body>

</html>
