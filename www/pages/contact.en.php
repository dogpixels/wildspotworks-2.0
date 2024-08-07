<?php include_once("telegram.php"); ?>

<section uk-scrollspy="cls: uk-animation-slide-left-small; target: div; delay: 120">
    <h1>Send Message</h1>

    <div>
        <p><strong>Please note:</strong> It make take a while for me to reply, but I will definitely do so. If you haven't received an answer within three days, please try again or contact me via other means, e.g. <a href="https://twitter.com/LunoWroo/" target="_blank">Twitter</a>.</p>
    </div>

    <form action="<?= $this->path ?>" method="POST">
        <fieldset class="uk-fieldset">
            <div>
                <div class="uk-inline uk-margin uk-width-1-1">
                    <span class="uk-form-icon" uk-icon="user"></span>
                    <input type="text" name="name" value="<?= $input['name'] ?>" placeholder="Your Name" class="uk-input<?= isset($errors['name'])? ' uk-form-danger' : '' ?>" aria-label="Your Name" <?= $success? 'disabled': '' ?> />
                </div>
            </div>
            <div>
                <div class="uk-inline uk-margin uk-width-1-1">
                    <span class="uk-form-icon" uk-icon="mail"></span>
                    <input type="email" name="email" value="<?= $input['email'] ?>" placeholder="E-Mail" class="uk-input<?= isset($errors['contact'])? ' uk-form-danger' : '' ?>" aria-label="Your E-Mail" <?= $success? 'disabled': '' ?> />
                </div>
            </div>
            <div>
                <div class="uk-inline uk-margin uk-width-1-1">
                    <span class="uk-form-icon" uk-icon="telegram"></span>
                    <input type="text" name="telegram" value="<?= $input['telegram'] ?>" placeholder="Telegram" class="uk-input<?= isset($errors['contact'])? ' uk-form-danger' : '' ?>" aria-label="Your Telegram Handle" <?= $success? 'disabled': '' ?> />
                </div>
            </div>
            <div>
                <textarea name="message" class="uk-textarea uk-margin uk-width-1-1<?= isset($errors['message'])? ' uk-form-danger' : '' ?>" rows="9" placeholder="Your Message" aria-label="Your Message" <?= $success? 'disabled': '' ?>><?= $input['message'] ?></textarea>
            </div>
        </fieldset>
        <div>
            <input type="submit" id="telegram-submit" value="<?= $success? '✅ message delivered': 'Submit' ?>" class="uk-button uk-button-default uk-button-primary" <?= $success? 'disabled': '' ?> />
        </div>
    </form>

    <?php if (!empty($_POST) && $success) { ?>
        <div class="uk-alert-success" uk-alert><p>Thank you, your message was received. I will try to get back to you soon!</p></div>
    <?php } ?>

    <?php if (!empty($_POST) && !$success && empty($errors)) { ?>
        <div class="uk-alert-danger" uk-alert><p>Sorry, an error occurred. Should it persist, please notify me via wildspotworks@gmail.com!</p><p>Error details:</p><pre><?= json_encode(json_decode($response), JSON_PRETTY_PRINT) ?></pre></div>
    <?php } ?>
</section>

<script>
    document.getElementById('telegram-submit').addEventListener('click', (event) => {
        // validate name
        if (event.target.querySelector('input[name="name"]').value.length === 0) {
            UIkit.notification("<span uk-icon='icon: warning'></span> Please enter your name.", {status: 'danger', pos: 'top-right'});
            event.preventDefault();
        }

        // validate email || telegram
        if (
            event.target.querySelector('input[name="email"]').value.length === 0 &&
            event.target.querySelector('input[name="telegram"]').value.length === 0
        ) {
            UIkit.notification("<span uk-icon='icon: warning'></span> Please enter at least one way to contact you, e-mail or telegram.", {status: 'danger', pos: 'top-right'});
            event.preventDefault();
        }

        // validate message
        if (event.target.querySelector('textarea[name="message"]').value.length < 8) {
            UIkit.notification("<span uk-icon='warning'></span> Your message seems too short.", {status: 'danger', pos: 'top-right'});
            event.preventDefault();
        }
    })
</script>
