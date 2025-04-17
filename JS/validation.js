document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('customer-registration-form');
    const fullNameInput = document.getElementById('full_name');
    const emailInput = document.getElementById('email');
    const phoneInput = document.getElementById('phone');
    const dobInput = document.getElementById('dob');
    const passwordInput = document.getElementById('password');
    const serviceRadios = document.querySelectorAll('input[name="service_type"]');
    const serviceContainer = document.getElementById('service-error-container');

    form.addEventListener('submit', function (event) {
        let isValid = true;

        const fullNameValue = fullNameInput.value.trim();
        {
            clearError(fullNameInput);
        }

        const emailValue = emailInput.value.trim();
        if (emailValue === '') {
            displayError(emailInput, 'Email cannot be empty.');
            isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailValue)) {
            displayError(emailInput, 'Invalid email format (e.g., name@example.com).');
            isValid = false;
        } else {
            clearError(emailInput);
        }

        let serviceSelected = false;
        for (const radio of serviceRadios) {
            if (radio.checked) {
                serviceSelected = true;
                break;
            }
        }
        if (!serviceSelected) {
            serviceContainer.innerHTML = `<div class="error-message">Please select a service type.</div>`;
            isValid = false;
        } else {
            serviceContainer.innerHTML = '';
        }

        const phoneValue = phoneInput.value.trim();
        if (phoneValue === '') {
            displayError(phoneInput, 'Phone number cannot be empty.');
            isValid = false;
        } else if (!/^\+8801[3-9]\d{8}$/.test(phoneValue)) {
            displayError(phoneInput, 'Invalid Bangladeshi number (e.g., +8801XXXXXXXXX).');
            isValid = false;
        } else {
            clearError(phoneInput);
        }

        const dobValue = dobInput.value.trim();
        if (dobValue === '') {
            displayError(dobInput, 'Date of Birth cannot be empty.');
            isValid = false;
        } else {
            const [year, month, day] = dobValue.split('-').map(Number);
            if (isNaN(year) || year < 1900 || year > 2025 || isNaN(month) || month < 1 || month > 12 || isNaN(day) || day < 1 || day > 31) {
                displayError(dobInput, 'Must be a valid date (YYYY-MM-DD).');
                isValid = false;
            } else {
                clearError(dobInput);
            }
        }

        const passwordValue = passwordInput.value.trim();
        if (passwordValue === '') {
            displayError(passwordInput, 'Password cannot be empty.');
            isValid = false;
        } else if (!/(?=.*[0-9])/.test(passwordValue) || !/(?=.*[!@#$%^&*])/.test(passwordValue)) {
            displayError(passwordInput, 'Password must include at least one number and one special character (!@#$%^&*).');
            isValid = false;
        } else {
            clearError(passwordInput);
        }

        if (!isValid) {
            event.preventDefault(); 
        }
    });

    function displayError(inputElement, message) {
        let errorElement = inputElement.nextElementSibling;
        if (!errorElement || !errorElement.classList.contains('error-message')) {
            errorElement = document.createElement('div');
            errorElement.className = 'error-message';
            inputElement.parentNode.insertBefore(errorElement, inputElement.nextSibling);
        }
        errorElement.innerHTML = `<span style="color: red;">${message}</span>`;
        inputElement.classList.add('error');
    }

    function clearError(inputElement) {
        const errorElement = inputElement.nextElementSibling;
        if (errorElement && errorElement.classList.contains('error-message')) {
            errorElement.innerHTML = '';
        }
        inputElement.classList.remove('error');
    }
});
