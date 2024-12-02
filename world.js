document.addEventListener('DOMContentLoaded', function() {
    // Country Lookup Button
    const lookupButton = document.getElementById('lookup');
    lookupButton.addEventListener('click', function() {
        const countryInput = document.getElementById('country');
        const resultDiv = document.getElementById('result');
        const countryName = countryInput.value;

        // Fetch country data
        fetch(`world.php?country=${encodeURIComponent(countryName)}`)
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
                resultDiv.innerHTML = 'An error occurred while fetching data.';
            });
    });

    // Lookup Cities Button (added for Exercise 5)
    const lookupCitiesButton = document.getElementById('lookupCities')
    lookupCitiesButton.addEventListener('click', function() {
        const countryInput = document.getElementById('c');
        const resultDiv = document.getElementById('result');
        const countryName = countryInput.value;

        // Fetch city data
        fetch(`world.php?cities=${encodeURIComponent(countryName)}&lookup=cities`)
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
                resultDiv.innerHTML = 'An error occurred while fetching city data.';
            });
    });

    // Insert the Lookup Cities button after the original lookup button
    const originalButton = document.getElementById('lookup');
    originalButton.parentNode.insertBefore(lookupCitiesButton, originalButton.nextSibling);
});