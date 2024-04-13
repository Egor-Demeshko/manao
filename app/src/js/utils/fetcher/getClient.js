import HttpLogin from "./HttpLogin";
import HttpRegister from "./HttpRegister";

export default function getClient(clientType) {
    let client;

    switch (clientType) {
        case "login":
            client = HttpLogin;
            break;

        case "register":
            client = HttpRegister;
            break;
    }

    return client;
}
