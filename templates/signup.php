<main>
    <nav class="nav">
        <ul class="nav__list container">
        <?php foreach($categories as $category => $value): ?>
        <li class="nav__item">
            <a href="all-lots.html"> <?= html_sc($value["title"]); ?></a>
        </li>
        <?php endforeach; ?>
        </ul>
    </nav>

    <?php if(isset($_SESSION['user_id'])): ?>
    <div class="container">
        <p>
            <b><?= $user_name;?></b>, вы уже зарегистрированы на сайте. Хотите
            <a href="#">сменить аккаунт?</a>
        </p>
    </div>

    <?php else:?>
    <form class="form container <?php if (count($errors) > 0):?> form--invalid<?php endif; ?>" action="signup.php" method="post" autocomplete="off">
        <h2><?= html_sc($page_name); ?></h2>

        <div class="form__item <?php if (isset($errors["email"])):?> form__item--invalid<?php endif; ?>">
            <label for="email">E-mail <sup>*</sup></label>
            <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= html_sc(isset($user["email"]) ? $user["email"] : "");?>">
            <span class="form__error"><?= html_sc($errors["email"] ?? ""); ?></span>
        </div>

        <div class="form__item <?php if (isset($errors["password"])):?> form__item--invalid<?php endif; ?>">
            <label for="password">Пароль <sup>*</sup></label>
            <input id="password" type="password" name="password" placeholder="Введите пароль">
            <span class="form__error"><?= html_sc($errors["password"] ?? ""); ?></span>
        </div>

        <div class="form__item <?php if (isset($errors["name"])):?> form__item--invalid<?php endif; ?>">
            <label for="name">Имя <sup>*</sup></label>
            <input id="name" type="text" name="name" placeholder="Введите имя" value="<?= html_sc(isset($user["name"]) ? $user["name"] : ""); ?>">
            <span class="form__error"><?= html_sc($errors["name"] ?? ""); ?></span>
        </div>

        <div class="form__item <?php if (isset($errors["message"])):?> form__item--invalid <?php endif; ?>">
            <label for="message">Контактные данные <sup>*</sup></label>
            <textarea id="message" name="message" placeholder="Напишите как с вами связаться"><?= html_sc(isset($user["message"]) ? $user["message"] : ""); ?></textarea>
            <span class="form__error"><?= html_sc($errors["message"] ?? ""); ?></span>
        </div>

        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>

        <button type="submit" class="button">Зарегистрироваться</button>

        <a class="text-link" href="login.php">Уже есть аккаунт</a>
    </form>
    <?php endif;?>
</main>
