class Calc {
    data = {};
    selection = {};
    lang = 'en';

    targetContainer = null;
    totalContainer = null;

    constructor(targetContainer, totalContainer) {
        this.targetContainer = targetContainer;
        this.totalContainer = totalContainer;
        this.lang = document.documentElement.lang;
        document.getElementById('calc-form').addEventListener('submit', async (event) => {
            let msg = this.data.strings.message[this.lang];
            msg = msg.replace('{selection}', this.getSelectionText());
            msg = msg.replace('{total}', this.getTotal());
            document.querySelector('main form input[name="message"]').value = msg;

            // check for empty selections
            if (this.getTotal() === 0) {
                event.preventDefault();
                emptySelection();
                return;
            };
            
            // check for tos acceptance 
            if (!document.getElementById('calc-accept').checked) {
                event.preventDefault();
                if (await confirmTerms()) {
                    event.target.submit();
                }
            };          
        })
    }

    async build(dataFile) {
        this.data = await this.fetch(dataFile);

        for (const catId in this.data.categories) {
            const cat = this.data.categories[catId];
            const section = document.createElement('section');

            // title
            const h2 = document.createElement('h2');
            h2.innerText = cat.title[this.lang];
            section.appendChild(h2);

            // options grid
            const divGrid = document.createElement('div');
            divGrid.classList.add('uk-child-width-1-1', 'uk-child-width-1-4@m');
            divGrid.setAttribute('uk-grid', '');
            section.appendChild(divGrid);

            // article (option incl. title, image, price)
            cat.options.forEach(option => {
                const article = document.createElement('article');
                article.style.backgroundImage = `url('${this.data.baseImgPath}${option.img}')`;
                article.addEventListener('click', (event) => {
                    this.selection[catId] = option;

                    // update total
                    this.totalContainer.innerText = this.getTotal();

                    // remove .selected from all other articles in this section
                    Array.from(section.querySelectorAll('article')).forEach((a) => {
                        a.classList.remove('selected');
                    });

                    // add .selected to this option
                    event.target.classList.add('selected');
                });

                // option title
                const h3 = document.createElement('h3');
                h3.innerText = option.title[this.lang];
                article.appendChild(h3);

                // option price
                const spanPrice = document.createElement('span');
                spanPrice.innerHTML = `${option.price} &euro;`;
                article.appendChild(spanPrice);

                // option selected label  
                const spanSelected = document.createElement('span');
                spanSelected.innerHTML = this.data.strings.selected[this.lang];
                spanSelected.classList.add('selected-label');
                article.appendChild(spanSelected);

                // uk-grid requires every article to be wrapped in a div without any attributes
                const div = document.createElement('div');
                div.appendChild(article);
                divGrid.appendChild(div);
            });

            this.targetContainer.appendChild(section);
        };
    }

    getTotal() {
        let total = 0;
        for (let optId in this.selection) {
            const option = this.selection[optId];
            total += option.price;
        }
        return total;
    }

    getSelectionText() {
        let selection = "";
        for (let optId in this.selection) {
            const option = this.selection[optId];
            if (option.price !== 0)
                selection += `\n- ${this.data.categories[optId].title[this.lang]}: ${option.title[this.lang]} (${option.price}€)`;
        }
        return selection;
    }

    async fetch(url) {
        url += `?${Date.now()}`;
        var data = null;
        try {
            data = await (await fetch(url)).json();
            if (!data) {
                console.error("[calc] malformed data loaded:", data);
                throw "malformed data";
            }
        }
        catch(ex) {
            console.error(`[calc] failed to load ${url}, reason: ${ex}`);
            return;
        }
        return data;
    }
}