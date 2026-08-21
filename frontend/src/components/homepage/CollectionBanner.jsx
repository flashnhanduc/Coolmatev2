import { Link } from 'react-router-dom';
import styles from './CollectionBanner.module.css';

function CollectionBanner({
    image,
    mobileImage,
    alt,
    link,
    buttonText = 'MUA NGAY',
}) {
    return (
        <section className={styles.section}>
            <div className={styles.banner}>
                <picture>
                    {mobileImage && (
                        <source
                            media="(max-width: 768px)"
                            srcSet={mobileImage}
                        />
                    )}

                    <img
                        className={styles.image}
                        src={image}
                        alt={alt}
                    />
                </picture>

                <Link
                    to={link}
                    className={styles.button}
                >
                    {buttonText}
                    <span aria-hidden="true">→</span>
                </Link>
            </div>
        </section>
    );
}

export default CollectionBanner;