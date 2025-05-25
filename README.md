# 🌰 Nutstree - E-commerce de Fruits Secs  

**Nutstree** est une plateforme e-commerce permettant aux clients d'acheter des fruits secs en ligne avec une expérience fluide et sécurisée. Le site propose une interface moderne, une gestion avancée des commandes et un système de paiement en ligne via **CMI**.  

📍 **Site en ligne :** [nutstree.ma](https://nutstree.ma)  

---

## ✨ Fonctionnalités principales  

✔️ **Affichage des produits avec titre, prix et image** 🛍️  
✔️ **Ajout des produits au panier** 🛒  
✔️ **Gestion des commandes pour les clients** 📦  
✔️ **Système de paiement sécurisé via CMI** 💳  
✔️ **Authentification et gestion des utilisateurs** 🔐  
✔️ **Administration des produits et commandes** ⚙️  
✔️ **Interface moderne et responsive avec Tailwind CSS** 🎨  
✔️ **Envoi automatique d'un code promo par email après inscription** 📧 🎁  

---

## 🚀 Technologies utilisées  

- **Laravel** (Framework PHP)  
- **MySQL** (Base de données)  
- **Tailwind CSS** (Design moderne)  
- **Vite.js** (Optimisation du front-end)  
- **Livewire** (Dynamisme des interfaces)  
- **CMI** (Intégration de paiement en ligne)  
- **Mailtrap / SMTP** (Envoi d'emails aux clients)  

---

## 📂 Structure du projet  

```
📦 Nutstree  
 ┣ 📂 app/Http/Controllers    # Contrôleurs Laravel  
 ┣ 📂 database/migrations     # Migrations de la base de données  
 ┣ 📂 resources/views         # Templates Blade  
 ┣ 📂 routes/web.php          # Définition des routes  
 ┣ 📂 public/images           # Images des produits  
 ┣ 📜 .env                    # Configuration de l'application  
 ┗ 📜 README.md               # Documentation  
```  

---

## ⚙️ Installation et exécution  

### 🛠️ 1. Cloner le projet  
```bash
git clone https://github.com/Mouhlal/nutstree.git
cd ecom
```  

### 🛠️ 2. Installer les dépendances  
```bash
composer install
npm install
```  

### 🛠️ 3. Configurer l’environnement  
- Copier le fichier `.env.example` en `.env`  
- Modifier les informations de connexion à la base de données dans `.env` :  
  ```ini
  DB_DATABASE=nutstree
  DB_USERNAME=root
  DB_PASSWORD=
  ```  
- Configurer l'envoi d'emails dans `.env` (exemple avec **Mailtrap**) :  
  ```ini
  MAIL_MAILER=smtp
  MAIL_HOST=smtp.mailtrap.io
  MAIL_PORT=2525
  MAIL_USERNAME=your_mailtrap_username
  MAIL_PASSWORD=your_mailtrap_password
  MAIL_ENCRYPTION=tls
  MAIL_FROM_ADDRESS=noreply@nutstree.ma
  MAIL_FROM_NAME="Nutstree"
  ```  
- Générer la clé d’application :  
  ```bash
  php artisan key:generate
  ```  

### 🛠️ 4. Exécuter les migrations et seeders  
```bash
php artisan migrate --seed
```  

### 🛠️ 5. Compiler les assets  
```bash
npm run build
```  

### 🛠️ 6. Lancer le serveur  
```bash
php artisan serve
```
### 🛠️ 6. Interface  
![Page de connexion](https://nutstree.ma/login)

```  
L'application sera accessible sur **http://127.0.0.1:8000** 🚀  
