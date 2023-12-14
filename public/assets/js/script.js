document.addEventListener("DOMContentLoaded", function () {
    const favoriteToggleButtons = document.querySelectorAll(".favorite-toggle");
    const notificationElement = document.getElementById("notification");

    favoriteToggleButtons.forEach(function (button) {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            const courseId = button.getAttribute("data-course-id");
            const toggleUrl = button.getAttribute("data-toggle-url");

            // Move the function logic here
            axios
                .post(
                    toggleUrl,
                    {},
                    {
                        headers: {
                            "Content-Type": "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                        },
                        withCredentials: true,
                    }
                )
                .then((response) => {
                    console.log(response.data);
                    // Check for 'Toggle successful' message
                    if (
                        response.data.message ===
                        "Ajouter au favori avec succès"
                    ) {
                        // Update the content and show the notification
                        notificationElement.innerText =
                            "Ajouter au favori avec succès";
                        notificationElement.style.backgroundColor = "#4CAF50";
                        notificationElement.style.display = "block";

                        // Update the color of the heart icon
                        const heartIcon = button.querySelector("i");
                        heartIcon.classList.toggle("active");

                        // Hide the notification after a certain time (e.g., 3000 milliseconds)
                        setTimeout(() => {
                            notificationElement.style.display = "none";
                        }, 3000);
                    } else {
                        // Update the content and show the notification for other messages
                        notificationElement.innerText = "Supprimer favori";
                        notificationElement.style.backgroundColor = "#ff0000";
                        notificationElement.style.display = "block";
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    // Update the content and show the notification for errors
                    notificationElement.innerText = "Erreur survenue";
                    notificationElement.style.backgroundColor = "#ff0000";
                    notificationElement.style.display = "block";
                });
        });
    });
});
