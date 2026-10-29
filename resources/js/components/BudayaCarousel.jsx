import { useEffect, useState } from 'react';
import { motion, useReducedMotion } from 'framer-motion';
import { ChevronLeft, ChevronRight, Play, Pause } from 'lucide-react';

/* ---------- Ukuran sesuai lebar layar ---------- */
function hitungLayout() {
    const w = window.innerWidth;
    if (w < 640) {
        const cardW = Math.min(Math.round(w * 0.7), 280);
        return { cardW, cardH: Math.round(cardW * 1.3), gap: Math.round(cardW * 0.55), visible: 1 };
    }
    if (w < 1024) return { cardW: 300, cardH: 390, gap: 210, visible: 1 };
    return { cardW: 340, cardH: 442, gap: 290, visible: 2 };
}

function useLayout() {
    const [layout, setLayout] = useState(hitungLayout);
    useEffect(() => {
        const onResize = () => setLayout(hitungLayout());
        window.addEventListener('resize', onResize);
        return () => window.removeEventListener('resize', onResize);
    }, []);
    return layout;
}

/* Jarak melingkar terpendek dari kartu `index` ke kartu aktif */
function hitungOffset(index, aktif, total) {
    let d = index - aktif;
    const setengah = total / 2;
    if (d > setengah) d -= total;
    if (d < -setengah) d += total;
    return d;
}

/* ---------- Satu kartu ---------- */
function Kartu({ item, index, total, offset, layout, reduced, onPilih }) {
    const [gagal, setGagal] = useState(false);

    const jarak = Math.abs(offset);
    const aktif = offset === 0;
    const terlihat = jarak <= layout.visible;
    const arah = offset < 0 ? -1 : 1;
    const bisaDiklik = terlihat && !aktif;

    const target = {
        x: terlihat ? offset * layout.gap : arah * (layout.visible + 1) * layout.gap,
        scale: terlihat ? 1 - jarak * 0.14 : 0.6,
        rotateY: terlihat ? -offset * 22 : -arah * 30,
        opacity: terlihat ? 1 - jarak * 0.28 : 0,
    };

    const transisi = reduced
        ? { duration: 0 }
        : { type: 'spring', stiffness: 220, damping: 28, mass: 0.9 };

    const onKeyDown = (e) => {
        if (bisaDiklik && (e.key === 'Enter' || e.key === ' ')) {
            e.preventDefault();
            onPilih();
        }
    };

    return (
        <motion.article
            className={`kc-card ${aktif ? 'kc-card--aktif' : ''}`}
            style={{
                width: layout.cardW,
                height: layout.cardH,
                marginLeft: -layout.cardW / 2,
                marginTop: -layout.cardH / 2,
                zIndex: 10 - jarak,
                pointerEvents: terlihat ? 'auto' : 'none',
            }}
            initial={false}
            animate={target}
            whileHover={aktif && !reduced ? { y: -8 } : undefined}
            transition={transisi}
            onClick={bisaDiklik ? onPilih : undefined}
            onKeyDown={onKeyDown}
            role={bisaDiklik ? 'button' : 'group'}
            tabIndex={bisaDiklik ? 0 : -1}
            aria-hidden={!terlihat}
            aria-label={bisaDiklik ? `Tampilkan ${item.judul}` : `${item.judul}, ${index + 1} dari ${total}`}
        >
            <div className="kc-cover">
                {item.gambar && !gagal ? (
                    <img src={item.gambar} alt="" loading="lazy" draggable={false} onError={() => setGagal(true)} />
                ) : (
                    <div className="kc-fallback" />
                )}
            </div>
            <div className="kc-shade" />
            <div className="kc-isi">
                <span className="kc-label">{item.kategori}</span>
                <h3>{item.judul}</h3>
                <p>{item.ringkasan}</p>
                {aktif && (
                    <a className="kc-tautan" href={item.url}>
                        Baca Selengkapnya <span aria-hidden="true">&rarr;</span>
                    </a>
                )}
            </div>
        </motion.article>
    );
}

/* ---------- Carousel ---------- */
export default function BudayaCarousel({ items }) {
    const layout = useLayout();
    const reduced = Boolean(useReducedMotion());
    const [aktif, setAktif] = useState(0);
    const [main, setMain] = useState(false);
    const [jeda, setJeda] = useState(false);
    const total = items.length;
    const bisaGeser = total > 1;

    const ke = (i) => setAktif(((i % total) + total) % total);

    // Putar otomatis: berhenti saat kursor di atas kartu atau animasi dikurangi
    useEffect(() => {
        if (!main || jeda || reduced || !bisaGeser) return;
        const timer = setInterval(() => setAktif((a) => (a + 1) % total), 3500);
        return () => clearInterval(timer);
    }, [main, jeda, reduced, bisaGeser, total]);

    const onKeyDown = (e) => {
        if (!bisaGeser) return;
        if (e.key === 'ArrowRight') { e.preventDefault(); ke(aktif + 1); }
        else if (e.key === 'ArrowLeft') { e.preventDefault(); ke(aktif - 1); }
        else if (e.key === 'Home') { e.preventDefault(); ke(0); }
        else if (e.key === 'End') { e.preventDefault(); ke(total - 1); }
    };

    return (
        <section
            className="kc"
            role="region"
            aria-roledescription="carousel"
            aria-label="Budaya pilihan"
            tabIndex={0}
            onKeyDown={onKeyDown}
        >
            <p className="sr-only" aria-live="polite">
                Kartu {aktif + 1} dari {total}: {items[aktif].judul}
            </p>

            <div
                className="kc-stage"
                style={{ height: layout.cardH + 80 }}
                onMouseEnter={() => setJeda(true)}
                onMouseLeave={() => setJeda(false)}
            >
                {items.map((item, i) => (
                    <Kartu
                        key={item.id}
                        item={item}
                        index={i}
                        total={total}
                        offset={hitungOffset(i, aktif, total)}
                        layout={layout}
                        reduced={reduced}
                        onPilih={() => ke(i)}
                    />
                ))}
            </div>

            <div className="kc-kontrol" role="group" aria-label="Kontrol carousel">
                <button type="button" className="kc-btn" onClick={() => ke(aktif - 1)} disabled={!bisaGeser} aria-label="Kartu sebelumnya">
                    <ChevronLeft size={22} aria-hidden="true" />
                </button>

                <button
                    type="button"
                    className="kc-btn"
                    onClick={() => setMain((m) => !m)}
                    disabled={!bisaGeser || reduced}
                    aria-label={main ? 'Jeda putar otomatis' : 'Putar otomatis'}
                    aria-pressed={main}
                    title={reduced ? 'Dinonaktifkan karena pengaturan kurangi animasi' : undefined}
                >
                    {main ? <Pause size={20} aria-hidden="true" /> : <Play size={20} aria-hidden="true" />}
                </button>

                <div className="kc-dots">
                    {items.map((it, i) => (
                        <button
                            key={it.id}
                            type="button"
                            className={`kc-dot ${i === aktif ? 'is-aktif' : ''}`}
                            onClick={() => ke(i)}
                            aria-label={`Kartu ${i + 1}: ${it.judul}`}
                            aria-current={i === aktif ? 'true' : undefined}
                        />
                    ))}
                </div>
                <span className="kc-hitung" aria-hidden="true">{aktif + 1} / {total}</span>

                <button type="button" className="kc-btn" onClick={() => ke(aktif + 1)} disabled={!bisaGeser} aria-label="Kartu berikutnya">
                    <ChevronRight size={22} aria-hidden="true" />
                </button>
            </div>
        </section>
    );
}