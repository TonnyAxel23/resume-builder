document.getElementById('resumeForm').addEventListener('submit', function(event) {
    event.preventDefault();
    
    // Clear previous error states
    const inputs = document.querySelectorAll('input, textarea');
    inputs.forEach(input => {
        input.classList.remove('error');
        const errorMessage = input.nextElementSibling;
        if (errorMessage && errorMessage.classList.contains('error-message')) {
            errorMessage.remove();
        }
    });

    let isValid = true;

    // Validate required fields
    const requiredFields = ['name', 'email', 'phone', 'education', 'experience', 'skills', 'summary'];
    requiredFields.forEach(field => {
        const input = document.getElementById(field);
        if (!input.value.trim()) {
            isValid = false;
            input.classList.add('error');
            const errorMessage = document.createElement('span');
            errorMessage.className = 'error-message';
            errorMessage.textContent = `${input.name} is required.`;
            input.insertAdjacentElement('afterend', errorMessage);
        }
    });

    // Validate email format
    const email = document.getElementById('email');
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (email.value && !emailPattern.test(email.value)) {
        isValid = false;
        email.classList.add('error');
        const errorMessage = document.createElement('span');
        errorMessage.className = 'error-message';
        errorMessage.textContent = 'Please enter a valid email address.';
        email.insertAdjacentElement('afterend', errorMessage);
    }

    // Validate phone format (basic check for numbers and optional symbols)
    const phone = document.getElementById('phone');
    const phonePattern = /^\+?[\d\s-]{7,15}$/;
    if (phone.value && !phonePattern.test(phone.value)) {
        isValid = false;
        phone.classList.add('error');
        const errorMessage = document.createElement('span');
        errorMessage.className = 'error-message';
        errorMessage.textContent = 'Please enter a valid phone number.';
        phone.insertAdjacentElement('afterend', errorMessage);
    }

    // If all validations pass, submit the form
    if (isValid) {
        this.submit();
    }
});