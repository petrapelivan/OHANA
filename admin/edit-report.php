<?php
require_once "../config.php";
include 'nav-admin.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM izvjestaji WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$report = $result->fetch_assoc();

$kumce = $conn->query("SELECT id, ime, prezime FROM kumce");
$kumovi = $conn->query("SELECT id, ime, prezime, email FROM kumovi");

if (isset($_POST['spremi'])) {

    $kumce_id = $_POST['kumce_id'];
    $kum_id = $_POST['kum_id'];
    $opis = $_POST['opis'];
    $skola = $_POST['skola'];
    $ocjena = $_POST['ocjena'];
    $zahvala = $_POST['zahvala'];
    $status = $_POST['status'];

    $sql = "UPDATE izvjestaji SET kumce_id=?, kum_id=?, opis=?, skola=?, ocjena=?, zahvala=?, status=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisssssi", $kumce_id, $kum_id, $opis, $skola, $ocjena, $zahvala, $status, $id);

    $slika = time() . "_" . basename($_FILES['kumce_slika']['name']);
    $targetDir = "../uploads/kumce/";
    $targetFile = $targetDir . $slika;

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    if (move_uploaded_file($_FILES['kumce_slika']['tmp_name'], $targetFile)) {

        $updateSlika = $conn->prepare(
            "UPDATE kumce SET kumce_slika = ? WHERE id = ?"
        );
        $updateSlika->bind_param("si", $slika, $kumce_id);
        $updateSlika->execute();
    }

    if ($stmt->execute()) {
        header("Location:reports.php");
        exit;
    } else {
        $error = "Greška pri spremanju.";
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Uredi izvještaj</title>
    <link rel="stylesheet" href="admin-css.css">

</head>
<body>
<main class="forma">
    <h1>Uredi izvještaj #<?= $id ?></h1>

    <?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>

    <form method="post" enctype="multipart/form-data">
        <label>Dijete</label>
        <select name="kumce_id" required>
            <?php while ($d = $kumce->fetch_assoc()): ?>
                <option value="<?= $d['id'] ?>"
                    <?= ($d['id']==$report['kumce_id']) ? "selected" : "" ?>>
                    <?= $d['ime']." ".$d['prezime'] ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Kum</label>
        <select name="kum_id" required>
            <?php while ($k = $kumovi->fetch_assoc()): ?>
                <option value="<?= $k['id'] ?>"
                    <?= ($k['id']==$report['kum_id']) ? "selected" : "" ?>>
                    <?= $k['ime']." ".$k['prezime'] ?> (<?= $k['email'] ?>)
                </option>
            <?php endwhile; ?>
        </select>
        
        <label>Slika kumčeta</label>
        <input type="file" name="kumce_slika" accept="image/*">

        <label>Opis</label>
        <textarea name="opis" rows="5"><?= $report['opis'] ?></textarea>

        <label>Škola</label>
        <select name="skola" required>
            <option value="Vrtić" <?= $report['skola'] === 'Vrtić' ? 'selected' : '' ?>>
                Vrtić
            </option>
            <option value="Osnovna škola" <?= $report['skola'] === 'Osnovna škola' ? 'selected' : '' ?>>
                Osnovna škola
            </option>
            <option value="Srednja škola" <?= $report['skola'] === 'Srednja škola' ? 'selected' : '' ?>>
                Srednja škola
            </option>
        </select>

        <label>Ocjena</label>
        <div class="radio-group">
            <label>
                <input type="radio" name="ocjena" value="A" <?= $report['ocjena'] === 'A' ? 'checked' : '' ?>>
                A
            </label>
            <label>
                <input type="radio" name="ocjena" value="B" <?= $report['ocjena'] === 'B' ? 'checked' : '' ?>>
                B
            </label>
            <label>
                <input type="radio" name="ocjena" value="C" <?= $report['ocjena'] === 'C' ? 'checked' : '' ?>>
                C
            </label>
            <label>
                <input type="radio" name="ocjena" value="D" <?= $report['ocjena'] === 'D' ? 'checked' : '' ?>>
                D
            </label>
            <label>
                <input type="radio" name="ocjena" value="E" <?= $report['ocjena'] === 'E' ? 'checked' : '' ?>>
                E
            </label>
            <label>
                <input type="radio" name="ocjena" value="F" <?= $report['ocjena'] === 'F' ? 'checked' : '' ?>>
                F
            </label>
        </div>
        <br>
        <label>Zahvala</label>
        <textarea name="zahvala" rows="4"><?= $report['zahvala'] ?></textarea>

        <label>Status</label>
        <select name="status">
            <option value="draft" <?= $report['status']=='draft' ? 'selected' : '' ?>>Draft</option>
            <option value="gotov" <?= $report['status']=='gotov' ? 'selected' : '' ?>>Gotov</option>
        </select>

        <div class="form-actions">
            <a href="reports.php" class="btn-cancel">Odustani</a>
            <button type="submit" name="spremi" class="btn-save">Spremi izvještaj</button>
        </div>
    </form>
</main>
</body>
</html>
