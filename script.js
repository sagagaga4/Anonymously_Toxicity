document.getElementById("post-form").addEventListener("submit", function(e) {
    e.preventDefault(); // Stop page reload
    let input = document.getElementById("post-input").value;
    if (input.trim() !== "") {
        fetch("save_post.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: "post=" + encodeURIComponent(input)
        }).then(() => {
            document.getElementById("post-input").value = ""; // Clear input
            location.reload(); // Reload to show new post
        });
    }
});

// Add delete listeners after page load
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".delete-post").forEach(button => {
        button.addEventListener("click", function() {
            let index = this.getAttribute("data-index");
            fetch("delete_post.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: "index=" + index
            }).then(() => this.parentElement.remove()); // Remove post from DOM
        });
    });
});
// Add like listeners after page load
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".like-btn").forEach(button => {
        let index = button.getAttribute("data-index");
        let countElement = button.nextElementSibling; // Get or create like-count
        if (!countElement || !countElement.classList.contains("like-count")) {
            countElement = document.createElement("span");
            countElement.className = "like-count";
            countElement.textContent = localStorage.getItem(`likeCount_${index}`) || 0;
            button.parentNode.appendChild(countElement);
        }

        let isLiked = localStorage.getItem(`like_${index}`) === "true";
        if (isLiked) {
            button.textContent = "♥";
            button.classList.add("liked");
        } else {
            button.textContent = "♡";
            button.classList.remove("liked");
        }

        button.addEventListener("click", function() {
            toggleLike(index, button, countElement);
        });
    });
});

// Function to toggle like state
function toggleLike(index, button, countElement) {
    let isLiked = localStorage.getItem(`like_${index}`) === "true";
    let count = parseInt(localStorage.getItem(`likeCount_${index}`) || 0);

    if (isLiked) {
        button.textContent = "♡";
        button.classList.remove("liked", "animate-like-btn");
        count = Math.max(0, count - 1); // Decrement, but not below 0
    } else {
        button.textContent = "♥";
        button.classList.add("liked", "animate-like-btn"); // Add animation class
        count += 1; // Increment
    }
    localStorage.setItem(`like_${index}`, !isLiked);
    localStorage.setItem(`likeCount_${index}`, count);
    countElement.textContent = count > 0 ? count : ""; // Update count, hide if 0
    setTimeout(() => button.classList.remove("animate-like-btn"), 500); // Remove animation after 0.5s
}

document.getElementById("post-input").addEventListener("input", function() {
    let button = document.getElementById("post-button");
    if (this.value.trim() !== "") {
        button.classList.add("green"); 
    } else {
        button.classList.remove("green");
    }
});
