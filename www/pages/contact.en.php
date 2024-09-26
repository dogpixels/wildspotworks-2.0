<?php include_once("src/telegram.php"); ?>

<section uk-scrollspy="cls: uk-animation-slide-left-small; target: div; delay: 120">
    <h1>Send Message</h1>

    <div>
        <p><strong>Note:</strong> Please provide at least one way to reach you back, either eMail and/or Telegram.<br />It make take a while for me to reply, but I will definitely do so. If you haven't received an answer within three days, please try again or contact me via other means, e.g. <a href="https://twitter.com/LunoWroo/" target="_blank">Twitter</a>.</p>
    </div>

    <form action="<?= $this->path ?>" method="POST" id="contact-form">
        <fieldset class="uk-fieldset">
            <div>
                <div class="uk-inline uk-width-1-1">
                    <span class="uk-form-icon" uk-icon="user"></span>
                    <input type="text" name="name" value="<?= $input['name'] ?>" placeholder="Your Name" class="uk-input" aria-label="Your Name" />
                </div>
            </div>
            <div class="uk-child-width-1-2@m uk-margin" uk-grid>
                <div>
                    <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon" uk-icon="mail"></span>
                        <input type="email" name="email" value="<?= $input['email'] ?>" placeholder="E-Mail" class="uk-input" aria-label="Your E-Mail" />
                    </div>
                </div>
                <div>
                    <div class="uk-inline uk-width-1-1">
                        <span class="uk-form-icon" uk-icon="telegram"></span>
                        <input type="text" name="telegram" value="<?= $input['telegram'] ?>" placeholder="Telegram" class="uk-input" aria-label="Your Telegram Handle" />
                    </div>
                </div>
            </div>
            <div>
                <textarea name="message" class="uk-textarea uk-margin uk-width-1-1" rows="9" placeholder="Your Message" aria-label="Your Message"><?= $input['message'] ?></textarea>
            </div>
        </fieldset>
        <div uk-grid>
            <div>
                <label for="botchk_res" class="uk-card uk-card-default uk-card-small uk-button" style="line-height: 36px; padding: 0 0 0 10px">
                    <input type="hidden" name="botchk_opl" value="<?= $botchk_opl ?>" />
                    <input type="hidden" name="botchk_op"  value="<?= $botchk_op ?>"  />
                    <input type="hidden" name="botchk_opr" value="<?= $botchk_opr ?>" />
                    <span uk-icon="happy" class="uk-icon-lift"></span>
                    Bot Check: <?= $botchk_opl ?> <?= $botchk_op ?> <?= $botchk_opr ?> =
                    <input type="text" name="botchk_res" id="botchk_res" class="uk-input uk-form-width-xsmall" inputmode="numeric" placeholder="?" />
                </label>
            </div>
            <div>
                <input type="submit" value="Submit" class="uk-button uk-button-default uk-button-primary" />
            </div>
        </div>
    </form>

    <?php if (isset($_GET['success']) && $_GET['success'] == true) { ?>
        <div class="uk-alert-success" uk-alert><p>Thank you, your message was received. I will try to get back to you soon!</p></div>
    <?php } ?>

    <?php if (!empty($_POST) && empty($errors)) { ?>
        <div class="uk-alert-danger" uk-alert><p>Sorry, an error occurred. Should it persist, please notify me via wildspotworks@gmail.com!</p><p>Error details:</p><pre><?= json_encode(json_decode($response), JSON_PRETTY_PRINT) ?></pre></div>
    <?php } ?>
</section>

<script>
    document.getElementById('contact-form').addEventListener('submit', (event) => {
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

        // validate Bot Check
        switch (event.target.querySelector('input[name="botchk_op"]').value) {
            case '+':
                if (event.target.querySelector('input[name="botchk_opl"]').value + event.target.querySelector('input[name="botchk_opr"]').value != event.target.querySelector('input[name="botchk_res"]').value) {
                    UIkit.notification("<span uk-icon='warning'></span> Bot Check math doesn't check out, try again.", {status: 'danger', pos: 'top-right'});
                    event.preventDefault();
                };
                break;
            case '-':
                if (event.target.querySelector('input[name="botchk_opl"]').value - event.target.querySelector('input[name="botchk_opr"]').value != event.target.querySelector('input[name="botchk_res"]').value) {
                    UIkit.notification("<span uk-icon='warning'></span> Bot Check math doesn't check out, try again.", {status: 'danger', pos: 'top-right'});
                    event.preventDefault();
                };
                break;
        }
    })
</script>
