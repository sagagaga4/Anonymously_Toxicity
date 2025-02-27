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

document.getElementById("post-input").addEventListener("input", function() {
    let button = document.getElementById("post-button");
    if (this.value.trim() !== "") {
        button.classList.add("green"); // Switch to green when there’s input
    } else {
        button.classList.remove("green"); // Back to gray when empty
    }
});
