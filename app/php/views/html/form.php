<form class="login_form">
    <div class="login_form__inputs">

        <?php foreach ($fields as $name => $data) : ?>
            <div class="login_form__input">
                <label for="<?= $name ?>"><?= $data['text'] ?></label>
                <input type="<?= $data['type'] ?>" name="<?= $name ?>" id="<?= $name ?>" required>
            </div>
        <?php endforeach; ?>

    </div>
    <div class="login_form__buttons">
        <button class="login_form__back_button">Назад</button>
        <button class="login_form__login_button"><?= $buttonText ?></button>
    </div>
</form>