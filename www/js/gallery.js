class Gallery {
    #data = undefined;
    #modal = undefined;
    #modalTitle = undefined;
    #modalBody = undefined;

    constructor() {
        this.#data = this.#fetch('gallery.json');
        this.#modal = document.getElementById('gallery-modal');
        this.#modalTitle = document.getElementById('gallery-modal-title');
        this.#modalBody = document.getElementById('gallery-modal-content');
    }

    async build() {
        for (const [id, fursuit] of Object.entries(this.#data)) {
            let div = document.createElement('div');
            div.setAttribute('id', id);
            div.classList.add('entry');
            document.getElementById('gallery-list').appendChild(div);

            const img = document.createElement('img');
            img.src = `${fursuit.images}/${fursuit.thumb}`;
            img.alt = fursuit.thumb;
            div.appendChild(img);

            const h3 = document.createElement('h3');
            h3.innerText = fursuit.title;
            div.appendChild(h3);

            // add event handler
            div.addEventListener('click', () => { this.#openModal(id) });
        }
    }

    async #openModal(id) {
        if (!(id in this.#data))
            return;

        const fursuit = this.#data[id];

        this.#modalBody.innerHTML = '';
        this.#modalTitle.innerText = fursuit.title;

        const files = await (await fetch(fursuit.images)).json();

        files.forEach(file => {
            const img = document.createElement('img');
            img.src = `${fursuit.images}/${file}`;
            this.#modalBody.appendChild(img);
        });

        window.location.hash = id;
        UIkit.modal(this.#modal).show();
    }

    async #fetch(url) {
        // url += `?${Date.now()}`;
        var data = null;
        try {
            data = await (await fetch(url)).json();
            if (!data) {
                console.error("[gallery] malformed data loaded:", data);
                throw "malformed data";
            }
        }
        catch(ex) {
            console.error(`[gallery] failed to load ${url}, reason: ${ex}`);
            return;
        }
        return data;
    }
}

gallery = new Gallery();
gallery.build();
