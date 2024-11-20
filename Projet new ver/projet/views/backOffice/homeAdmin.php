<?php
require_once(__DIR__ . '/../../config/config.php'); 
require_once(__DIR__ . '/../../controllers/UserController.php');

// Démarrer la session si elle n'est pas active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
/*
if (!isset($_SESSION['username'])) {
    header("Location: index.php"); 
    exit();
}
*/
?>
<!DOCTYPE html>
<html>
<head>
    <title> ADMIN </title>
    <link href="../frontOffice/public/home.css" rel="stylesheet">
    <style>
      .section { display: none; }
      .section.active { display: block; }
    </style>
</head>
<body>
    <header>
        <h1>Welcome yasmine</h1>
    </header>
    
    <nav>
        <ul>
            <li><a href="#cours" onclick="showSection('Cours')">Cours</a></li>
            <li><a href="#test" onclick="showSection('TEST')">Test</a></li>
            <li><a href="#Stage" onclick="showSection('Stage')">Stage</a></li>
            <li><a href="#dashboard" onclick="showSection('Dashboard')">Dashboard</a></li>
            <li><a href="../frontOffice/index.html">HOME</a></li>
        </ul>
    </nav>

    <main>







         <!--*******************************************-->    
         <section id="Cours">
    <h2>COURS</h2>
    <button onclick="toggleForm()">Ouvrir formulaire</button>

    <div id="formContainer">
        <form onsubmit="return validateForm()" method="POST">
            <h2>++Ajout de cours++</h2>
            <label for="titre">Titre :</label>
            <input type="text" id="titre" name="titre">
            <br>
            <p id="errorMessage" style="color: red;"></p>
            <label for="description">Description :</label>
            <input type="text" id="description" name="description">
            <br>
            <p id="errorMessage2" style="color: red;"></p>
            <button type="submit">Envoyer</button>
        </form>
    </div>

    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th colspan="2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../../models/cours.php';
            include '../../controllers/CoursController.php';

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $titre = $_POST['titre'];
                $description = $_POST['description'];

                // Créer un objet cours avec les données du formulaire
                $cours1 = new Cours($titre, $description);

                // Ajouter le cours en utilisant le contrôleur
                $v1 = new CoursController();
                $v1->addCours($cours1);
            }

            // Récupérer la liste des cours
            $c1 = new CoursController();
            $list = $c1->listCours();

            // Parcourir la liste des cours et les afficher
            if (!empty($list)) {
                foreach ($list as $user) {
            ?>
                    <tr>
                        <td><?= $user['ID']; ?></td>
                        <td><?= htmlspecialchars($user['titre']); ?></td>
                        <td><?= htmlspecialchars($user['description']); ?></td>
                        <td align="center">
                            <form method="GET" action="updateCours.php">
                                <input type="hidden" value="<?= $user['ID']; ?>" name="id">
                                <button class="btn-update" type="submit">Modifier</button>
                            </form>
                        </td>
                        <td>
                        <a class="btn-delete"href="DeleteCours.php?ID=<?= $user['ID']; ?>">Supprimer</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
            ?>
                <tr>
                    <td colspan="5">Aucun cours disponible pour le moment.</td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

    <script>
        function toggleForm() {
            const formContainer = document.getElementById('formContainer');
            if (formContainer.style.display === 'none') {
                formContainer.style.display = 'block';
            } else {
                formContainer.style.display = 'none';
            }
        }

        function validateForm() {
            const titre = document.getElementById('titre').value.trim();
            const description = document.getElementById('description').value.trim();
            const errorMessage = document.getElementById('errorMessage');
            const errorMessage2 = document.getElementById('errorMessage2');

            // Effacer les messages d'erreur précédents
            errorMessage.textContent = '';
            errorMessage2.textContent = '';

            if (titre === '' && description === '') {
                errorMessage.textContent = 'Veuillez entrer votre titre de cours.';
                errorMessage2.textContent = 'Veuillez entrer votre description.';
                return false;
            }

            if (titre === '') {
                errorMessage.textContent = 'Veuillez entrer votre titre de cours.';
                return false;
            }

            if (description === '') {
                errorMessage2.textContent = 'Veuillez entrer votre description.';
                return false;
            }

            return true;
        }
    </script>
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


