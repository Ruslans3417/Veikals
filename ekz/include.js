async function includeHTML(file, elementId) {
    let response = await fetch(file);
    if (response.ok) {
        let text = await response.text();
        document.getElementById(elementId).innerHTML = text;
    } else {
        console.error('Failed to load file:', file);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    includeHTML('header.html', 'header-placeholder');
    includeHTML('footer.html', 'footer-placeholder');
});
