document.getElementById("admin-login-form").addEventListener("submit", function (e) {
    e.preventDefault();
    const password = document.getElementById("admin-password").value;

    fetch("../includes/admin.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `password=${encodeURIComponent(password)}`,
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.success) {
            document.getElementById("admin-access").style.display = "none";
            document.getElementById("admin-dashboard").style.display = "block";
            document.getElementById("total-visitors").textContent = data.totalVisitors;
            document.getElementById("total-signups").textContent = data.totalSignups;

            const usersTable = document.getElementById("users-table");
            usersTable.innerHTML = "";
            data.users.forEach((user) => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${user.email}</td>
                    <td>${user.username}</td>
                    <td>${user.signup_date}</td>
                `;
                usersTable.appendChild(row);
            });
        } else {
            document.getElementById("error-message").style.display = "block";
        }
    });
});