import HttpBase from "./HttpBase";

export default class HttpLogin extends HttpBase {
    static #route = "/login";
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
