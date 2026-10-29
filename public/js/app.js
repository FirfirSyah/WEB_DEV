document.addEventListener('DOMContentLoaded', () => {
    const tombol = document.getElementById('nav-toggle');
    const nav = document.getElementById('nav-utama');
    if (!tombol || !nav) return;

    const tutup = () => {
        nav.classList.remove('terbuka');
        tombol.setAttribute('aria-expanded', 'false');
    };

    tombol.addEventListener('click', () => {
        const terbuka = nav.classList.toggle('terbuka');
        tombol.setAttribute('aria-expanded', String(terbuka));
    });

    nav.querySelectorAll('a').forEach((a) => a.addEventListener('click', tutup));
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') tutup();
    });
});