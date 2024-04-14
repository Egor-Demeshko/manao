export default function createScript(src) {
    const style = document.createElement("link");
    style.href = src;
    style.rel = "stylesheet";

    document.head.appendChild(style);
}
