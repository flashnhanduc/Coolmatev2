import { Link } from 'react-router-dom';
import styles from './CollectionBanner.module.css';

function CollectionBanner({
    title,
    image="/images/collections/pickleball-banner.jpg",
    link,
}) {
    return (
        <section className={styles.section}>
            <div className={styles.banner}>
                <img
                    className={styles.image}
                    src={image}
                    alt={title}
                />

                <div className={styles.overlay} />

                <div className={styles.content}>
                    <h2>{title}</h2>

                    <Link
                        to={link}
                        className={styles.buyButton}
                    >
                        MUA NGAY

                        <span className={styles.arrow}>
                            →
                        </span>
                    </Link>
                </div>
            </div>
        </section>
    );
}

export default CollectionBanner;