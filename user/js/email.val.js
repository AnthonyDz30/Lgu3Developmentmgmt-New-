document.getElementById('validated_form').addEventListener('submit', function(event) {
    let emailInput = document.getElementById('email');
    let emailError = document.getElementById('emailError');

    // More strict regex: Ensures email has a valid TLD (.com, .net, .org, etc.)
    let emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|net|org|gov|edu|ph|io|co\.uk)$/;

    if (!emailRegex.test(emailInput.value)) {
        event.preventDefault();
        emailError.textContent = "Invalid email. Use a valid domain like .com, .net, etc.";
        emailInput.classList.add("is-invalid");
    } else {
        emailError.textContent = "";
        emailInput.classList.remove("is-invalid");
    }
});
