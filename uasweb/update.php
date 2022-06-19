<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $id = isset($_POST['id']) ? $_POST['id'] : NULL;
        $Nama = isset($_POST['Nama']) ? $_POST['Nama'] : '';
        $Email = isset($_POST['Email']) ? $_POST['Email'] : '';
        $NPM = isset($_POST['NPM']) ? $_POST['NPM'] : '';
        $Prodi = isset($_POST['Prodi']) ? $_POST['Prodi'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE kontak SET Nama = ?, Email = ?, NPM = ?, Prodi = ? WHERE id = ?');
        $stmt->execute([ $Nama, $Email, $NPM, $Prodi, $_GET['id']]);
        $msg = 'Updated Successfully!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM kontak WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$contact) {
        exit('Contact doesn\'t exist with that id!');
    }
} else {
    exit('No id specified!');
}
?>


<?=template_header('Read')?>

<div class="content update">
	<h2>Update Contact #<?=$contact['id']?></h2>
    <form action="update.php?id=<?=$contact['id']?>" method="post">
        <label for="id">id</label>
        <input type="text" name="id" disabled value="<?=$contact['id']?>" id="id">
        <label for="NPM">NPM</label>
        <input type="text" name="NPM" value="<?=$contact['NPM']?>" id="NPM">
        <label for="Nama">Nama</label>
        <input type="text" name="Nama" value="<?=$contact['Nama']?>" id="Nama">
        <label for="Email">Email</label>
        <input type="text" name="Email" value="<?=$contact['Email']?>" id="Email">
        <label for="Prodi">Prodi</label>
        <input type="text" name="Prodi" value="<?=$contact['Prodi']?>" id="title">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>