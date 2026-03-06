function includeHTML() {
    const elements = document.querySelectorAll('[data-include]');
    elements.forEach(el => {
        const file = el.getAttribute('data-include');
        fetch(file)
            .then(response => {
                if (!response.ok) throw new Error('File not found');
                return response.text();
            })
            .then(data => {
                el.innerHTML = data;
                includeHTML(); // recursive call for nested includes (optional)
            });
    });
}

document.addEventListener('DOMContentLoaded', includeHTML);
