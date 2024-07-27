<?php
    include_once("telegram.php");
?>

<section>
    <form action="<?= $this->path ?>" method="POST">
        <fieldset class="uk-fieldset">

            <div>
                <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon" uk-icon="user"></span>
                    <input type="text" value="<?= $input['name'] ?>" placeholder="Your Name" class="uk-margin uk-input" aria-label="Name" <?= $formDisabled? 'disabled': '' ?> />
                </div>
            </div>

            <div>
                <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon" uk-icon="mail"></span>
                    <input type="email" value="<?= $input['email'] ?>" placeholder="E-Mail" class="uk-margin uk-input" aria-label="E-Mail" <?= $formDisabled? 'disabled': '' ?> />
                </div>
            </div>

            <div>
                <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon" uk-icon="telegram"></span>
                    <input type="text" value="<?= $input['telegram'] ?>" placeholder="Telegram Handle" class="uk-margin uk-input" aria-label="Telegram Handle" <?= $formDisabled? 'disabled': '' ?>/>
                </div>
            </div>

            <div>
                <textarea class="uk-margin-top uk-width-1-1 uk-textarea" rows="6" placeholder="Message" aria-label="Message" <?= $formDisabled? 'disabled': '' ?>><?= $input['message'] ?></textarea>
            </div>
        </fieldset>
        <button class="uk-button uk-button-default uk-button-primary"><span uk-icon="mail"></span>Go!</button>
    </form>
</section>

<section>
    <?php debug($input) ?>
    <?php debug($this->path) ?>
</section>