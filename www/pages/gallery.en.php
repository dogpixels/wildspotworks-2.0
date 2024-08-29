<section>
    <h1>Fursuits made by Wildspotworks</h1>
    <p>The following Gallery shows some examples of my recent work. Please note that this Gallery also features some body-only commissions which means I did not built every suit entirely. For more information about each suit just take a look at the dedicated page.<p>
    <p>Further I really want to express my gratitude to the suit owners and their photographers of course, for providing me most of those beautiful pictures here!<p>
    <p><strong>Click the Images for more pictures :)</strong></p>

    <div id="gallery" class="uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-4@m" uk-scrollspy="cls: uk-animation-slide-bottom-small; target: article; delay: 50" uk-grid></div>
</section>

<div id="gallery-modal" class="uk-modal-container" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h2 id="gallery-modal-title" class="uk-modal-title"></h2>
        <div id="gallery-modal-text"></div>
        <did id="gallery-modal-images" class="uk-grid-small uk-grid-match uk-child-width-1-6" uk-grid uk-lightbox></div>
    </div>
</div>

<script src="../js/gallery.js"></script>
<script>
    const gallery = new Gallery();
    gallery.build('config/gallery.json');
</script>