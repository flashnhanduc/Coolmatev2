import { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import styles from './HeroBanner.module.css';

const banners = [
    {
        id: 1,
        image: '/images/home/hero-banner.jpg',
        alt: 'Boxer Brief Sporty Coolmate',
        link: '/products',
    },
    {
        id: 2,
        image: '/images/home/hero-banner-2.jpg',
        alt: 'Bộ sưu tập mới Coolmate',
        link: '/products',
    },
    {
        id: 3,
        image: '/images/home/hero-banner-3.jpg',
        alt: 'Khuyến mãi Coolmate',
        link: '/products',
    },
];

function HeroBanner() {
    /*
     * Thêm ảnh cuối vào đầu và ảnh đầu vào cuối:
     *
     * ảnh 3 - ảnh 1 - ảnh 2 - ảnh 3 - ảnh 1
     */
    const slides = [
        banners[banners.length - 1],
        ...banners,
        banners[0],
    ];

    // Bắt đầu ở vị trí 1 vì vị trí 0 là ảnh nhân bản
    const [currentIndex, setCurrentIndex] = useState(1);

    const [transitionEnabled, setTransitionEnabled] =
        useState(true);

    function nextBanner() {
        setTransitionEnabled(true);
        setCurrentIndex((previousIndex) => previousIndex + 1);
    }

    function previousBanner() {
        setTransitionEnabled(true);
        setCurrentIndex((previousIndex) => previousIndex - 1);
    }

    /*
     * Khi chạy tới ảnh nhân bản, lập tức đổi về
     * ảnh thật tương ứng mà người dùng không nhận ra.
     */
    function handleTransitionEnd() {
        // Đang ở ảnh đầu nhân bản nằm cuối danh sách
        if (currentIndex === banners.length + 1) {
            setTransitionEnabled(false);
            setCurrentIndex(1);
        }

        // Đang ở ảnh cuối nhân bản nằm đầu danh sách
        if (currentIndex === 0) {
            setTransitionEnabled(false);
            setCurrentIndex(banners.length);
        }
    }

    // Tự động chuyển sau mỗi 5 giây
    useEffect(() => {
        const intervalId = setInterval(() => {
            nextBanner();
        }, 5000);

        return () => clearInterval(intervalId);
    }, []);

    /*
     * Chuyển currentIndex của slides thành index
     * thật của mảng banners để đánh dấu chấm tròn.
     */
    const activeDotIndex =
        (currentIndex - 1 + banners.length) % banners.length;

    return (
        <section className={styles.hero}>
            <div
                className={styles.track}
                onTransitionEnd={handleTransitionEnd}
                style={{
                    transform: `translateX(-${currentIndex * 100}%)`,
                    transition: transitionEnabled
                        ? 'transform 0.6s ease-in-out'
                        : 'none',
                }}
            >
                {slides.map((banner, index) => (
                    <Link
                        key={`${banner.id}-${index}`}
                        to={banner.link}
                        className={styles.slide}
                        aria-label={banner.alt}
                    >
                        <img
                            className={styles.heroImage}
                            src={banner.image}
                            alt={banner.alt}
                        />
                    </Link>
                ))}
            </div>

            <button
                type="button"
                className={`${styles.arrow} ${styles.previous}`}
                onClick={previousBanner}
                aria-label="Ảnh trước"
            >
                &#10094;
            </button>

            <button
                type="button"
                className={`${styles.arrow} ${styles.next}`}
                onClick={nextBanner}
                aria-label="Ảnh tiếp theo"
            >
                &#10095;
            </button>

            <div className={styles.dots}>
                {banners.map((banner, index) => (
                    <button
                        key={banner.id}
                        type="button"
                        aria-label={`Chuyển đến banner ${index + 1}`}
                        className={`${styles.dot} ${
                            index === activeDotIndex
                                ? styles.activeDot
                                : ''
                        }`}
                        onClick={() => {
                            setTransitionEnabled(true);
                            setCurrentIndex(index + 1);
                        }}
                    />
                ))}
            </div>
        </section>
    );
}

export default HeroBanner;