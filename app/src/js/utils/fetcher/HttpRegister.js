import HttpBase from "./HttpBase";

export default class HttpRegister extends HttpBase {
    static #route = "/register";
    static #origin = window.origin;

    static async getRequest() {
        return await super.getRequest(this.#origin.concat(this.#route), "GET");
    }
    static async postRequest(formData) {
        return await super.postRequest(
            this.#origin.concat(this.#route),
            "POST",
            {
                body: formData,
            }
        );
    }
}
