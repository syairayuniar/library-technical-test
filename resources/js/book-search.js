const input = document.getElementById('search-input');
let timer;

input?.addEventListener('input', () => {
    clearTimeout(timer);
    timer = setTimeout(async () => {
        const response = await fetch(`/books/search?q=${encodeURIComponent(input.value)}`);
        const html = await response.text();
        document.getElementById('book-grid').outerHTML = html;
    }, 300);
});