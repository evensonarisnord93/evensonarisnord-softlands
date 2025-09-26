<?php
	namespace Evensonarisnord\Softlands\generateurs;

class UserTemplate {

    /**
     * Gestion des utilisateur
     * @author Evenson ARISNORD
     * @author ECOLANUM
     * Génère le HTML pour un en-tête de section utilisateur.
     * @param string $title Le titre de la section.
     * @return string Le code HTML de l'en-tête.
     */
    public function renderHeader(string $title = "Gestion des Utilisateurs"): string {
        return "
            <div class='user-management-header'>
                <h1>" . htmlspecialchars($title) . "</h1>
                <a href='create_user.php' class='btn-create'>Créer un nouvel utilisateur</a>
            </div>
            <hr>";
    }

    /**
     * Génère le HTML pour afficher une liste d'utilisateurs.
     * @param array $users Un tableau d'objets utilisateur (par exemple, ['id' => 1, 'name' => 'John Doe']).
     * @return string Le code HTML de la liste ou un message d'absence d'utilisateur.
     */
    public function renderUserList(array $users): string {
        if (empty($users)) {
            return "<p class='no-users'>Aucun utilisateur trouvé.</p>";
        }

        $html = "<table class='user-table'>";
        $html .= "<thead><tr><th>ID</th><th>Nom</th><th>Email</th><th>Actions</th></tr></thead>";
        $html .= "<tbody>";

        foreach ($users as $user) {
            // Sécurité : toujours échapper les données avant de les afficher (XSS)
            $id = htmlspecialchars($user['id'] ?? '');
            $name = htmlspecialchars($user['name'] ?? 'N/A');
            $email = htmlspecialchars($user['email'] ?? 'N/A');

            $html .= "
                <tr>
                    <td>$id</td>
                    <td>$name</td>
                    <td>$email</td>
                    <td>
                        <a href='edit_user.php?id=$id' class='btn-edit'>Modifier</a>
                        <a href='delete_user.php?id=$id' class='btn-delete'>Supprimer</a>
                    </td>
                </tr>";
        }

        $html .= "</tbody></table>";
        return $html;
    }

    /**
     * Génère un simple formulaire pour la création ou la modification.
     * @param array $userData Données utilisateur pour pré-remplir le formulaire (vide par défaut).
     * @param string $actionURL URL vers laquelle envoyer le formulaire.
     * @return string Le code HTML du formulaire.
     */
    public function renderUserForm(array $userData = [], string $actionURL = 'save_user.php'): string {
        $name = htmlspecialchars($userData['name'] ?? '');
        $email = htmlspecialchars($userData['email'] ?? '');
        $isEdit = isset($userData['id']);

        $html = "<form action='$actionURL' method='POST' class='user-form'>";
        
        if ($isEdit) {
            $id = htmlspecialchars($userData['id']);
            $html .= "<input type='hidden' name='id' value='$id'>";
        }

        $html .= "
            <label for='name'>Nom :</label>
            <input type='text' id='name' name='name' value='$name' required>

            <label for='email'>Email :</label>
            <input type='email' id='email' name='email' value='$email' required>
            
            <button type='submit' name='save'>" . ($isEdit ? 'Enregistrer les modifications' : 'Créer l\'utilisateur') . "</button>
        </form>";

        return $html;
    }
}