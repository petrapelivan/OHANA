<?php
require_once "../config.php";
include 'nav-admin.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$kumce = $conn->query("SELECT id, ime, prezime FROM kumce");

if (isset($_POST['spremi'])) {

    $kumce_id = $_POST['kumce_id'];
    $kum_id = $_POST['kum_id'];
    $opis = $_POST['opis'];
    $skola = $_POST['skola'];
    $ocjena = $_POST['ocjena'];
    $zahvala = $_POST['zahvala'];
    $status = $_POST['status'];
    
    $ime_slike = null;
    if (!empty($_FILES['kumce_slika']['name'])) {

        $dozvoljeni_tipovi = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($_FILES['kumce_slika']['type'], $dozvoljeni_tipovi)) {
            $error = "Dozvoljene su samo JPG i PNG slike.";
        } else {

            $ext = pathinfo($_FILES['kumce_slika']['name'], PATHINFO_EXTENSION);
            $ime_slike = "kumce_" . $kumce_id . "_" . time() . "." . $ext;

            move_uploaded_file(
                $_FILES['kumce_slika']['tmp_name'],
                "../uploads/kumce/" . $ime_slike
            );
        }
    }

    $provjera = $conn->prepare("
        SELECT COUNT(*) AS broj
        FROM kumstvo
        WHERE kum_id = ? AND kumce_id = ?
    ");

    $provjera->bind_param("ii", $kum_id, $kumce_id);
    $provjera->execute();
    $rez = $provjera->get_result()->fetch_assoc();

    if ($rez['broj'] == 0) {
        $error = "Greška: odabrani kum nije povezan s odabranim djetetom.";
    } else {

        $sql = "INSERT INTO izvjestaji 
            (kumce_id, kum_id, opis, skola, ocjena, zahvala, status, datum)
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "iisssss",
            $kumce_id,
            $kum_id,
            $opis,
            $skola,
            $ocjena,
            $zahvala,
            $status
        );

        if ($stmt->execute()) {
            if ($ime_slike !== null) {
                $up = $conn->prepare("UPDATE kumce SET kumce_slika = ? WHERE id = ?");
                $up->bind_param("si", $ime_slike, $kumce_id);
                $up->execute();
            }

            header("Location: reports.php");
            exit();
        } else {
            $error = "Greška pri spremanju izvještaja.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <title>Dodaj izvještaj</title>
    <link rel="stylesheet" href="admin-css.css">
</head>
<body>

<main class="forma">

<h1>Dodavanje izvještaja</h1>

<?php if (!empty($error)): ?>
    <p style="color:red;font-weight:bold;"><?= $error ?></p>
<?php endif; ?>

<form method="post" enctype="multipart/form-data">

    <label>Dijete</label>
    <select id="kumce_id" name="kumce_id" required>
        <option value="">-- Odaberi dijete --</option>
        <?php while ($d = $kumce->fetch_assoc()): ?>
            <option value="<?= $d['id']; ?>">
                <?= $d['ime'] . " " . $d['prezime']; ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label>Kum (email)</label>
    <select id="kum_id" name="kum_id" required>
        <option value="">-- Prvo odaberi dijete --</option>
    </select>

    <label>Slika kumčeta</label>
    <input type="file" name="kumce_slika" accept="image/*">

    <label>Opis (kako se dijete osjeća)</label>
    <textarea name="opis" rows="5" required></textarea>

    <label>Škola</label>
    <select name="skola" required>
        <option value="">-- Odaberi školu --</option>
        <option value="Vrtić">Vrtić</option>
        <option value="Osnovna škola">Osnovna škola</option>
        <option value="Srednja škola">Srednja škola</option>
    </select>

    <label>Ocjena</label>
    <div class="radio-group">
        <label><input type="radio" name="ocjena" value="A" required> A</label>
        <label><input type="radio" name="ocjena" value="B"> B</label>
        <label><input type="radio" name="ocjena" value="C"> C</label>
        <label><input type="radio" name="ocjena" value="D"> D</label>
        <label><input type="radio" name="ocjena" value="E"> E</label>
        <label><input type="radio" name="ocjena" value="F"> F</label>
    </div>
    <br>
    <label>Zahvala kumu</label>
    <textarea name="zahvala" rows="4"></textarea>

    <label>Status izvještaja</label>
    <select name="status">
        <option value="draft">Draft</option>
        <option value="gotov">Gotov</option>
    </select>

    <br><br>
    <div class="form-actions">
        <a href="reports.php" class="btn-cancel">Odustani</a>
        <button type="submit" name="spremi" class="btn-save">Spremi izvještaj</button>
    </div>

</form>

</main>

<script>
document.getElementById("kumce_id").addEventListener("change", function(){
    const kumceId = this.value;

    fetch("get-kumovi.php?kumce_id=" + kumceId)
        .then(res => res.json())
        .then(data => {
            const kumSelect = document.getElementById("kum_id");
            kumSelect.innerHTML = "";

            if (data.length === 0) {
                kumSelect.innerHTML = "<option value=''>Nema kuma za ovo dijete.</option>";
                return;
            }

            data.forEach(kum => {
                const opt = document.createElement("option");
                opt.value = kum.id;
                opt.text = kum.ime + " " + kum.prezime + " (" + kum.email + ")";
                kumSelect.appendChild(opt);
            });
        });
});
</script>

</body>
</html>
