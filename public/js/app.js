document.addEventListener("DOMContentLoaded", function () {
    console.log("js fonctionne");

    const favoriteToggleButtons = document.querySelectorAll(".favorite-toggle");

    favoriteToggleButtons.forEach(function (button) {
        button.addEventListener("click", async function (event) {
            event.preventDefault();

            const courseId = button.getAttribute("data-course-id");
            const toggleUrl = button.getAttribute("data-toggle-url");
            const notificationElement = button
                .closest(".course-card")
                .querySelector(".notification");
            const heartIcon = button.querySelector(".fa-heart");

            console.log("Button clicked");

            if (notificationElement) {
                try {
                    console.log("Before Axios Request");
                    const response = await axios.post(
                        toggleUrl,
                        {},
                        {
                            headers: {
                                "Content-Type": "application/json",
                                "X-Requested-With": "XMLHttpRequest",
                            },
                            withCredentials: true,
                        }
                    );
                    console.log("After Axios Request");

                    console.log(response.data);

                    if (
                        response.data.message ===
                        "Ajouter au favori avec succès"
                    ) {
                        notificationElement.innerText =
                            "Ajouter au favori avec succès";
                        notificationElement.style.backgroundColor = "#4CAF50";
                        notificationElement.style.display = "block";

                        // Ajouter ou supprimer la classe "active" du cœur
                        heartIcon.classList.toggle("active", true);
                    } else {
                        notificationElement.innerText = "Supprimer favori";
                        notificationElement.style.backgroundColor = "#ff0000";
                        notificationElement.style.display = "block";

                        // Ajouter ou supprimer la classe "active" du cœur
                        heartIcon.classList.toggle("active", false);
                    }

                    setTimeout(() => {
                        notificationElement.style.display = "none";
                    }, 3000);
                } catch (error) {
                    console.error("Error:", error);
                    notificationElement.innerText = "Erreur survenue";
                    notificationElement.style.backgroundColor = "#ff0000";
                    notificationElement.style.display = "block";
                }
            }
        });
    });
});
