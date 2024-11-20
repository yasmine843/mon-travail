<?php
require_once(__DIR__ . '/../../config/config.php'); 
require_once(__DIR__ . '/../../controllers/CoursController.php');
// Démarrer la session si elle n'est pas active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Inclure les fichiers nécessaires
include_once('../../models/cours.php'); // Assurez-vous que la classe Cours est incluse ici

// Initialiser la variable $cours
$cours = null;

// Vérifier si l'ID du cours est passé dans l'URL
if (isset($_GET['id'])) {
    $coursId = $_GET['id'];
    
    // Créer un objet du contrôleur CoursController
    $coursController = new CoursController();
    
    // Récupérer les détails du cours à partir de l'ID
    $cours = $coursController->getCoursById($coursId);
}

// Vérifier si le cours a été trouvé
if ($cours === null) {
    echo "Le cours demandé n'existe pas.";
    exit();
}

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['titre'], $_POST['description'])) {
    // Récupérer les données du formulaire
    $titre = $_POST['titre']; // Correspond à 'titre' dans le formulaire
    $description = $_POST['description']; // Correspond à 'description' dans le formulaire

    // Créer un objet Cours (assurez-vous que cette classe est définie dans cours.php)
    $cours = new Cours($titre, $description); // Constructeur qui prend en paramètre les données

    // Mettre à jour le cours
    $coursController->updateCours($cours, $coursId); // Passer l'objet et l'ID

    // Rediriger vers la page du tableau des cours après la mise à jour
    header('Location: homeAdmin.php');
    exit();
}
?>
<!--************************************************-->
<!DOCTYPE html>
<html>
<head>
    <title>ADMIN</title>
    <link href="../frontOffice/public/home.css" rel="stylesheet">
    <style>
        .section { display: none; }
        .section.active { display: block; }
    </style>
</head>
<body>
    <header>
        <h1>Bienvenue Yasmine</h1>
    </header>
    
    <nav>
        <ul>
            <li><a href="#cours" onclick="showSection('Cours')">Cours</a></li>
            <li><a href="#test" onclick="showSection('TEST')">Test</a></li>
            <li><a href="#Stage" onclick="showSection('Stage')">Stage</a></li>
            <li><a href="#dashboard" onclick="showSection('Dashboard')">Dashboard</a></li>
            <li><a href="../frontOffice/index.html">Accueil</a></li>
        </ul>
    </nav>

    <main>
        <!--*******************************************-->    
        <section id="Cours">
            <div class="content">
                <div id="profile-content" class="section-content">
                    <h2 class="section-title">Modifier le cours</h2>
                    
                    <!-- Formulaire de mise à jour -->
                    <form method="POST" >
                        <input type="hidden" name="id" value="<?= htmlspecialchars($cours['ID']); ?>">

                        <label for="titre">Titre :</label>
                        <input type="text" id="titre" name="titre" value="<?= htmlspecialchars($cours['titre']); ?>" required>

                        <label for="description">Description :</label>
                        <input type="text" id="description" name="description" value="<?= htmlspecialchars($cours['description']); ?>" required>

                        <button type="submit" class="btn-update">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </section>

        <!--**********************************************************-->
        <section id="Stage" class="section">
            <h2>STAGE</h2>
            <div class="stage-item"></div>
        </section>

        <section id="TEST" class="section">
            <h2>TEST</h2>
            <div class="TEST-item"></div>
        </section>

        <!-- Nouvelle section Dashboard -->
        <section id="Dashboard" class="section">
            <h2>Dashboard</h2>
            <p>Bienvenue sur le tableau de bord. Vous pouvez ici visualiser diverses statistiques et informations importantes.</p>
            <div>
                <h3>Statistiques</h3>
                <p>Exemple de statistiques sur les cours, utilisateurs ou autres données pertinentes à votre application.</p>
            </div>
            <div>
                <h3>Graphiques</h3>
                <p>Vous pouvez ici afficher des graphiques ou des données visuelles pour mieux comprendre les tendances et l'évolution des données.</p>
            </div>
        </section>
    </main>
 
    <script>
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.section');
            sections.forEach(section => {
                section.classList.toggle('active', section.id === sectionId);
            });
        }
    </script>
</body>
</html>
