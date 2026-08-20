import HeroBanner from '../../components/homepage/HeroBanner.jsx';
import StorySection from '../../components/homepage/StorySection.jsx';
import CategoryShowcase from '../../components/homepage/CategoryShowcase.jsx';
import GenderBanners from '../../components/homepage/GenderBanners.jsx';
import CollectionBanner from '../../components/homepage/CollectionBanner.jsx';
import ProductCarousel from '../../components/homepage/ProductCarousel.jsx';
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
             <StorySection />
             <CategoryShowcase/>
             <GenderBanners/>
             <CollectionBanner/>
             <ProductCarousel/>
        </>
    );
}

export default HomePage;