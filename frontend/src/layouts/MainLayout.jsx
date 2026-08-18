import { Outlet } from "react-router-dom";
import Header from "../components/layout/Header/header"
import Footer from "../components/layout/Footer/footer"

function MainLayout(){
    return(
        <>
        <Header />
        <main>
            <Outlet />
        </main>
        <Footer />
        </>
    )
}
export default MainLayout;