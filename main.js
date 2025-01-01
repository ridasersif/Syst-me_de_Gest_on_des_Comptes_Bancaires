document.addEventListener("DOMContentLoaded", function () {
    const accountType = document.getElementById("account_type");
    const savingsFields = document.getElementById("savings_fields");
    const currentFields = document.getElementById("current_fields");
    const businessFields = document.getElementById("business_fields");

    accountType.addEventListener("change", function () {
     
        savingsFields.style.display = "none";
        currentFields.style.display = "none";
        businessFields.style.display = "none";

        const selectedType = accountType.value;
        if (selectedType === "savings") {
            savingsFields.style.display = "block";
        } else if (selectedType === "current") {
            currentFields.style.display = "block";
        } else if (selectedType === "business") {
            businessFields.style.display = "block";
        }
    });
});
