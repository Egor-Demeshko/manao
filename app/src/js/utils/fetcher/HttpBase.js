export default class HttpBase {
    static async getRequest(route, method) {
        return await fetch(route, { method });
    }

    static postRequest() {}
}
