import HeroBanner from '../../components/homepage/HeroBanner.jsx';

const heroBanner = {
    label: 'COOLMATE ACTIVE',
    title: 'X2 CoolCash | Mua 3 tặng 1',
    subtitle: 'Nâng cấp phong cách vận động mỗi ngày',
    buttonText: 'MUA NGAY',
    link: '/sale',
    image: '/images/home/hero-banner.jpg',
};

function HomePage() {
    return (
        <>
            <HeroBanner banner={heroBanner} />
        </>
    );
}

export default HomePage;