<section>
    <h1>Preisrechner</h1>
    <p>Dieses Werkzeug ermöglicht dir einzuschätzen, was dein individueller Wunsch-Fursuit in etwa kosten wird. Am unteren Ende bekommst du einen geschätzten Gesamtpreis und die Möglichkeit, auf dieser Basis einen kostenfreien Kostenvoranschlag anzufordern.</p>
</section>

<div id="calc-options" uk-scrollspy="cls: uk-animation-slide-bottom-small; target: article; delay: 150"></div>

<section>
    <h2>Gesamt: <span id="calc-total">0</span>&euro;</h2>
    <p><strong>Hinweis</strong>: Der angezeigte Preis ist ein Schätzwert. Der entgültige Preis wird in einem verbindlichen Kostenvoranschlag basierend auf der Komplexität und Details der Bestellung mitgeteilt. Das Fortfahren und Anfragen eines Kostenvoranschlags stellt kein verbindliches Kaufangebot dar.</p>
    <form action="de/contact" method="POST" id="calc-form">
        <fieldset class="uk-fieldset">
            <div class="uk-margin">
                <label>
                    <input type="checkbox" id="calc-accept" class="uk-checkbox" />
                    Ich habe die <a href="de/terms" target="_blank">AGB</a> und <a href="de/privacy" target="_blank">Datenschutzerklärung gelesen und akzeptiert</a>.
                </label>
            </div>
            <div>
                <input type="submit" value="Fortfahren" class="uk-button uk-button-default uk-button-primary" />
            </div>
            <input type="hidden" name="message" />
        </fieldset>
    </form>
</section>

<script>
    function emptySelection() {
        UIkit.modal.alert(
            "Du hast überhaupt nichts ausgewählt. Sehr witzig.",
            {i18n: {ok: '🤣'}});
    }

    function confirmTerms() {
        return UIkit.modal.confirm(
            "Bitte bestätige, dass du die <a href=\"de/terms\" target=\"_blank\">AGB</a> und <a href=\"de/privacy\" target=\"_blank\">Datenschutzerklärtung</a> gelesen und akzeptiert hast.",
            {i18n: {ok: "Akzeptieren", cancel: "Ablehnen"}}
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