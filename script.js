//dark mode toggle
const toggleBtn = document.getElementById("themeToggle");

// check if user had dark mode on before 
if (localStorage.getItem("theme") === "dark") {
    document.body.classList.add("dark");
    toggleBtn.innerHTML = "☀️";
}

toggleBtn.addEventListener("click", () => {
    document.body.classList.toggle("dark");

    if (document.body.classList.contains("dark")) {
        toggleBtn.innerHTML = "☀️";
        localStorage.setItem("theme", "dark");
    } else {
        toggleBtn.innerHTML = "🌙";
        localStorage.setItem("theme", "light");
    }
});


// toast notification
function showToast(message, type = "success") {
    // Remove old toast if any
    const oldToast = document.querySelector(".toast");
    if (oldToast) oldToast.remove();

    const toast = document.createElement("div");
    toast.className = "toast toast-" + type;
    toast.textContent = message;
    document.body.appendChild(toast);

    // Show it
    setTimeout(() => toast.classList.add("show"), 10);

    // hide after 3 seconds
    setTimeout(() => {
        toast.classList.remove("show");
        setTimeout(() => toast.remove(), 400);
    }, 3000);
}



// Filter buttons on shop page
const filterBtns = document.querySelectorAll(".filter-btn");
const productCards = document.querySelectorAll(".product-card");

filterBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        // Remove active from all buttons
        filterBtns.forEach(b => b.classList.remove("active"));
        btn.classList.add("active");

        const mood = btn.getAttribute("data-mood");

        // Show/hide cards
        productCards.forEach(card => {
            if (mood === "all" || card.getAttribute("data-mood") === mood) {
                card.style.display = "flex";
            } else {
                card.style.display = "none";
            }
        });
    });
});


// cart quantity

document.querySelectorAll(".qty-btn").forEach(btn => {
    btn.addEventListener("click", function() {
        this.style.transform = "scale(0.8)";
        setTimeout(() => this.style.transform = "", 150);
    });
});


// payment option highlight
document.querySelectorAll(".payment-option").forEach(option => {
    option.addEventListener("click", function() {
        // Remove highlight from all
        document.querySelectorAll(".payment-option").forEach(o => {
            o.style.borderColor = "";
            o.style.background = "";
        });
        // Highlight selected
        this.style.borderColor = "#7c3aed";
        this.style.background = "rgba(124,58,237,0.05)";
    });
});


// smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener("click", function(e) {
        const target = document.querySelector(this.getAttribute("href"));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: "smooth" });
        }
    });
});



// Highlight current page in navbar
const currentPage = window.location.pathname.split("/").pop();
document.querySelectorAll(".nav-links a").forEach(link => {
    const linkPage = link.getAttribute("href");
    if (linkPage === currentPage || (currentPage === "" && linkPage === "index.php")) {
        link.style.borderBottom = "2px solid white";
        link.style.paddingBottom = "3px";
    }
});




// signup form validation
var signupForm = document.getElementById("signupForm");

if (signupForm) {

    signupForm.addEventListener("submit", function(e) {

        // Get all input values
        var name     = document.getElementById("signupName").value.trim();
        var email    = document.getElementById("signupEmail").value.trim();
        var password = document.getElementById("signupPassword").value;
        var confirm  = document.getElementById("signupConfirm").value;

        // Clear old error messages first
        document.getElementById("nameError").textContent     = "";
        document.getElementById("emailError").textContent    = "";
        document.getElementById("passwordError").textContent = "";
        document.getElementById("confirmError").textContent  = "";

        // Remove red borders first
        document.getElementById("signupName").style.borderColor     = "";
        document.getElementById("signupEmail").style.borderColor    = "";
        document.getElementById("signupPassword").style.borderColor = "";
        document.getElementById("signupConfirm").style.borderColor  = "";

        // Track if there's any error
        var hasError = false;

        //  name must not be empty
        if (name == "") {
            document.getElementById("nameError").textContent = "❌ Please enter your full name.";
            document.getElementById("signupName").style.borderColor = "red";
            hasError = true;
        }

        //  email must not be empty
        if (email == "") {
            document.getElementById("emailError").textContent = "❌ Please enter your email.";
            document.getElementById("signupEmail").style.borderColor = "red";
            hasError = true;
        }

        //  password must be at least 6 characters
        if (password.length < 6) {
            document.getElementById("passwordError").textContent = "❌ Password must be at least 6 characters.";
            document.getElementById("signupPassword").style.borderColor = "red";
            hasError = true;
        }

        //  confirm password must match password
        if (password != confirm) {
            document.getElementById("confirmError").textContent = "❌ Passwords do not match.";
            document.getElementById("signupConfirm").style.borderColor = "red";
            hasError = true;
        }

        // If there is any error, stop the form from submitting
        if (hasError) {
            e.preventDefault();
        }

    });
}


// login form validation
var loginForm = document.getElementById("loginForm");

if (loginForm) {

    loginForm.addEventListener("submit", function(e) {

        // Get input values
        var email    = document.getElementById("loginEmail").value.trim();
        var password = document.getElementById("loginPassword").value;

        // Reset borders
        document.getElementById("loginEmail").style.borderColor    = "";
        document.getElementById("loginPassword").style.borderColor = "";

        var hasError = false;

        // Check: email must not be empty
        if (email == "") {
            document.getElementById("loginEmail").style.borderColor = "red";
            hasError = true;
        }

        // Check: password must not be empty
        if (password == "") {
            document.getElementById("loginPassword").style.borderColor = "red";
            hasError = true;
        }

        // If there is any error, stop the form from submitting
        if (hasError) {
            e.preventDefault();
            showToast("❌ Please fill in all fields.", "error");
        }

    });
}


