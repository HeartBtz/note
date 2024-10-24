<?php
require_once 'functions.php';

// Ajouter une note
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_note'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    addNote($title, $content);
    header('Location: index.php');
    exit;
}

// Supprimer une note
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_note'])) {
    $noteId = $_POST['note_id'];
    deleteNote($noteId);
    header('Location: index.php');
    exit;
}

// Récupérer les notes
$pdo = getPDOConnection();
$stmt = $pdo->query("SELECT * FROM notes ORDER BY id DESC");
$notes = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <!-- Formulaire pour ajouter une note -->
        <form method="POST" action="index.php">
            <div class="table">
                <div class="row header">
                    <div class="cell">Nom de la note</div>
                    <div class="cell">Contenu de la note</div>
                </div>
                <div class="row">
                    <div class="cell"><input type="text" name="title" placeholder="Titre" required></div>
                    <div class="cell"><textarea name="content" placeholder="Contenu" required></textarea></div>
                    <div class="cell"><button type="submit" name="add_note">Ajouter</button></div>
                </div>
            </div>
        
            
        </form>

        <!-- Affichage des notes -->
        <div id="notes-table" class="table">
            <?php foreach ($notes as $note): ?>
                <div class="row note">
                    <div class="cell title"><?php echo htmlspecialchars($note['title']); ?></div>
                    <div class="cell content"><?php echo nl2br(htmlspecialchars($note['content'])); ?></div>
                    <div class="cell actions">
                        <!-- Formulaire pour supprimer une note avec confirmation -->
                        <form method="POST" action="index.php" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette note ?');">
                            <input type="hidden" name="note_id" value="<?php echo $note['id']; ?>">
                            <button type="submit" name="delete_note" class="delete-btn">Supprimer</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 Notes App</p>
    </footer>
</body>
</html>