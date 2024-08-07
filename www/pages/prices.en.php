<div id="calc-options"></div>

<section>
    <h2>Total: <span id="calc-total">0</span>&euro;</h2>
    <p><strong>Note</strong>: The displayed price is an estimate. The final price will be provided as a quote based on the complexity and details of your order. Continuing and submitting a request does not constitute an agreement to purchase.</p>
    <form action="en/contact" method="POST">
        <fieldset class="uk-fieldset">
            <div>
                <label>
                    <input type="checkbox" id="calc-accept" class="uk-checkbox" />
                    I have read and accept the <a href="en/terms">Terms of Service</a> and <a href="en/privacy">Privacy Policy</a>.
                </label>
            </div>
            <div>
                <input type="submit" id="calc-submit" value="Submit" class="uk-button uk-button-default uk-button-primary uk-margin" />
            </div>
            <input type="hidden" name="message" />
        </fieldset>
    </form>
    
</section>

<script src="js/price-calculator.js"></script>
<script>
    const calc = new Calc(document.getElementById('calc-options'), document.getElementById('calc-total'));
    calc.build('prices.json');
</script>