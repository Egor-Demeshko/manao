export default function createHtml(html, where = "body", classes = []) {
    let domElement;

    switch (where) {
        case "body": {
            domElement = document.createElement("div");
            classes.forEach((str) => {
                domElement.classList.add(str);
            });
            domElement.insertAdjacentHTML("beforeend", html);
            break;
        }
    }

    return domElement;
}
