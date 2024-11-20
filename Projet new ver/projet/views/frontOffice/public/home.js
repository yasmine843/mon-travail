let cart = [];
let totalPrice = 0;


// Afficher la section active
function showSection(sectionId) {
    const sections = document.querySelectorAll('.section');
    sections.forEach(section => section.classList.remove('active'));
    const activeSection = document.getElementById(sectionId);
    if (activeSection) activeSection.classList.add('active');
}

// Ajouter un cours au panier
function addToCart(courseName, coursePrice) {
    const courseExists = cart.some(item => item.name === courseName);
    if (courseExists) {
        alert("Ce cours est déjà dans le panier.");
        return;
    }

    cart.push({ name: courseName, price: coursePrice });
    totalPrice += coursePrice;
    updateCartDetails();
    document.getElementById('cart-details').style.display = 'block';
}

// Mettre à jour les détails du panier
function updateCartDetails() {
    const cartItemsContainer = document.getElementById('cart-items');
    cartItemsContainer.innerHTML = '';

    cart.forEach((item, index) => {
        const listItem = document.createElement('li');
        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.value = index;
        checkbox.className = 'course-checkbox';

        listItem.appendChild(checkbox);
        listItem.appendChild(document.createTextNode(`${item.name} : €${item.price}`));
        cartItemsContainer.appendChild(listItem);
    });

    document.getElementById('total-price').textContent = `Prix Total: €${totalPrice}`;
}

// Valider l'achat
function validateCart() {
    const cardNumber = document.getElementById('card-number').value;
    if (cardNumber === '') {
        alert("Veuillez entrer votre numéro de carte.");
        return;
    }

    alert("Achat validé !");
    clearCart();
}

// Supprimer les cours sélectionnés
function removeSelectedCourses() {
    const checkboxes = document.querySelectorAll('.course-checkbox');
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            const courseIndex = parseInt(checkbox.value);
            totalPrice -= cart[courseIndex].price;
            cart.splice(courseIndex, 1);
        }
    });

    updateCartDetails();
    if (cart.length === 0) document.getElementById('cart-details').style.display = 'none';
}

// Vider le panier
function clearCart() {
    cart = [];
    totalPrice = 0;
    document.getElementById('card-number').value = '';
    updateCartDetails();
    document.getElementById('cart-details').style.display = 'none';
}

// Afficher la section des cours par défaut
document.addEventListener("DOMContentLoaded", () => {
    showSection('cours');
});
