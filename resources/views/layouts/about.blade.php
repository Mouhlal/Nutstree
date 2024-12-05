<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos de Nutstree</title>
    @vite('resources/css/app.css')
    <link rel="shortcut icon" href="{{ asset('storage/layouts/logo.jpeg') }}" type="image/x-icon">
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    @include('layouts.nav')

    <!-- Contenu principal -->
    <main class="container mx-auto py-12 px-4 lg:px-8">
        <div class="bg-white p-8 shadow-lg rounded-lg mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">À propos de Nutstree</h1>
            <p class="text-lg text-gray-600 mb-4">Nutstree est une entreprise passionnée par la vente de fruits secs de haute qualité, offrant à ses clients une expérience de shopping exceptionnelle en ligne. Nous nous efforçons de vous fournir les meilleurs produits pour enrichir votre alimentation tout en respectant des standards de qualité élevés.</p>
            <p class="text-lg text-gray-600 mb-4">Notre mission est de rendre accessibles des produits nutritifs et sains, issus de sources durables et responsables. Nutstree s'engage à offrir une large sélection de fruits secs, allant des classiques aux plus rares, dans le but de satisfaire tous les goûts et besoins nutritionnels.</p>
            <p class="text-lg text-gray-600 mb-4">Nous croyons en un mode de vie sain et actif, et c’est pourquoi nous mettons un point d'honneur à vous offrir des produits qui contribuent à votre bien-être au quotidien. Que vous soyez à la recherche d'une collation énergétique ou d'un ingrédient pour vos recettes, Nutstree est là pour vous accompagner.</p>
        </div>

        <div class="bg-white p-8 shadow-lg rounded-lg mb-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Détails du Site</h2>
            <p class="text-lg text-gray-600 mb-4">Nutstree a été conçu pour offrir une expérience d'achat simple et agréable. Grâce à notre site, vous pouvez parcourir facilement notre catalogue de produits, ajouter vos articles au panier, passer votre commande, et consulter les avis de nos clients.</p>

            <h3 class="text-xl font-semibold text-gray-700 mb-2">Fonctionnalités principales :</h3>
            <ul class="list-disc list-inside text-gray-600 mb-4">
                <li><strong>Catalogue complet : </strong> Explorez une large gamme de fruits secs disponibles à l'achat.</li>
                <li><strong>Facilité d'achat : </strong> Ajoutez des produits à votre panier en toute simplicité et procédez à un paiement sécurisé.</li>
                <li><strong>Suivi des commandes : </strong> Suivez l’état de vos commandes en temps réel directement depuis votre compte.</li>
                <li><strong>Interactivité : </strong> Laissez des avis sur les produits pour aider d’autres clients à faire leur choix.</li>
                <li><strong>Design responsive : </strong> Une interface fluide et agréable, aussi bien sur ordinateur que sur mobile.</li>
            </ul>

            <h3 class="text-xl font-semibold text-gray-700 mb-2">Engagement de qualité :</h3>
            <p class="text-lg text-gray-600 mb-4">Nutstree veille à la qualité de ses produits en collaborant uniquement avec des fournisseurs respectant des standards stricts. Nous privilégions des méthodes de culture durables et respectueuses de l'environnement pour garantir que chaque produit que vous consommez est aussi bon pour votre santé que pour la planète.</p>
            <p class="text-lg text-gray-600 mb-4">Nous sommes fiers de proposer des fruits secs cultivés avec soin, de manière éthique et responsable, tout en offrant une traçabilité totale sur la provenance de chaque produit.</p>

            <h3 class="text-xl font-semibold text-gray-700 mb-2">Pourquoi Nutstree ?</h3>
            <p class="text-lg text-gray-600 mb-4">Notre objectif est simple : rendre accessible une alimentation saine, délicieuse et pleine d'énergie à tous nos clients. Nous croyons que des choix alimentaires judicieux peuvent avoir un impact significatif sur la qualité de vie. Grâce à Nutstree, nous espérons vous aider à adopter un mode de vie plus sain, tout en vous régalant avec des produits de qualité exceptionnelle.</p>
        </div>

        <!-- Contact -->
        <div class="bg-white p-8 shadow-lg rounded-lg">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Contactez-nous</h2>
            <p class="text-lg text-gray-600 mb-4">Pour toute question, suggestion, ou besoin d'informations supplémentaires, n'hésitez pas à nous contacter :</p>
            <p class="text-lg text-gray-600 mb-2">Email : <a href="mailto:contact@nutstree.com" class="text-blue-600">contact@nutstree.com</a></p>
            <p class="text-lg text-gray-600 mb-2">Téléphone : +212 5XX-XXX-XXX</p>
            <p class="text-lg text-gray-600">Adresse : 123 Rue des Fruits Secs, Casablanca, Maroc</p>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-4 mt-auto">
        @include('layouts.footer')
    </footer>

</body>
</html>
