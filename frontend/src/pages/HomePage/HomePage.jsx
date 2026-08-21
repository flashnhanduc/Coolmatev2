import HeroBanner from '../../components/homepage/HeroBanner.jsx';
import StorySection from '../../components/homepage/StorySection.jsx';
import CategoryShowcase from '../../components/homepage/CategoryShowcase.jsx';
import GenderBanners from '../../components/homepage/GenderBanners.jsx';
import CollectionBanner from '../../components/homepage/CollectionBanner.jsx';
import ProductCarousel from '../../components/homepage/ProductCarousel.jsx';
import { underwearProducts, runningProducts } from '../../data/homeProducts.js';
import CoolClubSection from '../../components/homepage/CoolClubSection.jsx';
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
            <CategoryShowcase />
            <GenderBanners />
            <CollectionBanner
                image="/images/collections/pickleball-banner.jpg"
                alt="Bộ sưu tập Pickleball Coolmate"
                link="/collections/pickleball"
            />
            <ProductCarousel />
            <CollectionBanner
                image="/images/collections/underwear-banner.jpg"
                alt="Bộ sưu tập Pickleball Coolmate"
                link="/collections/pickleball"
            />
            <ProductCarousel
                title="QUẦN LÓT NAM"
                viewAllLink="/collections/quan-lot-nam"
                products={underwearProducts}
            />
            <CollectionBanner
                image="/images/collections/runninggear.jpg"
                alt="Bộ sưu tập Đồ chạy bộ"
                link="/collections/pickleball"
            />
            <ProductCarousel
                title="QUẦN LÓT NAM"
                viewAllLink="/collections/quan-lot-nam"
                products={runningProducts}
            />
            <CoolClubSection />
        </>
    );
}

export default HomePage;