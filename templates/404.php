<main class="container">
    <nav class="nav">
        <ul class="nav__list container">
        <?php foreach($categories as $category => $value): ?>
            <li class="nav__item">
                <a href="all-lots.html"><?= html_sc($value["title"]); ?></a>
            </li>
        <?php endforeach; ?>
        </ul>
    </nav>

    <section class="lot-item container">
        <h2><?= html_sc($error_message); ?></h2>
        <p>Данной страницы не существует на сайте.</p>
    </section>
</main>
