// admin_dashboard.js

document.addEventListener("DOMContentLoaded", function() {
    // Function to fetch and display user details
    function fetchUserDetails() {
        fetch('get_user_details.php')
            .then(response => response.json())
            .then(data => {
                const userList = document.getElementById('user-list');
                userList.innerHTML = ''; // Clear existing user list
                data.forEach(user => {
                    const listItem = document.createElement('li');
                    listItem.textContent = `${user.username} - ${user.email}`;
                    userList.appendChild(listItem);
                });
            })
            .catch(error => {
                console.error('Error fetching user details:', error);
            });
    }

    // Function to fetch and display website details
    function fetchWebsiteDetails() {
        fetch('get_website_details.php')
            .then(response => response.json())
            .then(data => {
                const websiteDetails = document.getElementById('website-details');
                websiteDetails.innerHTML = ''; // Clear existing website details table
                data.forEach(website => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${website.website_title}</td>
                        <td>${website.website_link}</td>
                        <td>${website.website_description}</td>
                        <td>${website.website_keywords}</td>
                        <td>${website.website_images}</td>
                        <td>
                            <button class="edit-btn" data-id="${website.id}">Edit</button>
                            <button class="delete-btn" data-id="${website.id}">Delete</button>
                        </td>
                    `;
                    websiteDetails.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Error fetching website details:', error);
            });
    }

    // Fetch and display user and website details when the page loads
    fetchUserDetails();
    fetchWebsiteDetails();

    // Event delegation to handle delete button click
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('delete-btn')) {
            const websiteId = event.target.getAttribute('data-id');
            if (confirm("Are you sure you want to delete this website?")) {
                // Make a fetch request to delete the website with the given ID
                fetch('delete_website.php?id=' + websiteId, {
                    method: 'DELETE'
                })
                .then(response => {
                    if (response.ok) {
                        // If deletion is successful, reload the website details
                        fetchWebsiteDetails();
                    } else {
                        console.error('Failed to delete website');
                    }
                })
                .catch(error => {
                    console.error('Error deleting website:', error);
                });
            }
        }
    });
});
