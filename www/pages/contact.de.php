<?php include_once("telegram.php"); ?>

<section>
    <h1>Nachricht Schreiben</h1>

    <p>
        <strong>Hinweis:</strong> Es kann manchmal etwas dauern, bis ich antworte, aber ich antworte auf jeden Fall. Falls du innerhalb von drei Tagen keine Antwort erhalten hast, versuche es auf einem anderen Weg, z.B. über <a href="https://twitter.com/LunoWroo/" target="_blank">Twitter</a>.
    </p>

    <form action="<?= $this->path ?>" method="POST">
        <fieldset class="uk-fieldset">
            <div>
                <div class="uk-inline uk-margin uk-width-1-1">
                    <span class="uk-form-icon" uk-icon="user"></span>
                    <input type="text" name="name" value="<?= $input['name'] ?>" placeholder="Dein Name" class="uk-input<?= isset($errors['name'])? ' uk-form-danger' : '' ?>" aria-label="Dein Name" <?= $success? 'disabled': '' ?> />
                </div>
            </div>
            <div>
                <div class="uk-inline uk-margin uk-width-1-1">
                    <span class="uk-form-icon" uk-icon="mail"></span>
                    <input type="email" name="email" value="<?= $input['email'] ?>" placeholder="Deine E-Mail-Adresse" class="uk-input<?= isset($errors['contact'])? ' uk-form-danger' : '' ?>" aria-label="Deine E-Mail-Adresse" <?= $success? 'disabled': '' ?> />
                </div>
            </div>
            <div>
                <div class="uk-inline uk-margin uk-width-1-1">
                    <span class="uk-form-icon" uk-icon="telegram"></span>
                    <input type="text" name="telegram" value="<?= $input['telegram'] ?>" placeholder="Dein Telegram" class="uk-input<?= isset($errors['contact'])? ' uk-form-danger' : '' ?>" aria-label="Dein Telegram-Handle" <?= $success? 'disabled': '' ?> />
                </div>
            </div>
            <div>
                <textarea name="message" class="uk-textarea uk-margin uk-width-1-1<?= isset($errors['message'])? ' uk-form-danger' : '' ?>" rows="6" placeholder="Deine Nachricht" aria-label="Deine Nachricht" <?= $success? 'disabled': '' ?>><?= $input['message'] ?></textarea>
            </div>
        </fieldset>
        <input type="submit" value="<?= $success? '✅ Nachricht zugestellt': 'Absenden' ?>" class="uk-button uk-button-default uk-button-primary" <?= $success? 'disabled': '' ?> />
    </form>

    <?php if (!empty($_POST) && $success) { ?>
        <div class="uk-alert-success" uk-alert><p>Danke, deine Nachricht wurde erhalten. Ich melde mich schnellstmöglich zurück!</p></div>
    <?php } ?>
    
    <?php if (!empty($_POST) && !$success && empty($errors)) { ?>
        <div class="uk-alert-danger" uk-alert><p>Tut mir Leid, ein Fehler ist aufgetreten. Wenn es in ein Paar Minuten nicht geht, sag bitte über wildspotworks@gmail.com Bescheid!</p><p>Fehler-Details:</p><pre><?= json_encode(json_decode($response), JSON_PRETTY_PRINT) ?></pre></div>
    <?php } ?>
</section>
