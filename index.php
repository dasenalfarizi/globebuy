<?php 
// Pastikan file config.php sudah di-require sebelum header
require_once 'config.php'; 
include 'includes/header.php'; 
?>

<main class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 pb-24 pt-6">

    <section class="bg-hero rounded-[32px] w-full flex flex-col md:flex-row items-center justify-between overflow-hidden mb-16 relative px-8 md:px-16 pt-12 md:pt-0 shadow-premium">
        <div class="w-full md:w-[55%] z-10 text-center md:text-left pb-12 md:pb-0 pt-8 md:pt-16 md:pb-16">
            <div class="inline-block px-4 py-1.5 bg-white/60 backdrop-blur-sm rounded-full text-xs font-bold tracking-wider mb-6 text-primary">LIMITED OFFER</div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-[1.1] mb-6 max-w-xl text-primary tracking-tight">
                SAVE UP TO 50% ON YOUR FAVORITE PRODUCTS
            </h1>
            <p class="text-gray-600 mb-8 max-w-md text-sm md:text-base leading-relaxed">Discover the latest trends in men's fashion. Premium quality, comfortable fit, and effortless style.</p>
            <a href="shop.php" class="bg-primary text-white px-10 py-4 rounded-full font-semibold hover:bg-gray-800 transition-all shadow-xl hover:shadow-2xl transform hover:-translate-y-1 duration-300 flex items-center gap-3 mx-auto md:mx-0 w-max">
                Buy Now <i class="ph-bold ph-arrow-right"></i>
            </a>
        </div>
        <div class="w-full md:w-[45%] h-72 md:h-[450px] lg:h-[500px] relative mt-8 md:mt-0 flex justify-center md:justify-end">
            <img src="https://images.unsplash.com/photo-1516257984-b1b4d707412e?auto=format&fit=crop&w=800&q=80" alt="Fashion Model" class="object-cover h-full w-auto object-top absolute bottom-0 right-0 md:right-10 mix-blend-multiply" style="filter: contrast(1.1) brightness(1.05);">
        </div>
    </section>

    <section class="mb-16">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl md:text-3xl font-extrabold tracking-tight">Belanja Berdasarkan Kategori</h2>
            <a href="shop.php" class="text-sm font-bold text-primary hover:underline flex items-center gap-1">Lihat Semua <i class="ph ph-arrow-right"></i></a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="shop.php?category=Men Fashion" class="group relative rounded-3xl overflow-hidden h-64 bg-gray-200 cursor-pointer shadow-sm block">
                <img src="https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent flex items-end p-6">
                    <h3 class="text-white font-bold text-xl">Men Fashion</h3>
                </div>
            </a>
            <a href="shop.php?category=Women Fashion" class="group relative rounded-3xl overflow-hidden h-64 bg-gray-200 cursor-pointer shadow-sm block">
                <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent flex items-end p-6">
                    <h3 class="text-white font-bold text-xl">Women Fashion</h3>
                </div>
            </a>
            <!-- <a href="shop.php?category=Women Fashion" class="group relative rounded-3xl overflow-hidden h-64 bg-gray-200 cursor-pointer shadow-sm block">
                <img src="https://unsplash.com/photos/photo-of-woman-holding-white-and-black-paper-bags-_3Q3tsJ01nc" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent flex items-end p-6">
                    <h3 class="text-white font-bold text-xl">Women Fashion</h3>
                </div>
            </a> -->
            <a href="shop.php?category=Outerwear" class="group relative rounded-3xl overflow-hidden h-64 bg-gray-200 cursor-pointer shadow-sm block">
                <img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" alt="">
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent flex items-end p-6">
                    <h3 class="text-white font-bold text-xl">Outerwear</h3>
                </div>
            </a>
        </div>
    </section>

    <section class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-premium flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center text-2xl text-primary shadow-sm"><i class="ph ph-truck"></i></div>
            <div>
                <h4 class="font-bold text-lg mb-1">Gratis Ongkir</h4>
                <p class="text-secondary text-sm">Pengiriman tanpa biaya ke seluruh wilayah Indonesia.</p>
            </div>
        </div>
        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-premium flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center text-2xl text-primary shadow-sm"><i class="ph ph-arrow-counter-clockwise"></i></div>
            <div>
                <h4 class="font-bold text-lg mb-1">14 Hari Pengembalian</h4>
                <p class="text-secondary text-sm">Garansi penukaran ukuran atau pengembalian dana penuh.</p>
            </div>
        </div>
        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-premium flex items-center gap-5">
            <div class="w-14 h-14 rounded-2xl bg-gray-50 flex items-center justify-center text-2xl text-primary shadow-sm"><i class="ph ph-shield-check"></i></div>
            <div>
                <h4 class="font-bold text-lg mb-1">Pembayaran Aman</h4>
                <p class="text-secondary text-sm">Sistem enkripsi pembayaran digital terproteksi penuh.</p>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>