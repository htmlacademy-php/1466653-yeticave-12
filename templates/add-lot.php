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

    <form class="form form--add-lot container form--invalid" name="add-lot" action="add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
        <h2>Добавление лота</h2>

        <div class="form__container-two">
            <div class="form__item form__item--invalid"> <!-- form__item--invalid -->
                <label for="lot-name">Наименование <sup>*</sup></label>
                <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота">
                <span class="form__error">Введите наименование лота</span>
            </div>

            <div class="form__item">
                <label for="category">Категория <sup>*</sup></label>
                <select id="category" name="category">
                    <option value="null"> - Выберите из списка - </option>
                    <?php foreach($categories as $category => $value): ?>
                    <option value="<?= html_sc($value["id"]); ?>"><?= html_sc($value["title"]); ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="form__error">Выберите категорию</span>
            </div>
        </div>

        <div class="form__item form__item--wide">
            <label for="message">Описание <sup>*</sup></label>
            <textarea id="message" name="description" placeholder="Напишите описание лота"></textarea>
            <span class="form__error">Напишите описание лота</span>
        </div>

        <div class="form__item form__item--file">
            <label>Изображение <sup>*</sup></label>
            <div class="form__input-file">
                <input class="visually-hidden" name="lot-img" type="file" id="lot-img" value="">
                <label for="lot-img">
                    Добавить
                </label>
            </div>
        </div>
        <div class="form__container-three">
            <div class="form__item form__item--small">
                <label for="start-price">Начальная цена <sup>*</sup></label>
                <input id="start-price" type="text" name="start-price" placeholder="0">
                <span class="form__error">Введите начальную цену</span>
            </div>
            <div class="form__item form__item--small">
                <label for="bid-step">Шаг ставки <sup>*</sup></label>
                <input id="bid-step" type="text" name="bid-step" placeholder="0">
                <span class="form__error">Введите шаг ставки</span>
            </div>
            <div class="form__item">
                <label for="date-expire">Дата окончания торгов <sup>*</sup></label>
                <input class="form__input-date" id="date-expire" type="text" name="date-expire" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
                <span class="form__error">Введите дату завершения торгов</span>
            </div>
        </div>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <button type="submit" class="button">Добавить лот</button>
    </form>
</main>