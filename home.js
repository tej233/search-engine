document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    const searchResults = document.getElementById('searchResults');

    searchForm.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(searchForm);

        fetch('home.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                searchResults.innerHTML = data;
            });
    });
});