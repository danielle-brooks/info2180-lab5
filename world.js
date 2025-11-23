window.onload = function () {
    const lookupBtn       = document.querySelector("#lookup");
    const lookupCitiesBtn = document.querySelector("#lookupCities");
    const input           = document.querySelector("#country");
    const result          = document.querySelector("#result");

    // FUNCTION: Fetch & display results
    function sendRequest(url) {
        fetch(url)
            .then(response => response.text())
            .then(data => {
                result.innerHTML = data;
            })
            .catch(error => {
                result.innerHTML = "<p>Error fetching data.</p>";
            });
    }

    // Lookup country button
    lookupBtn.addEventListener("click", function () {
        const country = input.value.trim();
        sendRequest(`world.php?country=${country}`);
    });

    // Lookup cities button
    lookupCitiesBtn.addEventListener("click", function () {
        const country = input.value.trim();
        sendRequest(`world.php?country=${country}&lookup=cities`);
    });
};
