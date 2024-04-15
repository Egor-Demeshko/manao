<header class="navbar ">
    <a href="/" aria-label="Перейти на главную страницу" class="navbar__link --h-100">
        <img src="/media/manao.svg" alt="Логотип Проекта" class="navbar__logo">
    </a>

    <?php if ($sessionActive) : ?>
        <div class="navbar_navigation --left">
            <a class="navbar__link" href="/secret">Секретная страница</a>
        </div>
    <?php endif; ?>

    <div class="navbar_navigation">
        <?php if ($sessionActive) : ?>
            <span>Привет, <?= $_SESSION["login"] ?></span>
            <a id="logout" class="navbar__link">Logout</a>
        <?php else : ?>
            <a id="login" class="navbar__link">Login</a>
            <a id="register" class="navbar__link">Register</a>
        <?php endif; ?>
    </div>
</header>