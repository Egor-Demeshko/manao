import HttpLogout from "../utils/fetcher/HttpLogout";
export default async function logoutStart() {
    const logoutElem = document.getElementById("logout");
    if (!logoutElem) {
        return;
    }

    logoutElem.addEventListener("click", logout);

    async function logout() {
        let response = await HttpLogout.postRequest();
        let result = await response.json();

        if (result.status === "true") {
            window.location.href = "/";
        }
    }
}
