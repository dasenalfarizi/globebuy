<?php
// Pastikan file config.php sudah di-require sebelum header
require_once 'config.php';
include 'includes/header.php';
?>

<div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-6 text-sm text-secondary font-medium">
    <a href="index.php" class="hover:text-primary cursor-pointer transition-colors">Home</a>
    <span class="mx-2 text-accent">/</span>
    <span class="hover:text-primary cursor-pointer transition-colors">Shop</span>
    <span class="mx-2 text-accent">/</span>
    <span class="text-primary font-bold">All Products</span>
</div>

<main class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 pb-24">
    <div class="flex flex-col lg:flex-row gap-10">

        <!-- SIDEBAR FILTER -->
        <aside id="filter-sidebar" class="w-full lg:w-1/4 flex-shrink-0 hidden lg:block">
            <div class="sticky top-32 space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold tracking-tight">Filter Options</h2>
                </div>

                <div class="bg-card rounded-3xl p-7 shadow-premium border border-gray-100">
                    <h3 class="font-bold text-lg mb-5">Category</h3>
                    <div class="space-y-4 text-[15px] text-secondary">
                        <label class="filter-category flex items-center justify-between cursor-pointer group" data-value="Men Fashion">
                            <div class="flex items-center gap-3">
                                <div class="w-5 h-5 rounded border border-gray-300 group-hover:border-primary transition-colors flex items-center justify-center"></div>
                                <span class="group-hover:text-primary transition-colors font-medium">Men Fashion</span>
                            </div>
                            <span class="text-xs bg-gray-100 px-2 py-0.5 rounded-full font-bold text-gray-500">10</span>
                        </label>
                        <label class="filter-category flex items-center justify-between cursor-pointer group" data-value="Women Fashion">
                            <div class="flex items-center gap-3">
                                <div class="w-5 h-5 rounded border border-gray-300 group-hover:border-primary transition-colors flex items-center justify-center"></div>
                                <span class="group-hover:text-primary transition-colors font-medium">Women Fashion</span>
                            </div>
                            <span class="text-xs bg-gray-100 px-2 py-0.5 rounded-full font-bold text-gray-500">10</span>
                        </label>
                        <label class="filter-category flex items-center justify-between cursor-pointer group" data-value="Outerwear">
                            <div class="flex items-center gap-3">
                                <div class="w-5 h-5 rounded border border-gray-300 group-hover:border-primary transition-colors flex items-center justify-center"></div>
                                <span class="group-hover:text-primary transition-colors font-medium">Outerwear</span>
                            </div>
                            <span class="text-xs bg-gray-100 px-2 py-0.5 rounded-full font-bold text-gray-500">10</span>
                        </label>
                    </div>
                </div>

                <div class="bg-card rounded-3xl p-7 shadow-premium border border-gray-100">
                    <h3 class="font-bold text-lg mb-5">Price Range</h3>
                    <div class="space-y-3">
                        <button class="filter-price w-full bg-gray-50 hover:bg-white hover:border-primary transition-all px-4 py-3 rounded-xl text-center border border-gray-200 text-sm font-semibold text-primary shadow-sm" data-min="0" data-max="200000">
                            Di bawah Rp 200.000
                        </button>
                        <button class="filter-price w-full bg-gray-50 hover:bg-white hover:border-primary transition-all px-4 py-3 rounded-xl text-center border border-gray-200 text-sm font-semibold text-primary shadow-sm" data-min="200000" data-max="500000">
                            Rp 200.000 - Rp 500.000
                        </button>
                        <button class="filter-price w-full bg-gray-50 hover:bg-white hover:border-primary transition-all px-4 py-3 rounded-xl text-center border border-gray-200 text-sm font-semibold text-primary shadow-sm" data-min="500000" data-max="9999999">
                            Di atas Rp 500.000
                        </button>
                    </div>
                </div>

                <div class="bg-card rounded-3xl p-7 shadow-premium border border-gray-100">
                    <h3 class="font-bold text-lg mb-5">Color Swatches</h3>
                    <div class="grid grid-cols-2 gap-y-5 gap-x-2 text-[14px]">
                        <label class="filter-color flex items-center gap-3 cursor-pointer group" data-value="Black">
                            <div class="w-6 h-6 rounded-full bg-black shadow-sm transition-transform group-hover:scale-110"></div>
                            <span class="text-secondary group-hover:text-primary font-medium">Black</span>
                        </label>
                        <label class="filter-color flex items-center gap-3 cursor-pointer group" data-value="Grey">
                            <div class="w-6 h-6 rounded-full bg-gray-400 border border-gray-300 shadow-sm transition-transform group-hover:scale-110"></div>
                            <span class="text-secondary group-hover:text-primary font-medium">Grey</span>
                        </label>
                        <label class="filter-color flex items-center gap-3 cursor-pointer group" data-value="White">
                            <div class="w-6 h-6 rounded-full bg-white border border-gray-300 shadow-sm transition-transform group-hover:scale-110"></div>
                            <span class="text-secondary group-hover:text-primary font-medium">White</span>
                        </label>
                        <label class="filter-color flex items-center gap-3 cursor-pointer group" data-value="Navy">
                            <div class="w-6 h-6 rounded-full bg-[#000080] border border-gray-300 shadow-sm transition-transform group-hover:scale-110"></div>
                            <span class="text-secondary group-hover:text-primary font-medium">Navy</span>
                        </label>
                    </div>
                </div>

                <div class="bg-card rounded-3xl p-7 shadow-premium border border-gray-100">
                    <h3 class="font-bold text-lg mb-5">Size Options</h3>
                    <div class="flex flex-wrap gap-3">
                        <button class="filter-size w-12 h-12 rounded-full border border-gray-200 text-sm font-medium hover:border-primary hover:text-primary transition-all flex items-center justify-center bg-white" data-value="S">S</button>
                        <button class="filter-size w-12 h-12 rounded-full border border-gray-200 text-sm font-medium hover:border-primary hover:text-primary transition-all flex items-center justify-center bg-white" data-value="M">M</button>
                        <button class="filter-size w-12 h-12 rounded-full border border-gray-200 text-sm font-medium hover:border-primary hover:text-primary transition-all flex items-center justify-center bg-white" data-value="L">L</button>
                        <button class="filter-size w-12 h-12 rounded-full border border-gray-200 text-sm font-medium hover:border-primary hover:text-primary transition-all flex items-center justify-center bg-white" data-value="XL">XL</button>
                    </div>
                </div>
            </div>
        </aside>

        <!-- RIGHT CONTENT -->
        <div class="w-full lg:w-3/4">

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4 bg-white p-4 rounded-2xl shadow-sm border border-gray-100">
                <p class="text-[15px] text-secondary font-medium">Menampilkan Koleksi Fashion Premium</p>
                <div class="flex items-center gap-3 w-full sm:w-auto justify-between sm:justify-start">
                    <button onclick="toggleMobileFilters()" class="lg:hidden flex items-center gap-2 px-5 py-2.5 bg-white border border-gray-200 rounded-full font-bold text-sm shadow-sm">
                        <i class="ph ph-sliders"></i> Filters
                    </button>
                    <div class="flex items-center gap-3">
                        <span class="text-[14px] text-secondary hidden sm:inline">Sort by:</span>
                        <select id="sort-select" onchange="changeSort(this.value)" class="bg-gray-50 border border-gray-200 rounded-full px-4 py-2.5 text-sm font-semibold text-primary hover:bg-white focus:outline-primary transition-all cursor-pointer">
                            <option value="newest">Terbaru</option>
                            <option value="price_asc">Harga: Rendah ke Tinggi</option>
                            <option value="price_desc">Harga: Tinggi ke Rendah</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Active Filters Chip Container -->
            <div id="active-filters-container" class="flex flex-wrap items-center gap-3 mb-8 text-sm hidden">
            </div>

            <!-- Product Grid -->
            <div id="product-grid" class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                <div class="col-span-full py-20 text-center text-secondary">
                    <i class="ph-duotone ph-spinner-gap animate-spin text-4xl mb-4 text-primary"></i>
                    <p class="font-medium">Memuat koleksi produk...</p>
                </div>
            </div>

            <!-- Pagination Container (Aktif untuk diinjeksi JS) -->
            <div id="pagination-container" class="flex justify-center items-center mt-16 gap-2.5 pb-8">
                <!-- Tombol dinamis akan dibuat oleh main.js -->
            </div>

        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>