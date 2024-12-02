document.addEventListener('DOMContentLoaded', function() {
    // Listen for clicks on the "Lookup" button
    const lookupButton = document.getElementById('lookup');
    lookupButton.addEventListener('click', lookupCountry);
});

function lookupCountry() {
    const countryInput = document.getElementById('country');
    const resultDiv = document.getElementById('result');
    const countryName = countryInput.value;

    // Fetch country data from world.php
    fetch(`world.php?country=${encodeURIComponent(countryName)}`)
        .then(response => response.text())
        .then(data => {
            // Print the fetched data to the "result" div
            resultDiv.innerHTML = data;
        })
        .catch(error => {
            console.error('Error:', error);
            resultDiv.innerHTML = 'An error occurred while fetching data.';
        });
}