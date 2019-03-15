<?php $title = 'Liste des derniers billets';?>

<?php ob_start();?>
<nav class="navbar bg-dark">

<?php if (isset($_SESSION['role']) && $_SESSION['role'] == "admin"): ?>
    <a href="index.php?action=adminPanel">Administration</a>
<?php elseif (isset($_SESSION['role']) && $_SESSION['role'] == 'member'): ?>
    <a href="index.php?action=disconnect">Déconnexion</a>
<?php elseif(!isset($_SESSION['role'])): ?>
    <a href="index.php?action=login">Identifiez-vous</a>
<?php endif;?>

</nav>

<h1>Bienvenue !</h1>

<div>
    <h3>Liste des billets</h3>

    <?php foreach ($posts as $post): ?>
        <p>
            <strong><?=htmlspecialchars($post['title'])?></strong>
            écrit par
            <strong><?=htmlspecialchars($post['user_name'])?></strong>
            le
            <?=htmlspecialchars($post['post_date_fr'])?>
        </p>
        <p>
            <?=substr($post['content'], 0, 100)?> ...
        </p>
        <p><a href="index.php?action=displayPost&postId=<?=$post['id']?>" class="btn btn-primary">Voir l'article</a></p>
    <?php endforeach;?>
</div>


<?php $content = ob_get_clean();?>

<?php require 'template.php';?>