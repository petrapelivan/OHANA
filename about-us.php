<?php include 'nav.php'; ?>
<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O nama - Udruga za djecu Ohana</title>
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="hero-image" style="background-image: url('img/naslovna.png');">
        <h1>O nama</h1>
    </div>

</header>

<main>
    <div class="about-row" style="padding: 2em; background-color: #fdf6f0;">
        <div class="about-left">
            <?php include 'includes/weather.php'; ?>
        </div>

        <div class="about-right">
            <h2>Naša misija</h2>
            <p>
                Udruga OHANA osnovana je s ciljem pružanja sigurnog doma, emocionalne podrške i 
                boljih životnih uvjeta djeci bez odgovarajuće roditeljske skrbi. 
                Naziv <strong>OHANA</strong> dolazi iz havajskog jezika i znači „obitelj“, a simbolizira zajedništvo, 
                brigu i pripadnost. Vrijednosti koje svakodnevno nastojimo pružiti svakom djetetu u našem sirotištu.
                Naša misija je podržati djecu i obitelji u Tanzaniji kroz
                edukaciju, zdravstvenu skrb i emocionalnu podršku.
                Povezujemo kumove s kumčadima kako bi im pružili stabilnost
                i nadu za bolju budućnost.
            </p>
            <p>
                Kroz projekte i radionice želimo stvarati zajednicu koja se
                brine i dijeli ljubav. Hvala vam što ste dio naše priče.
            </p>
        </div>
    </div>

    <section style="padding: 2em; background-color: #fdf6f0;">
        <h2 style="padding-left: 16px;">Naša priča</h2>
        <p>Udruga je osnovana 2015. godine, s ciljem da postane podrška djeci bez roditeljske skrbi. Kroz godine, naši volonteri su stvorili sigurno i toplo okruženje za djecu, organizirali radionice, humanitarne događaje, kulturne i edukativne aktivnosti.</p>
        <p>Naši projekti uključuju izradu izvještaja za kumove, radionice kreativnog izražavanja, edukaciju i mnoge druge inicijative koje osnažuju djecu i zajednicu.</p>
    </section>

    <section style="padding: 2em; max-width: 900px; margin: 0 auto;">
        <h2>Naš tim</h2>
        <div style="display: flex; flex-wrap: wrap; gap: 1em;">
            <div style="flex: 1 1 200px; text-align: center;">
                <img src="img/aboutus/v1.jpg" alt="Volonter 1" style="width:100%; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                <p><strong>Ivan Horvat</strong><br>Voditelj projekta</p>
            </div>
            <div style="flex: 1 1 200px; text-align: center;">
                <img src="img/aboutus/v2.jpg" alt="Volonter 2" style="width:100%; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                <p><strong>Marija Kovač</strong><br>Koordinatorica volontera</p>
            </div>
            <div style="flex: 1 1 200px; text-align: center;">
                <img src="img/aboutus/v3.jpg" alt="Volonter 3" style="width:100%; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.2);">
                <p><strong>Petra Novak</strong><br>Logistika i komunikacija</p>
            </div>
        </div>
    </section>

    <section style="padding: 2em; text-align:center; background-color:#e6d3c0; border-radius: 8px; margin: 2em;">
        <h2>Postani dio naše priče!</h2>
        <p>Pridruži nam se kao volonter ili donator i pomozi djeci da imaju sretno i sigurno djetinjstvo.</p>
        <a href="contact.php" style="display:inline-block; background-color:#7a4f3e; color:#fff; padding: 12px 24px; border-radius:6px; text-decoration:none;">Pridruži se</a>
    </section>
</main>

<footer>
    <p>&copy; 2026 OHANA. All Rights Reserved.</p>
</footer>

</body>
</html>

