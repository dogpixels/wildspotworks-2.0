<section>
    <p>Choose the options that best describe your desired fursuit, and the price calculator will provide an estimate at the bottom of this page. You can then request a non-obligatory quote.</p>
</section>

<div id="calc-options" uk-scrollspy="cls: uk-animation-slide-bottom-small; target: article; delay: 150"></div>

<section>
    <h2>Total: <span id="calc-total">0</span>&euro;</h2>
    <p><strong>Note</strong>: The displayed price is an estimate. The final price will be provided as a quote based on the complexity and details of your order. Continuing and submitting a request does not constitute an agreement to purchase.</p>
    <form action="en/contact" method="POST" id="calc-form">
        <fieldset class="uk-fieldset">
            <div class="uk-margin">
                <label>
                    <input type="checkbox" id="calc-accept" class="uk-checkbox" />
                    I have read and accept the <a href="en/terms" target="_blank">Terms of Service</a> and <a href="en/privacy" target="_blank">Privacy Policy</a>.
                </label>
            </div>
            <div>
                <input type="submit" value="Continue" class="uk-button uk-button-default uk-button-primary" />
            </div>
            <input type="hidden" name="message" />
        </fieldset>
    </form>
</section>

<script>
    function emptySelection() {
        UIkit.modal.alert(
            "You did not select anything, very funny.",
            {i18n: {ok: '🤣'}});
    }

    function confirmTerms() {
        return UIkit.modal.confirm(
            "Please confirm that you have read and accept the <a href=\"en/terms\" target=\"_blank\">Terms of Service</a> and <a href=\"en/privacy\" target=\"_blank\">Privacy Policy</a>.",
            {i18n: {ok: "Accept", cancel: "Decline"}}
        ).then(
            () => {return true},
            () => {return false}
        );
    }
</script>

<script src="js/calculator.min.js"></script>
<script>
    const calc = new Calc(document.getElementById('calc-options'), document.getElementById('calc-total'));
    calc.build('prices.json');
</script>