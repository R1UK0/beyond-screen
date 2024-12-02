// Charger les posts dynamiquement
function loadPosts() {
    fetch("../handlers/get_posts.php")
        .then((response) => response.json())
        .then((data) => {
            const postList = document.getElementById("post-list");
            postList.innerHTML = "";
            data.forEach((post) => {
                const postDiv = document.createElement("div");
                postDiv.className = "post";
                postDiv.innerHTML = `
                    <h3>${post.title}</h3>
                    <p>${post.content}</p>
                    <small>By ${post.username} on ${new Date(post.created_at).toLocaleString()}</small>
                    <form class="comment-form" data-post-id="${post.id}">
                        <textarea name="content" placeholder="Add a comment..." required></textarea>
                        <button type="submit">Comment</button>
                    </form>
                    <div class="comments" id="comments-${post.id}">
                        <!-- Comments will be loaded here -->
                    </div>
                `;
                postList.appendChild(postDiv);
            });
        });
}

// Gestion des commentaires
document.addEventListener("submit", function (e) {
    if (e.target.classList.contains("comment-form")) {
        e.preventDefault();
        const postId = e.target.dataset.postId;
        const content = e.target.querySelector("textarea").value;

        fetch("../handlers/add_comment.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `post_id=${postId}&content=${encodeURIComponent(content)}`,
        }).then(() => loadPosts());
    }
});

// Charger les posts au chargement
loadPosts();
