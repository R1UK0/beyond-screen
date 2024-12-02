fetch('../includes/get_user_repositories.php')
    .then(response => response.json())
    .then(data => {
        const container = document.getElementById('repositories');
        container.innerHTML = '';
        data.repositories.forEach(repo => {
            const repoElement = document.createElement('div');
            repoElement.classList.add('repository');
            repoElement.innerHTML = `<h3>${repo.name}</h3><p>${repo.description}</p>`;
            container.appendChild(repoElement);
        });
    });
