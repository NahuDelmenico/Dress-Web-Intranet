

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>error_rusanco</title>
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <?php require_once('layout/links.php')?>
</head>
<body>
    <header>
        <?php require("layout/nav.php") ?>
    </header>
    <main>

        <h1 class="sentimos">Lo sentimos</h1>
        <section id="error">
            <article>
                <figure>
                    <img src="img/error.png"  alt="moto en mantenimiento">
                </figure>
            </article>
            <article id="mensaje">
                <h4>¡Error! Algo salio mal</h4>
                <p>La pagina esta pasando por un mantenimiento o sufrio una caida.</p>
                <p>Por favor intentarlo nuevamente mas tarde y cualquier cosa contactenos al rusancoatencion@rusanco.com.ar, que estaremos para atenderlo</p>
            </article>
        </section>
    </main>
    <footer>
        <?php require_once('layout/footer.php')?>
    </footer>
</body>
</html> 
