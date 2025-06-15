document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('customer-registration-form');

    const fields = {
        full_name: {
            element: document.getElementById('name'),
            validate: value => {
                if (!value) return 'Full Name cannot be empty.';
                if (value.trim().split(/\s+/).length < 2) return 'Full Name must contain at least two words.';
                if (!/^[a-zA-Z][a-zA-Z.\- ]*$/.test(value)) return 'Only letters, dots, dashes, and spaces allowed.';
                return '';
            }
        },
        email: {
            element: document.getElementById('email'),
            validate: value => {
                if (!value) return 'Email cannot be empty.';
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) return 'Invalid email format.';
                return '';
            }
        },
        phone: {
            element: document.getElementById('phone'),
            validate: value => {
                if (!value) return 'Phone number cannot be empty.';
                if (!/^\+8801[3-9]\d{8}$/.test(value)) return 'Invalid Bangladeshi number format.';
                return '';
            }
        },
        dob: {
            element: document.getElementById('dob'),
            validate: value => {
                if (!value) return 'Date of Birth cannot be empty.';
                const [year, month, day] = value.split('-').map(Number);
                if (isNaN(year) || year < 1900 || year > 2025 || isNaN(month) || month < 1 || month > 12 || isNaN(day) || day < 1 || day > 31) {
                    return 'Must be a valid date (YYYY-MM-DD).';
                }
                return '';
            }
        },
        password: {
            element: document.getElementById('password'),
            validate: value => {
                if (!value) return 'Password cannot be empty.';
                if (!/[0-9]/.test(value) || !/[!@#$%^&*]/.test(value)) {
                    return 'Password must include a number and special character.';
                }
                return '';
            }
        }
    };

    const serviceRadios = document.querySelectorAll('input[name="service_type"]');
    const serviceContainer = document.getElementById('service-error-container');

    form.addEventListener('submit', function (event) {
        let isValid = true;

        // Validate all fields
        for (let key in fields) {
            const field = fields[key];
            const value = field.element.value.trim();
            const errorMsg = field.validate(value);
            if (errorMsg) {
                showError(field.element, errorMsg);
                isValid = false;
            } else {
                clearError(field.element);
            }
        }

        // Validate service type
        const serviceSelected = Array.from(serviceRadios).some(radio => radio.checked);
        if (!serviceSelected) {
            serviceContainer.innerHTML = '<div class="error-message" style="color: red;">Please select a service type.</div>';
            isValid = false;
        } else {
            serviceContainer.innerHTML = '';
        }

        if (!isValid) {
            event.preventDefault();
        }
    });

    function showError(input, message) {
        let error = input.nextElementSibling;
        if (!error || !error.classList.contains('error-message')) {
            error = document.createElement('div');
            error.className = 'error-message';
            input.insertAdjacentElement('afterend', error);
        }
        error.innerHTML = `<span style="color: red;">${message}</span>`;
        input.classList.add('error');
    }

    function clearError(input) {
        const error = input.nextElementSibling;
        if (error && error.classList.contains('error-message')) {
            error.innerHTML = '';
        }
        input.classList.remove('error');
    }
});
