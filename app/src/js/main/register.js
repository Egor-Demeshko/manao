import createHtml from "../utils/creators/createHtml";
import createScript from "../utils/creators/createScript";
import createCss from "../utils/creators/createCss";
import FormController from "../elements/FormController";
import getClient from "../utils/fetcher/getClient";

export default async function registerStart() {
    //необхожимо получить доступ к кнопке логина
    //создать два событие, pointereneter и click
    //при pointerenter получить разметку логина
    //при click показать всплывающее окно

    const elem = document.getElementById("register");
    let formLoaded = false;
    let loginForm;

    if (!elem) {
        console.error("НЕТ ЭЛЕМЕНТА РЕГИСТРАЦИИ");
        return;
    }

    elem.addEventListener("pointerenter", getRegisterMarkUp, { once: true });
    elem.addEventListener("click", openForm);

    async function getRegisterMarkUp() {
        try {
            const client = getClient("register");
            const result = await client.getRequest();
            let data = await result.json();

            let { html, js, css } = data;

            const domElement = createHtml(html, "body", [
                FormController.wrapperClass,
            ]);
            createScript(js);
            createCss(css);

            loginForm = new FormController(domElement, client);
        } catch (e) {
            console.error(e);
        }
    }

    function openForm() {
        if (formLoaded) {
            setTimeout(() => {
                if (formLoaded) {
                    loginForm.open();
                }
            }, 200);
            return;
        }

        loginForm.open();
    }
}
