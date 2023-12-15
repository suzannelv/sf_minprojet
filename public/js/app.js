document.addEventListener("DOMContentLoaded", function () {
    // console.log("js fonctionne");
    const favoriteToggleButtons = document.querySelectorAll(".favorite-toggle");
    const notificationElement = document.querySelectorAll(".notification");

    favoriteToggleButtons.forEach(function (button) {
        button.addEventListener("click", function (event) {
            event.preventDefault();

            const courseId = button.getAttribute("data-course-id");
            const toggleUrl = button.getAttribute("data-toggle-url");
            const notificationElement = button
                .closest(".course-card")
                .querySelector(".notification");

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

                    if (
                        response.data.message ===
                        "Ajouter au favori avec succès"
                    ) {
                        notificationElement.innerText =
                            "Ajouter au favori avec succès";
                        notificationElement.style.backgroundColor = "#4CAF50";
                        notificationElement.style.display = "block";

                        // mise à jour la couleur d'icon
                        const heartIcon = button.querySelector(".fa-heart");
                        heartIcon.classList.toggle("active");

                        // cacher la notification au bout de 3 secondes
                        requestAnimationFrame(() => {
                            // Hide the notification after a certain time (e.g., 3000 milliseconds)
                            setTimeout(() => {
                                notificationElement.style.display = "none";
                            }, 3000);
                        });
                    } else {
                        notificationElement.innerText = "Supprimer favori";
                        notificationElement.style.backgroundColor = "#ff0000";
                        notificationElement.style.display = "block";
                        setTimeout(() => {
                            notificationElement.style.display = "none";
                        }, 3000);
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    notificationElement.innerText = "Erreur survenue";
                    notificationElement.style.backgroundColor = "#ff0000";
                    notificationElement.style.display = "block";
                });
        });
    });
});
