document.getElementById("post-form").addEventListener("submit", function(e) {
    e.preventDefault();
    let input = document.getElementById("post-input").value;
    let imageFile = document.getElementById("image-upload").files[0];
    
    if (input.trim() !== "" || imageFile) {
        const formData = new FormData(this);
        
        fetch("save_post.php", {
            method: "POST",
            body: formData
        })
        .then(response => {
            if (!response.ok) throw new Error('Post failed: ' + response.status);
            return response.json();
        })
        .then(data => {
            if (data.success) {
                document.getElementById("post-input").value = "";
                document.getElementById("image-upload").value = "";
                document.getElementById("selected-file-name").textContent = "";
                location.reload();
            } else {
                console.error("Post failed:", data);
            }
        })
        .catch(error => console.error("Error posting:", error));
    }
});

document.getElementById("image-upload").addEventListener("change", function() {
    const fileName = this.files[0] ? this.files[0].name : "";
    document.getElementById("selected-file-name").textContent = fileName;
});


document.addEventListener("DOMContentLoaded", function() {
    console.log("DOM loaded, attaching delete listeners"); // Debug
    document.querySelectorAll(".delete-post").forEach(button => {
        button.addEventListener("click", function() {
            let index = this.getAttribute("data-index");
            console.log("Delete clicked for index:", index); // Debug
            fetch("delete_post.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "index=" + index
            })
            .then(response => {
                console.log("Delete response status:", response.status); // Debug
                if (!response.ok) throw new Error('Delete failed: ' + response.status);
                return response.json();
            })
            .then(data => {
                console.log("Delete response data:", data); // Debug
                if (data.success) {
                    let postElement = this.closest('.post');
                    if (postElement) {
                        console.log("Removing post element for index:", index); // Debug
                        postElement.remove();
                    } else {
                        console.error("Post element not found for index:", index);
                    }
                } else {
                    console.error("Delete failed:", data.error);
                }
            })
            .catch(error => console.error("Error deleting:", error));
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".like-btn").forEach(button => {
        let index = button.getAttribute("data-index");
        let countElement = button.nextElementSibling;
        if (!countElement || !countElement.classList.contains("like-count")) {
            countElement = document.createElement("span");
            countElement.className = "like-count";
            button.parentNode.appendChild(countElement);
        }
        let isLiked = localStorage.getItem(`like_${index}`) === "true";
        let storedCount = parseInt(localStorage.getItem(`likeCount_${index}`) || "0");
        if (isLiked && (storedCount === 0 || isNaN(storedCount))) {
            localStorage.setItem(`like_${index}`, "false");
            localStorage.setItem(`likeCount_${index}`, "0");
            isLiked = false;
            storedCount = 0;
        }
        button.textContent = isLiked ? "♥" : "♡";
        countElement.textContent = isLiked ? Math.max(1, storedCount) : "";
        button.classList.toggle("liked", isLiked);

        button.addEventListener("click", function() {
            toggleLike(index, button, countElement);
        });
    });
});

function toggleLike(index, button, countElement) {
    let isLiked = localStorage.getItem(`like_${index}`) === "true";
    let count = parseInt(localStorage.getItem(`likeCount_${index}`) || "0");
    if (isLiked) {
        button.textContent = "♡";
        button.classList.remove("liked", "animate-like-btn");
        count = Math.max(0, count - 1);
    } else {
        button.textContent = "♥";
        button.classList.add("liked", "animate-like-btn");
        count += 1;
    }
    localStorage.setItem(`like_${index}`, !isLiked);
    localStorage.setItem(`likeCount_${index}`, count.toString());
    countElement.textContent = count > 0 ? count : "";
    setTimeout(() => button.classList.remove("animate-like-btn"), 500);
}

document.getElementById("post-input").addEventListener("input", function() {
    let button = document.getElementById("post-button");
    if (this.value.trim() !== "") {
        button.classList.add("green");
    } else {
        button.classList.remove("green");
    }
});
