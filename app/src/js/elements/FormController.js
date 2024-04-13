export default class FormController {
    #open = false;
    #DomElement = null;
    #client = null;
    #openClass = "--open";

    static wrapperClass = "wrapper_form";

    constructor(domElement, client) {
        this.#client = client;
        if (domElement instanceof HTMLElement) {
            this.#DomElement = domElement;

            this.#DomElement.addEventListener(
                "click",
                this.wrapperClose.bind(this)
            );

            this.setpUpButtons();
        } else {
            console.error("Login dom element is abscent");
        }
    }

    isOpen() {
        return this.#open;
    }

    setpUpButtons() {
        const closeButton = this.#DomElement.querySelector(
            ".login_form__back_button"
        );

        const submitButton = this.#DomElement.querySelector(
            ".login_form__login_button"
        );

        closeButton.addEventListener("click", (e) => {
            e.preventDefault();
            this.close();
        });

        submitButton.addEventListener("click", (e) => {
            e.preventDefault();
            const form = this.#DomElement.querySelector("form");
            let validityResult = form.reportValidity();
            if (!validityResult) return;

            this.processSubmit();
        });
    }

    open() {
        document.body.appendChild(this.#DomElement);
        setTimeout(() => {
            this.#open = true;
            this.#DomElement.classList.add(this.#openClass);
        }, 50);
    }

    close() {
        this.#DomElement.classList.remove(this.#openClass);
        this.#open = false;
        setTimeout(() => {
            this.#DomElement.remove();
        }, 300);
    }

    wrapperClose({ target }) {
        if (target.classList.contains(FormController.wrapperClass)) {
            this.close();
            return;
        }
    }

    async processSubmit() {
        const form = this.#DomElement.querySelector("form");
        if (!form) return;

        const formData = new FormData(form);
        //ждем результат, если результат ок, то все, закрываешь окогко. делаем обновление и
        //считаем себя залогиненными.(фактически просто редирект на главую, но уже будет sessionid)
        const result = await this.#client.postRequest(formData);
        console.log(await result.text());
        //ELSE если результат ошибка, то сохранить поля в форме.
        //прописать ошибки.
    }
}
