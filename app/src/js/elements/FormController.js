export default class FormController {
    #open = false;
    #DomElement = null;
    #openClass = "--open";

    static wrapperClass = "wrapper_form";

    constructor(domElement) {
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
            this.validateFields();
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
        if (target.closest(`.${FormController.wrapperClass}`)) {
            this.close();
            return;
        }
    }
}
