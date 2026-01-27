<?php include 'nav.php'; ?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <link rel="stylesheet" href="style.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="description" content="Kontaktirajte udrugu za pomoć djeci u sirotištima i domovima za nezbrinutu djecu">
    <meta name="keywords" content="kontakt, udruga, volonteri, kumstvo, Samobor">
    <meta name="author" content="TVZ studenti">

    <meta property="og:title" content="Kontakt – Udruga za pomoć djeci">
    <meta property="og:type" content="website">
    <meta property="og:description" content="Kontakt informacije i obrazac za javljanje udruzi">
    
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">

    <title>Kontakt</title>
</head>

<body>
<header>
    <div class="hero-image" style="background-image: url('img/naslovna.png');">
        <h1>Kontakt</h1>
    </div>

</header>

<main>
    <h1>Kontakt</h1>

    <p>
        Slobodno nam se obratite za sva pitanja vezana uz volonterstvo,
        kumstvo ili rad udruge. Rado ćemo vam odgovoriti u najkraćem mogućem roku.
    </p>

    <h2>Sjedište udruge</h2>
    <p>
        Ulica Milana Langa<br>
        10430 Samobor<br>
        Hrvatska
    </p>

    <div id="contact">


        <h2>Kontakt obrazac</h2>

        <form action="#" method="POST" id="contact_form">
            <label for="fname">Ime *</label>
            <input type="text" id="fname" name="firstname" placeholder="Vaše ime" required>

            <label for="lname">Prezime *</label>
            <input type="text" id="lname" name="lastname" placeholder="Vaše prezime" required>

            <label for="email">E-mail *</label>
            <input type="email" id="email" name="email" placeholder="Vaša e-mail adresa" required>

            <label for="subject">Poruka</label>
            <textarea id="subject" name="subject" placeholder="Napišite svoju poruku..." style="height:200px"></textarea>

            <input type="submit" value="Pošalji">
        </form> 
        <br><br>
        <h2>Pronađi nas na karti!</h2>
        <iframe 
            src="https://www.google.com/maps?q=Ulica%20Milana%20Langa,%20Samobor&output=embed"
            width="100%" 
            height="400" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>


    </div>
</main>

<footer>
    <p>&copy; 2026 OHANA. All Rights Reserved.</p>
</footer>

</body>
</html>
