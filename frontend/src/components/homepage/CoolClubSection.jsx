import { Link } from 'react-router-dom';
import {
    FiUserPlus,
    FiAward,
    FiGift,
    FiArrowRight,
} from 'react-icons/fi';

import styles from './CoolClubSection.module.css';

const benefits = [
    {
        id: 1,
        title: (
            <>
                Mời bạn bè
                <br />
                hoàn tiền 10% CoolCash
            </>
        ),
        icon: FiUserPlus,
    },
    {
        id: 2,
        title: 'Hoàn tiền đến 7%',
        icon: FiAward,
    },
    {
        id: 3,
        title: (
            <>
                Quà tặng sinh nhật
                <br />
                và dịp đặc biệt
            </>
        ),
        icon: FiGift,
    },
];

const activities = [
    'Đình Trường Giang vừa được cộng 6.000 CoolCash từ đơn hàng #4xxx564',
    'Chào mừng Đào Xuân Chức vừa gia nhập CoolClub',
    'Nguyễn Văn An vừa được cộng 10.000 CoolCash từ đơn hàng #3xxx239',
    'Hiếu Đồng Thành vừa được cộng 2.000 CoolCash từ đơn hàng #4xxx002',
];

function CoolClubSection() {
    return (
        <section className={styles.section}>
            <div className={styles.container}>
                <div className={styles.benefitArea}>
                    <h2 className={styles.heading}>
                        ĐẶC QUYỀN DÀNH CHO{' '}
                        <span>567.191</span> THÀNH VIÊN
                        COOLCLUB
                    </h2>

                    <div className={styles.benefitList}>
                        {benefits.map((benefit) => {
                            const BenefitIcon =
                                benefit.icon;

                            return (
                                <article
                                    key={benefit.id}
                                    className={
                                        styles.benefitCard
                                    }
                                >
                                    <h3>{benefit.title}</h3>

                                    <BenefitIcon
                                        className={
                                            styles.benefitIcon
                                        }
                                        aria-hidden="true"
                                    />
                                </article>
                            );
                        })}
                    </div>
                </div>

                <div className={styles.activityArea}>
                    <h2 className={styles.activityHeading}>
                        HOẠT ĐỘNG GẦN ĐÂY
                    </h2>

                    <div className={styles.activityTicker}>
                        <div className={styles.activityTrack}>
                            {[...activities, ...activities].map(
                                (activity, index) => (
                                    <span key={index}>
                                        {activity}
                                    </span>
                                )
                            )}
                        </div>
                    </div>

                    <Link
                        to="/coolclub"
                        className={styles.discoverButton}
                    >
                        KHÁM PHÁ COOLCLUB
                        <FiArrowRight aria-hidden="true" />
                    </Link>
                </div>
            </div>
        </section>
    );
}

export default CoolClubSection;