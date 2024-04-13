<form class="login_form">
    <div class="login_form__inputs">

        <?php foreach ($fields as $name => $data) : ?>
            <div class="login_form__input">
                <label for="<?= $data["id"] ?? "" ?>"><?= $data['text'] ?></label>
                <input type="<?= $data['type'] ?>" name="<?= $name ?>" id="<?= $data["id"] ?? "" ?>" required="<?= $data["required"] ?? false ?>">
            </div>
        <?php endforeach; ?>

    </div>
    <div class="login_form__buttons">
        <button class="login_form__back_button">Назад</button>
        <button class="login_form__login_button"><?= $buttonText ?></button>
    </div>
</form>