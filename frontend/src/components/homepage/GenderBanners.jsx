import { Link } from 'react-router-dom';
import styles from './GenderBanners.module.css';

const genderBanners = [
    {
        id: 1,
        title: 'ĐỒ NAM',
        image: '/images/gender/men-banner.jpg',
        link: '/collections/do-nam',
    },
    {
        id: 2,
        title: 'ĐỒ NỮ',
        image: '/images/gender/women-banner.jpg',
        link: '/collections/do-nu',
    },
];

function GenderBanners() {
    function handleMouseMove(event) {
        const card = event.currentTarget;
        const cardPosition =
            card.getBoundingClientRect();

        /*
         * Tính vị trí chuột bên trong banner.
         * Kết quả nằm trong khoảng từ -0.5 đến 0.5.
         */
        const mouseX =
            (event.clientX - cardPosition.left) /
                cardPosition.width -
            0.5;

        const mouseY =
            (event.clientY - cardPosition.top) /
                cardPosition.height -
            0.5;

        // Ảnh chuyển động ngược nhẹ với hướng chuột
        const moveX = mouseX * -24;
        const moveY = mouseY * -16;

        card.style.setProperty(
            '--move-x',
            `${moveX}px`
        );

        card.style.setProperty(
            '--move-y',
            `${moveY}px`
        );
    }

    function handleMouseLeave(event) {
        const card = event.currentTarget;

        // Đưa ảnh về vị trí ban đầu
        card.style.setProperty('--move-x', '0px');
        card.style.setProperty('--move-y', '0px');
    }

    return (
        <section className={styles.section}>
            <div className={styles.grid}>
                {genderBanners.map((banner) => (
                    <Link
                        key={banner.id}
                        to={banner.link}
                        className={styles.card}
                        aria-label={`Xem ${banner.title}`}
                        onMouseMove={handleMouseMove}
                        onMouseLeave={handleMouseLeave}
                    >
                        <img
                            className={styles.image}
                            src={banner.image}
                            alt={banner.title}
                        />

                        <div className={styles.overlay} />

                        <div className={styles.content}>
                            <h2>{banner.title}</h2>

                            <span className={styles.buyButton}>
                                MUA NGAY

                                <span
                                    className={
                                        styles.buttonArrow
                                    }
                                >
                                    →
                                </span>
                            </span>
                        </div> 
                    </Link>
                ))}
            </div>
        </section>
    );
}

export default GenderBanners;