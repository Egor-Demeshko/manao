export default function createScript(src) {
    const script = document.createElement("script");
    script.src = src;
    script.type = "module";

    document.head.appendChild(script);
}
