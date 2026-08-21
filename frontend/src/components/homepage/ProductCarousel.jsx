import { useRef } from 'react';
import { Link } from 'react-router-dom';
import styles from './ProductCarousel.module.css';
const pickleballProducts = [
    {
        id: 1,
        name: 'Áo Polo Croptop Pickleball nữ',
        slug: 'ao-polo-croptop-pickleball-nu',
        image: '/images/products/pickleball-1.jpg',
        hoverImage:
            '/images/products/pickleball-1-hover.jpg',
        price: 399000,
        comparePrice: 499000,
        badge: null,
        colors: ['#ffffff', '#d9d9d9'],
        sizes: ['S', 'M', 'L', 'XL'],
    },
    {
        id: 2,
        name: 'Váy Pickleball nữ Essentials',
        slug: 'vay-pickleball-nu-essentials',
        image: '/images/products/pickleball-2-.jpg',
        hoverImage:
            '/images/products/pickleball-2-hover.jpg',
        price: 499000,
        comparePrice: null,
        badge: 'BÁN CHẠY',
        colors: ['#ffffff', '#111111'],
        sizes: ['S', 'M', 'L', 'XL'],
    },
    {
        id: 3,
        name: 'Áo thun nam Pickleball Essentials',
        slug: 'ao-thun-nam-pickleball-essentials',
        image: '/images/products/pickleball-3.jpg',
        hoverImage:
            '/images/products/pickleball-3-hover.jpg',
        price: 299000,
        comparePrice: null,
        badge: null,
        colors: ['#ffffff', '#2f5acf'],
        sizes: ['S', 'M', 'L', 'XL'],
    },
    {
        id: 4,
        name: 'Quần Shorts Pickleball Smash Shot',
        slug: 'quan-shorts-pickleball-smash-shot',
        image: '/images/products/pickleball-4.jpg',
        hoverImage:
            '/images/products/pickleball-4-hover.jpg',
        price: 349000,
        comparePrice: 399000,
        badge: 'BÁN CHẠY',
        colors: ['#111111', '#ffffff', '#aaaaaa'],
        sizes: ['S', 'M', 'L', 'XL'],
    },
];

function ProductCarousel({
    title = "SẢN PHẨM PICKLEBALL",
    viewAllLink = "/collections/pickleball",
    products = pickleballProducts,
}) {
    const productListRef = useRef(null);

    function scrollProducts(direction) {
        const productList = productListRef.current;

        if (!productList) {
            return;
        }

        const scrollAmount =
            productList.clientWidth * 0.85;

        productList.scrollBy({
            left:
                direction === 'next'
                    ? scrollAmount
                    : -scrollAmount,
            behavior: 'smooth',
        });
    }

    function formatPrice(price) {
        return new Intl.NumberFormat('vi-VN').format(
            price
        ) + 'đ';
    }
    function handleQuickAdd(product, size) {
        console.log('Thêm Sản Phẩm $ {product.name}, size ${size}');
    }
    return (
        <section className={styles.section}>
            <div className={styles.heading}>
                <h2>{title}</h2>

                <Link
                    to={viewAllLink}
                    className={styles.viewMore}
                >
                    Xem thêm
                </Link>
            </div>

            <div className={styles.carousel}>
                <button
                    type="button"
                    className={`${styles.navigationButton} ${styles.previousButton}`}
                    onClick={() =>
                        scrollProducts('previous')
                    }
                    aria-label="Sản phẩm trước"
                >
                    &#10094;
                </button>

                <div
                    ref={productListRef}
                    className={styles.productList}
                >
                    {products.map((product) => (
                        <article
                            key={product.id}
                            className={styles.productCard}
                        >
                            <div
                                className={
                                    styles.imageWrapper
                                }
                            >
                                <Link
                                    to={`/products/${product.slug}`}
                                    className={styles.imageLink}
                                >
                                    <img
                                        className={`${styles.productImage} ${styles.primaryImage}`}
                                        src={product.image}
                                        alt={product.name}
                                    />

                                    {product.hoverImage && (
                                        <img
                                            className={`${styles.productImage} ${styles.hoverImage}`}
                                            src={product.hoverImage}
                                            alt=""
                                        />
                                    )}
                                </Link>

                                {product.badge && (
                                    <span
                                        className={
                                            styles.badge
                                        }
                                    >
                                        {product.badge}
                                    </span>
                                )}
                                <div className={styles.quickAdd}>
                                    <p className={styles.quickAddTitle}>
                                        Thêm nhanh vào giỏ hàng +
                                    </p>

                                    <div className={styles.sizeList}>
                                        {product.sizes.map((size) => (
                                            <button
                                                key={size}
                                                type="button"
                                                className={styles.sizeButton}
                                                onClick={() =>
                                                    handleQuickAdd(product, size)
                                                }
                                            >
                                                {size}
                                            </button>
                                        ))}
                                    </div>
                                </div>
                            </div>

                            <div
                                className={
                                    styles.productInformation
                                }
                            >
                                <div
                                    className={
                                        styles.colorList
                                    }
                                >
                                    {product.colors.map(
                                        (color) => (
                                            <span
                                                key={color}
                                                className={
                                                    styles.color
                                                }
                                                style={{
                                                    backgroundColor:
                                                        color,
                                                }}
                                            />
                                        )
                                    )}
                                </div>

                                <h3
                                    className={
                                        styles.productName
                                    }
                                >
                                    <Link
                                        to={`/products/${product.slug}`}
                                    >
                                        {product.name}
                                    </Link>
                                </h3>

                                <div
                                    className={
                                        styles.priceGroup
                                    }
                                >
                                    <span
                                        className={
                                            styles.salePrice
                                        }
                                    >
                                        {formatPrice(
                                            product.price
                                        )}
                                    </span>

                                    {product.comparePrice && (
                                        <span
                                            className={
                                                styles.comparePrice
                                            }
                                        >
                                            {formatPrice(
                                                product.comparePrice
                                            )}
                                        </span>
                                    )}
                                </div>
                            </div>
                        </article>
                    ))}
                </div>

                <button
                    type="button"
                    className={`${styles.navigationButton} ${styles.nextButton}`}
                    onClick={() =>
                        scrollProducts('next')
                    }
                    aria-label="Sản phẩm tiếp theo"
                >
                    &#10095;
                </button>
            </div>
        </section>
    );
}

export default ProductCarousel;