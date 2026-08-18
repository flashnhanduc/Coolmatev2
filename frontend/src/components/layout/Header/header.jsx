import { useState } from 'react';
import { Link } from 'react-router-dom';
import {
    FiSearch,
    FiUser,
    FiShoppingBag,
} from 'react-icons/fi';
import styles from './Header.module.css';

const navigationItems = [
    { label: 'NEW', path: '/new', type: 'new' },
    { label: 'NAM', path: '/nam' },
    { label: 'NỮ', path: '/nu' },
    { label: 'THỂ THAO', path: '/the-thao' },
    { label: 'PHỤ KIỆN', path: '/phu-kien' },
    { label: 'SALE', path: '/sale', type: 'sale' },
];

function Header() {
    const [keyword, setKeyword] = useState('');

    const handleSearch = (event) => {
        event.preventDefault();

        const cleanKeyword = keyword.trim();

        if (!cleanKeyword) {
            return;
        }

        console.log('Tìm kiếm:', cleanKeyword);
    };

    return (
        <header className={styles.header}>
            <div className={styles.topBar}>
                <div className={styles.topBarInner}>
                    <div className={styles.topLinks}>
                        <a href="#">VỀ COOLMATE</a>
                        <a href="#">CM24 BY COOLMATE</a>
                        <a href="#">CARE & SHARE</a>
                    </div>

                    <div className={styles.topLinks}>
                        <a href="#">CoolClub</a>
                        <a href="#">Cửa hàng</a>
                        <a href="#">CSKH</a>
                    </div>
                </div>
            </div>

            <div className={styles.mainHeader}>
                <div className={styles.mainHeaderInner}>
                    <Link to="/" className={styles.logo}>
                        <span className={styles.logoIcon}>✦</span>
                        <span>COOLMATE</span>
                    </Link>

                    <nav className={styles.navigation}>
                        {navigationItems.map((item) => (
                            <Link
                                key={item.label}
                                to={item.path}
                                className={`
                                    ${styles.navLink}
                                    ${item.type === 'new'
                                        ? styles.newLink
                                        : ''}
                                    ${item.type === 'sale'
                                        ? styles.saleLink
                                        : ''}
                                `}
                            >
                                {item.label}
                            </Link>
                        ))}
                    </nav>

                    <div className={styles.actions}>
                        <form
                            className={styles.searchForm}
                            onSubmit={handleSearch}
                        >
                            <input
                                type="search"
                                value={keyword}
                                placeholder="Tìm kiếm..."
                                onChange={(event) =>
                                    setKeyword(event.target.value)
                                }
                            />

                            <button
                                type="submit"
                                aria-label="Tìm kiếm"
                            >
                                <FiSearch />
                            </button>
                        </form>

                        <button
                            type="button"
                            className={styles.iconButton}
                            aria-label="Tài khoản"
                        >
                            <FiUser />
                        </button>

                        <button
                            type="button"
                            className={styles.iconButton}
                            aria-label="Giỏ hàng"
                        >
                            <FiShoppingBag />
                        </button>
                    </div>
                </div>
            </div>
        </header>
    );
}

export default Header;