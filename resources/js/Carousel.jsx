import { createRoot } from 'react-dom/client';
import BudayaCarousel from './components/BudayaCarousel';

const root = document.getElementById('carousel-root');

if (root) {
    try {
        const items = JSON.parse(root.dataset.items || '[]');
        if (Array.isArray(items) && items.length > 0) {
            createRoot(root).render(<BudayaCarousel items={items} />);
        }
    } catch (error) {
        console.error('Data carousel tidak valid:', error);
    }
}