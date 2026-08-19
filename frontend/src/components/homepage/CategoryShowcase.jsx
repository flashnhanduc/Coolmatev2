import { useState } from 'react';
import { Link } from 'react-router-dom';
import styles from './CategoryShowcase.module.css';

const categoryGroups = {
    men: [
        {
            id: 1,
            name: 'ÁO POLO',
            image: '/images/categories/men-polo.jpg',
            link: '/categories/ao-polo',
        },
        {
            id: 2,
            name: 'ÁO THUN',
            image: '/images/categories/men-tshirt.jpg',
            link: '/categories/ao-thun',
        },
        {
            id: 3,
            name: 'QUẦN SHORTS',
            image: '/images/categories/men-shorts.jpg',
            link: '/categories/quan-shorts',
        },
        {
            id: 4,
            name: 'SƠ MI',
            image: '/images/categories/men-shirt.jpg',
            link: '/categories/so-mi',
        },
        {
            id: 5,
            name: 'QUẦN DÀI',
            image: '/images/categories/men-pants.jpg',
            link: '/categories/quan-dai',
        },
        {
            id: 6,
            name: 'QUẦN LÓT',
            image: '/images/categories/men-underwear.jpg',
            link: '/categories/quan-lot',
        },
    ],

    women: [
        {
            id: 7,
            name: 'ĐỒ BƠI',
            image: '/images/categories/women-swimwear.jpg',
            link: '/categories/do-boi-nu',
        },
        {
            id: 8,
            name: 'ÁO THỂ THAO',
            image: '/images/categories/women-sport-shirt.jpg',
            link: '/categories/ao-the-thao-nu',
        },
        {
            id: 9,
            name: 'QUẦN THỂ THAO',
            image: '/images/categories/women-sport-shorts.jpg',
            link: '/categories/quan-the-thao-nu',
        },
        {
            id: 10,
            name: 'BRA & LEGGINGS',
            image: '/images/categories/women-bra-legging.jpg',
            link: '/categories/bra-leggings',
        },
        {
            id: 11,
            name: 'VÁY THỂ THAO',
            image: '/images/categories/women-dress.jpg',
            link: '/categories/vay-the-thao',
        },
        {
            id: 12,
            name: 'PHỤ KIỆN',
            image: '/images/categories/women-accessories.jpg',
            link: '/categories/phu-kien-nu',
        },
    ],
};

function CategoryShowcase() {
    // Mặc định hiển thị danh mục nam
    const [activeGender, setActiveGender] =
        useState('men');

    // Lấy danh sách theo tab đang được chọn
    const categories = categoryGroups[activeGender];

    return (
        <section className={styles.section}>
            <div
                className={styles.tabs}
                role="tablist"
                aria-label="Chọn danh mục theo giới tính"
            >
                <button
                    type="button"
                    role="tab"
                    aria-selected={
                        activeGender === 'men'
                    }
                    className={`${styles.tabButton} ${
                        activeGender === 'men'
                            ? styles.activeTab
                            : ''
                    }`}
                    onClick={() =>
                        setActiveGender('men')
                    }
                >
                    NAM
                </button>

                <button
                    type="button"
                    role="tab"
                    aria-selected={
                        activeGender === 'women'
                    }
                    className={`${styles.tabButton} ${
                        activeGender === 'women'
                            ? styles.activeTab
                            : ''
                    }`}
                    onClick={() =>
                        setActiveGender('women')
                    }
                >
                    NỮ
                </button>
            </div>

            <div
                key={activeGender}
                className={styles.categoryGrid}
            >
                {categories.map((category) => (
                    <Link
                        key={category.id}
                        to={category.link}
                        className={styles.categoryCard}
                    >
                        <div
                            className={
                                styles.imageWrapper
                            }
                        >
                            <img
                                className={
                                    styles.categoryImage
                                }
                                src={category.image}
                                alt={category.name}
                            />
                        </div>

                        <span
                            className={
                                styles.categoryName
                            }
                        >
                            {category.name}
                        </span>
                    </Link>
                ))}
            </div>
        </section>
    );
}

export default CategoryShowcase;