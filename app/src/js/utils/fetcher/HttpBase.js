export default class HttpBase {
    static async getRequest(route, method) {
        return await fetch(route, { method });
    }

    static async postRequest(route, method, options = null) {
        return await fetch(route, {
            method,
            ...options,
        });
    }
}
