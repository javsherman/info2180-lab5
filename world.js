document.addEventListener('DOMContentLoaded', function() {
    const countryInput = document.getElementById('country');
    const resultDiv = document.getElementById('result');
    const lookupButton = document.getElementById('lookup');
    const lookupCitiesButton = document.getElementById('lookupCities');

    // Country Lookup Button
    lookupButton.addEventListener('click', function() {
        const countryName = countryInput.value;

        // Clear previous results
        resultDiv.innerHTML = '';

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

    // Lookup Cities Button 
    lookupCitiesButton.addEventListener('click', function() {
        const countryName = countryInput.value;

        // Clear previous results
        resultDiv.innerHTML = '';

        // Fetch city data
        fetch(`world.php?country=${encodeURIComponent(countryName)}&lookup=cities`)
            .then(response => response.text())
            .then(data => {
                resultDiv.innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
                resultDiv.innerHTML = 'An error occurred while fetching city data.';
            });
    });
});