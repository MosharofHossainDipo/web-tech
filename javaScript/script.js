document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");

    form.addEventListener("submit", function (e) {
        let isValid = true;

        // Clear previous errors
        document.getElementById("nameError").innerHTML = "";
        document.getElementById("passwordError").innerHTML = "";
        document.getElementById("emailError").innerHTML = "";
        document.getElementById("nidError").innerHTML = "";
        document.getElementById("contactError").innerHTML = "";

        // Username validation (at least 3 characters)
        const name = document.getElementById("butcher_name").value.trim();
        if (name.length < 3) {
            document.getElementById("nameError").innerHTML = "Username must be at least 3 characters.";
            isValid = false;
        }

        // Password validation (at least 6 characters)
        const password = document.getElementById("butcher_password").value;
        if (password.length < 6) {
            document.getElementById("passwordError").innerHTML = "Password must be at least 6 characters.";
            isValid = false;
        }

        // Email validation using includes (basic check)
        const email = document.getElementById("butcher_email").value;
        if (!email.includes("@") || !email.includes(".")) {
            document.getElementById("emailError").innerHTML = "Email must contain '@' and '.'";
            isValid = false;
        }

        // NID validation (exactly 10 digits)
        const nid = document.getElementById("national_id").value;
        if (!/^\d{10}$/.test(nid)) {
            document.getElementById("nidError").innerHTML = "NID must be exactly 10 digits.";
            isValid = false;
        }

        // Emergency contact validation (exactly 11 digits)
        const contact = document.getElementById("emergency_contact").value;
        if (!/^\d{11}$/.test(contact)) {
            document.getElementById("contactError").innerHTML = "Contact number must be 11 digits.";
            isValid = false;
        }

        // Prevent submission if validation fails
        if (!isValid) {
            e.preventDefault();
        }
    });
});
