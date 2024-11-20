<?php
/*
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}*/
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WELCOME</title>

    <link href="../frontOffice/public/home.css" rel="stylesheet">
    <script src="../frontOffice/public/home.js"></script>
</head>
<body>

    <header>
        <h1>Welcome yasmine</h1>
    </header>

    <nav>
        <ul>
            <li><a href="#cours" onclick="showSection('Cours')">Cours</a></li>
            <li><a href="#test" onclick="showSection('test')">Test</a></li>
            <li><a href="#payement" onclick="showSection('payement')">Payement</a></li>
            <li><a href="#progress" onclick="showSection('progress')">Progress</a></li>
            <li><a href="#stage" onclick="showSection('stage')">Stage</a></li>
            <li><a href="../frontOffice/index.html">HOME</a></li>
        </ul>
    </nav>
    <main>






        <!--**************************************bloc yasmine**************************************-->



 <!--*************************************************************************-->   
 <section id="Cours" class="section" >
            
 <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                
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











        <section id="PAYEMENT" class="section">
            <h2>Payement</h2>

            <div class="courses-container">
                <div class="course-card">
                    <h3>JAVA</h3>
                    <img src="../public/JAVA.jpg" alt="Image du cours JAVA">
                    <div class="price">€20</div>
                    <button onclick="addToCart('JAVA', 20)">Acheter</button>
                </div>
                <div class="course-card">
                    <h3>HTML</h3>
                    <img src="../public/HTML.jpg" alt="Image du cours HTML">
                    
                    <div class="price">€20</div>
                    <button onclick="addToCart('HTML', 20)">Acheter</button>
                </div>
                <div class="course-card">
                    <h3>PHP</h3>
                    <img src="../public/php.jpeg" alt="Image du cours PHP">
                    
                    <div class="price">€20</div>
                    <button onclick="addToCart('PHP', 20)">Acheter</button>
                </div>
                <div class="course-card">
                    <h3>c</h3>
                    <img src="../public/c.png" alt="Image du cours c">
                    
                    <div class="price">€20</div>
                    <button onclick="addToCart('c', 20)">Acheter</button>
                </div>
                <div class="course-card">
                    <h3>C++</h3>
                    <img src="../public/C++.jpg" alt="Image du cours C++">
                    <div class="price">€20</div>
                    <button onclick="addToCart('C++', 20)">Acheter</button>
                </div>
            </div>

            <div id="cart-details" style="display: none;">
                <h3>Panier</h3>
                <ul id="cart-items"></ul>
                <p id="total-price">Prix Total: €0</p>
                
                <input type="text" id="card-number" placeholder="Votre Numéro de carte">
                
                <button onclick="validateCart()">Valider l'Achat</button>
                <button onclick="removeSelectedCourses()">Supprimer Cours </button>
                <button onclick="clearCart()">Vider le Panier</button>
            </div>
        </section>

    <!--**********************************************************************************************************-->





<!--***********************************************************-->
        <!-- Section Test -->
        <section id="test" class="section">
            <h2>TEST</h2>
            <div class="test-item">
                <h3>TEST MATH</h3>
                <p>Contenu du test de Mathématiques.</p>
            </div>
            <div class="test-item">
                <h3>TEST JAVA</h3>
                <p>Contenu du test de Java.</p>
            </div>
        </section>

        <!-- Section Payement -->
        <section id="payement" class="section">
            <h2>Payement</h2>
            <div class="courses-container">
                <div class="course-card">
                    <h3>JAVA</h3>
                    <img src="../frontOffice/public/JAVA.png" alt="Image du cours JAVA">
                    <div class="price">€100</div>
                    <button onclick="addToCart('JAVA', 100)">Acheter</button>
                </div>
                <div class="course-card">
                    <h3>HTML/PHP</h3>
                    <img src="../frontOffice/public/HTML.png" alt="Image du cours HTML/PHP">
                    <div class="price">€100</div>
                    <button onclick="addToCart('HTML/PHP', 100)">Acheter</button>
                </div>
                <div class="course-card">
                    <h3>C / C++</h3>
                    <img src="../frontOffice/public/C.png" alt="Image du cours C / C++">
                    <div class="price">€100</div>
                    <button onclick="addToCart('C / C++', 100)">Acheter</button>
                </div>
            </div>
            <div id="cart-details" style="display: none;">
                <h3>Panier</h3>
                <ul id="cart-items"></ul>
                <p id="total-price">Prix Total: €0</p>
                <input type="text" id="card-number" placeholder="Votre Numéro de carte">
                <button class="validate-btn" onclick="validateCart()">Valider l'Achat</button>
                <button class="remove-btn" onclick="removeSelectedCourses()">Retirer Cours</button>
                <button class="clear-btn" onclick="clearCart()">Vider le Panier</button>
            </div>
        </section>

        <!-- Autres sections -->
        <section id="progress" class="section">
            <h2>PROGRESS</h2>
        </section>

        <section id="stage" class="section">
            <h2>STAGE</h2>
        </section>

    </main>
</body>
</html>
