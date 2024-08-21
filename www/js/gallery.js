class Gallery {
    #config = {
        basePath: 'img/gallery',
        lazyLoading: true
    }
    #lang = 'en';
    #data = undefined;
    #modal = undefined;
    #modalTitle = undefined;
    #modalText = undefined;
    #modalImages = undefined;
    #galleryGrid = undefined;

    constructor() {
        this.#lang = document.documentElement.lang;
        this.#galleryGrid = document.getElementById('gallery');
        this.#modal = document.getElementById('gallery-modal');
        this.#modalTitle = document.getElementById('gallery-modal-title');
        this.#modalText = document.getElementById('gallery-modal-text');
        this.#modalImages = document.getElementById('gallery-modal-images');

        UIkit.util.on(this.#modal, 'hidden', () => {
            console.log('Modal is hidden');
            window.location.hash = '';
        });
    }

    async build(dataFile) {
        this.#data = await this.#fetch(dataFile);
        for (const [id, fursuit] of Object.entries(this.#data)) {
            const div = document.createElement('div');
            div.setAttribute('id', id);
            div.classList.add('entry');
            this.#galleryGrid.appendChild(div);

            const article = document.createElement('article');
            if (this.#config.lazyLoading) {
                article.setAttribute('uk-img', '');
                article.setAttribute('data-src', `${this.#config.basePath}/${fursuit.thumb}`)
            }
            else {
                article.style.backgroundImage = `url('${this.#config.basePath}/${fursuit.thumb}')`;
            }
            article.addEventListener('click', () => { this.#openModal(id) });
            div.appendChild(article);

            const h3 = document.createElement('h3');
            h3.innerText = fursuit.title[this.#lang];
            article.appendChild(h3);
        }

        if (window.location.hash) {
            this.#openModal(window.location.hash.substring(1));
        }
    }

    async #openModal(id) {
        if (!(id in this.#data))
            return;

        const fursuit = this.#data[id];

        this.#modalText.innerHTML = fursuit.description[this.#lang];
        this.#modalTitle.innerText = fursuit.title[this.#lang];
        this.#modalImages.innerHTML = '';

        const files = await this.#fetch(`${this.#config.basePath}/${fursuit.directory}`);

        files.forEach(file => {
            const filePath = `${this.#config.basePath}/${fursuit.directory}/${file}`;
            const a = document.createElement('a');
            a.href = filePath;
            this.#modalImages.appendChild(a);

            const article = document.createElement('article');
            if (this.#config.lazyLoading) {
                article.setAttribute('uk-img', '');
                article.setAttribute('data-src', filePath)
            }
            else {
                article.style.backgroundImage = `url('${filePath}')`;
            }
            a.appendChild(article);
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
