window.addEventListener("load", () => {
  const currentUser = JSON.parse(localStorage.getItem("currentUser"));
  if (!currentUser) {
    alert("You must be logged in to access the editor.");
    window.location.href = "login.html"; // Redirige vers la page de connexion si non connecté
  } else {
    // Affiche l'image de profil dans l'en-tête
    document.getElementById("profile-pic").src = currentUser.profilePic || "default-profile-pic.jpg";
  }
});




// Variables globales
let sections = [
  { id: "html", content: "", placeholder: "<!-- HTML Code -->" },
  { id: "css", content: "", placeholder: "/* CSS Code */" },
  { id: "js", content: "", placeholder: "// JavaScript Code" },
];

// Fonction pour mettre à jour le rendu
function updateOutput() {
  const iframe = document.getElementById("output");
  const html = sections.find((s) => s.id === "html").content;
  const css = sections.find((s) => s.id === "css").content;
  const js = sections.find((s) => s.id === "js").content;

  iframe.srcdoc = `
    <html>
      <head>
        <style>${css}</style>
      </head>
      <body>
        ${html}
        <script>${js}<\/script>
      </body>
    </html>`;
}

// Initialisation des sections
function initializeEditor() {
  const editorContainer = document.getElementById("editor-container");

  sections.forEach((section) => {
    const textarea = document.createElement("textarea");
    textarea.id = section.id;
    textarea.placeholder = section.placeholder;

    textarea.addEventListener("input", () => {
      section.content = textarea.value;
      updateOutput();
    });

    editorContainer.appendChild(textarea);
  });

  updateOutput();
}

// Déconnexion
document.getElementById("logout-button").addEventListener("click", () => {
  localStorage.removeItem("currentUser");
  window.location.href = "login.html";
});

// Initialiser l'éditeur au chargement de la page
initializeEditor();

// Fonction pour activer/désactiver le menu
function toggleMenu() {
  document.getElementById("menu").classList.toggle("active");
}

// Vérification de la connexion dans l'éditeur
window.addEventListener("load", () => {
  const currentUser = JSON.parse(localStorage.getItem("currentUser"));
  if (!currentUser) {
    alert("You must be logged in to access the editor.");
    window.location.href = "login.html"; // Redirige vers la page de connexion si non connecté
  } else {
    console.log(`Welcome, ${currentUser.pseudo}`);
    document.getElementById("profile-pic").src = currentUser.profilePic || "default-profile-pic.jpg"; // Affiche la photo de profil
  }
});
