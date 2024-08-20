class Gallery {
    #data = undefined;
    #lang = 'en';
    #modal = undefined;
    #modalTitle = undefined;
    #modalBody = undefined;

    constructor() {
        this.#lang = document.documentElement.lang;
        this.#modal = document.getElementById('gallery-modal');
        this.#modalTitle = document.getElementById('gallery-modal-title');
        this.#modalBody = document.getElementById('gallery-modal-body');
    }

    async build(dataFile) {
        this.#data = await this.#fetch(dataFile);
        for (const [id, fursuit] of Object.entries(this.#data)) {
            console.log(id);
            let div = document.createElement('div');
            div.setAttribute('id', id);
            div.classList.add('entry');
            document.getElementById('gallery-list').appendChild(div);

            const img = document.createElement('img');
            img.src = `${fursuit.directory}/${fursuit.thumb}`;
            img.alt = fursuit.thumb;
            div.appendChild(img);

            const h3 = document.createElement('h3');
            h3.innerText = fursuit.title[this.#lang];
            div.appendChild(h3);

            // add event handler
            div.addEventListener('click', () => { this.#openModal(id) });
        }
    }

    async #openModal(id) {
        if (!(id in this.#data))
            return;

        const fursuit = this.#data[id];

        this.#modalBody.innerHTML = fursuit.description[this.#lang];
        this.#modalTitle.innerText = fursuit.title[this.#lang];

        const files = await this.#fetch(`img/gallery/${fursuit.directory}`);

        files.forEach(file => {
            const img = document.createElement('img');
            img.src = `${fursuit.directory}/${file}`;
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
gallery.build('gallery.json');
