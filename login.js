document.getElementById("login-form").addEventListener("submit", function (e) {
  e.preventDefault(); // Empêche le formulaire de se soumettre normalement

  // Récupération des valeurs des champs de connexion
  const identifier = document.getElementById("identifier").value;
  const password = document.getElementById("password").value;

  // Récupérer les utilisateurs enregistrés dans le localStorage
  const users = JSON.parse(localStorage.getItem("users")) || [];

  // Trouver l'utilisateur correspondant à l'email/pseudo et au mot de passe
  const user = users.find(user => (user.email === identifier || user.pseudo === identifier) && user.password === password);

  if (!user) {
    alert("Invalid email/pseudo or password!");
    return;
  }

  // Sauvegarder l'utilisateur dans le localStorage
  localStorage.setItem("currentUser", JSON.stringify(user));

  // Affichage d'un message de bienvenue et redirection vers l'éditeur
  alert(`Welcome, ${user.pseudo}!`);
  window.location.href = "editor.html"; // Redirection vers l'éditeur
});
