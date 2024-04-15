import HttpBase from "./HttpBase";

export default class HttpLogout extends HttpBase {
    static #route = "/logout";
    static #origin = window.origin;

    static async postRequest() {
        return await super.postRequest(
            this.#origin.concat(this.#route),
            "POST",
            {
                credentials: "include",
            }
        );
    }
}
