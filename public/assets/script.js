// Simple JS for form confirmations and score validation

// Wait for the entire DOM content to load before executing the script
document.addEventListener("DOMContentLoaded", () => {
    
    // Select all forms with the class 'score-form' — used for submitting scores
    const scoreForms = document.querySelectorAll(".score-form");

    // Loop through each form and attach a 'submit' event listener
    scoreForms.forEach(form => {
        form.addEventListener("submit", function(e) {
            // Display a confirmation dialog when a form is submitted
            const confirmAction = confirm("Are you sure you want to submit these scores?");
            
            // If the user cancels the action, prevent the form from submitting
            if (!confirmAction) {
                e.preventDefault();
            }
        });
    });

    // Select all input fields meant for scores (with class 'score-input')
    const scoreInputs = document.querySelectorAll(".score-input");

    // Loop through each input and attach an 'input' event listener for real-time validation
    scoreInputs.forEach(input => {
        input.addEventListener("input", function () {
            // Convert the input value to an integer
            let val = parseInt(this.value);
            
            // If the entered value is less than 0, set it to 0
            if (val < 0) this.value = 0;

            // If the entered value is greater than 100, set it to 100
            if (val > 100) this.value = 100;
        });
    });
});
