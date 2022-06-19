<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    $Id = isset($_POST['Id']) && !empty($_POST['Id']) && $_POST['Id'] != 'auto' ? $_POST['Id'] : NULL;
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $Nama = isset($_POST['Nama']) ? $_POST['Nama'] : '';
    $Email = isset($_POST['Email']) ? $_POST['Email'] : '';
    $NPM = isset($_POST['NPM']) ? $_POST['NPM'] : '';
    $Prodi = isset($_POST['Prodi']) ? $_POST['Prodi'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO kontak VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$Id, $Nama, $Email, $NPM, $Prodi]);
    // Output message
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Create Contact</h2>
    <form action="create.php" method="post">
        <label for="Id">ID</label>
        <input type="text" name="Id" disabled value="auto" id="Id">
        <label for="NPM">NPM</label>
        <input type="text" name="NPM" id="NPM">
        <label for="Nama">Nama</label>
        <input type="text" name="Nama" id="Nama">
        <label for="Email">Email</label>
        <input type="text" name="Email" id="Email">
        <label for="Prodi">Prodi</label>
        <input type="text" name="Prodi" id="Prodi">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>