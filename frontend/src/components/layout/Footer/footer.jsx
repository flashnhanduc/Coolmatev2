import { Link } from 'react-router-dom';
import {
    FiPhone,
    FiMail,
    FiArrowRight,
} from 'react-icons/fi';

import {
    FaFacebookF,
    FaTiktok,
    FaInstagram,
    FaYoutube,
} from 'react-icons/fa';

import styles from './footer.module.css';

const coolClubLinks = [
    {
        label: 'Tài khoản CoolClub',
        path: '/account',
    },
    {
        label: 'Đăng ký thành viên',
        path: '/register',
    },
    {
        label: 'Ưu đãi & Đặc quyền',
        path: '/coolclub',
    },
];

const policyLinks = [
    {
        label: 'Chính sách đổi trả tại cửa hàng',
        path: '/policies/store-return',
    },
    {
        label: 'Chính sách đổi trả 60 ngày online',
        path: '/policies/online-return',
    },
    {
        label: 'Chính sách khuyến mãi',
        path: '/policies/promotions',
    },
    {
        label: 'Chính sách bảo mật',
        path: '/policies/privacy',
    },
    {
        label: 'Chính sách giao hàng',
        path: '/policies/shipping',
    },
    {
        label: 'Chính sách giá',
        path: '/policies/pricing',
    },
    {
        label: 'Chính sách thanh toán & hoàn tiền',
        path: '/policies/payment',
    },
    {
        label: 'Tiếp nhận và xử lý khiếu nại',
        path: '/policies/complaints',
    },
    {
        label: 'Điều kiện hạn chế',
        path: '/policies/limitations',
    },
];

const customerCareLinks = [
    {
        label: 'Trải nghiệm mua sắm 100% hài lòng',
        path: '/customer-care',
    },
    {
        label: 'Hỏi đáp - FAQs',
        path: '/faqs',
    },
];

const discoverLinks = [
    {
        label: 'Community Threads',
        path: '/community',
    },
    {
        label: 'Hướng dẫn chọn size Nam',
        path: '/size-guide/nam',
    },
    {
        label: 'Hướng dẫn chọn size Nữ',
        path: '/size-guide/nu',
    },
    {
        label: 'Blog',
        path: '/blog',
    },
];

const aboutLinks = [
    {
        label: 'Quy tắc ứng xử của Coolmate',
        path: '/about/code-of-conduct',
    },
    {
        label: 'Coolmate 101',
        path: '/about/coolmate-101',
    },
    {
        label: 'DVKH xuất sắc',
        path: '/about/customer-service',
    },
    {
        label: 'Câu chuyện về Coolmate',
        path: '/about/story',
    },
    {
        label: 'Nhà máy',
        path: '/about/factory',
    },
    {
        label: 'Care & Share',
        path: '/care-and-share',
    },
    {
        label: 'Phát triển bền vững',
        path: '/about/sustainability',
    },
    {
        label: 'Tầm nhìn 2030',
        path: '/about/vision-2030',
    },
];

function FooterLinkList({ links }) {
    return (
        <ul className={styles.linkList}>
            {links.map((link) => (
                <li key={link.path}>
                    <Link to={link.path}>
                        {link.label}
                    </Link>
                </li>
            ))}
        </ul>
    );
}

function Footer() {
    return (
        <footer className={styles.footer}>
            <div className={styles.topSection}>
                <div className={styles.feedback}>
                    <h2>COOLMATE lắng nghe bạn!</h2>

                    <p>
                        Chúng tôi luôn trân trọng và mong
                        đợi nhận được mọi ý kiến đóng góp
                        từ khách hàng để có thể nâng cấp
                        trải nghiệm dịch vụ và sản phẩm
                        tốt hơn nữa.
                    </p>

                    <Link
                        to="/feedback"
                        className={styles.feedbackButton}
                    >
                        ĐÓNG GÓP Ý KIẾN
                        <FiArrowRight />
                    </Link>
                </div>

                <div className={styles.contactInformation}>
                    <a
                        href="tel:1900272737"
                        className={styles.contactItem}
                    >
                        <FiPhone
                            className={styles.contactIcon}
                        />

                        <span>
                            <small>Hotline</small>
                            <strong>
                                1900.272737 - 028.7777.2737
                            </strong>
                        </span>
                    </a>

                    <a
                        href="mailto:cool@coolmate.me"
                        className={styles.contactItem}
                    >
                        <FiMail
                            className={styles.contactIcon}
                        />

                        <span>
                            <small>Email</small>
                            <strong>
                                Cool@coolmate.me
                            </strong>
                        </span>
                    </a>
                </div>

                <div className={styles.socialList}>
                    <a
                        href="https://facebook.com"
                        target="_blank"
                        rel="noreferrer"
                        aria-label="Facebook"
                    >
                        <FaFacebookF />
                    </a>

                    <a
                        href="https://zalo.me"
                        target="_blank"
                        rel="noreferrer"
                        aria-label="Zalo"
                        className={styles.zaloIcon}
                    >
                        Zalo
                    </a>

                    <a
                        href="https://tiktok.com"
                        target="_blank"
                        rel="noreferrer"
                        aria-label="TikTok"
                    >
                        <FaTiktok />
                    </a>

                    <a
                        href="https://instagram.com"
                        target="_blank"
                        rel="noreferrer"
                        aria-label="Instagram"
                    >
                        <FaInstagram />
                    </a>

                    <a
                        href="https://youtube.com"
                        target="_blank"
                        rel="noreferrer"
                        aria-label="YouTube"
                    >
                        <FaYoutube />
                    </a>
                </div>
            </div>

            <div className={styles.divider} />

            <div className={styles.navigation}>
                <div className={styles.column}>
                    <h3>COOLCLUB</h3>
                    <FooterLinkList
                        links={coolClubLinks}
                    />

                    <h3 className={styles.secondaryTitle}>
                        TÀI LIỆU - TUYỂN DỤNG
                    </h3>

                    <ul className={styles.linkList}>
                        <li>
                            <Link to="/careers">
                                Tuyển dụng
                            </Link>
                        </li>

                        <li>
                            <Link to="/copyright">
                                Đăng ký bản quyền
                            </Link>
                        </li>
                    </ul>
                </div>

                <div className={styles.column}>
                    <h3>CHÍNH SÁCH</h3>
                    <FooterLinkList
                        links={policyLinks}
                    />

                    <h3 className={styles.secondaryTitle}>
                        COOLMATE.ME
                    </h3>

                    <ul className={styles.linkList}>
                        <li>
                            <Link to="/history">
                                Lịch sử thay đổi website
                            </Link>
                        </li>

                        <li>
                            <Link to="/cookies">
                                Quản lý Cookie
                            </Link>
                        </li>
                    </ul>
                </div>

                <div className={styles.column}>
                    <h3>CHĂM SÓC KHÁCH HÀNG</h3>
                    <FooterLinkList
                        links={customerCareLinks}
                    />

                    <h3 className={styles.secondaryTitle}>
                        KHÁM PHÁ
                    </h3>

                    <FooterLinkList
                        links={discoverLinks}
                    />
                </div>

                <div className={styles.column}>
                    <h3>VỀ COOLMATE</h3>
                    <FooterLinkList
                        links={aboutLinks}
                    />
                </div>

                <div
                    className={`${styles.column} ${styles.addressColumn}`}
                >
                    <h3>ĐỊA CHỈ LIÊN HỆ</h3>

                    <address>
                        <p>
                            <strong>Cửa hàng:</strong>{' '}
                            Nhà trọ Thanh Niên 18 Thạnh Lộc 16, Phường An Phú Đông, TpHCM
                        </p>

                    </address>
                </div>
            </div>

            <div className={styles.bottomSection}>
                <div>
                    <p>
                        © Design by Nhan Duc
                    </p>

                </div>

                <div className={styles.certifications}>
                    <span>NSCS</span>
                    <span>DMCA</span>
                    <span>BỘ CÔNG THƯƠNG</span>
                </div>
            </div>
        </footer>
    );
}

export default Footer;