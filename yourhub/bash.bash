/project-root
    /assets
        /css
            styles.css       # Feuilles de style globales
        /js
            app.js           # Scripts JavaScript globaux
            admin.js         # Scripts pour l'admin
            dashboard.js     # Scripts pour le tableau de bord
    /includes
        config.php           # Configuration de la base de données
        session.php          # Gestion des sessions
        header.php           # En-tête commun
        footer.php           # Pied de page commun
    /handlers
        login_handler.php    # Gestion des connexions
        register_handler.php # Gestion des inscriptions
        logout_handler.php   # Déconnexion
    /pages
        index.html           # Page d'accueil
        login.html           # Page de connexion
        register.html        # Page d'inscription
        dashboard.html       # Tableau de bord après connexion
        profile.html         # Page de profil utilisateur
        admin.html           # Interface admin (avec AJAX pour les données)
        repositories.html    # Liste des dépôts utilisateur
        forum.html           # Forum communautaire
    /sql
        init.sql             # Script de création de la base de données
