<?php 
require 'config.php';
include 'includes/header.php'; 
?>
<main class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-12 pb-24">
    <div class="flex items-center gap-3 mb-8">
        <i class="ph-fill ph-heart text-4xl text-promo"></i>
        <h1 class="text-3xl font-black tracking-tight text-primary">Wishlist Saya</h1>
    </div>
    
    <div id="wishlist-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        </div>
</main>

<script>
    const formatRp = (num) => new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", minimumFractionDigits:0 }).format(num);
    
    function renderWishlistPage() {
        const grid = document.getElementById("wishlist-grid");
        const wList = JSON.parse(localStorage.getItem("globebuy_wishlist")) || [];
        
        if(wList.length === 0) {
            grid.innerHTML = `<div class="col-span-full py-20 text-center"><i class="ph-duotone ph-heart-break text-6xl text-gray-300 mb-4 block"></i><h2 class="text-xl font-bold text-primary mb-2">Wishlist Kosong</h2><p class="text-secondary mb-6">Anda belum menyimpan produk apapun ke wishlist.</p><a href="shop.php" class="bg-primary text-white px-8 py-3.5 rounded-full font-bold shadow-md hover:bg-gray-800 transition-colors">Mulai Belanja</a></div>`;
            return;
        }

        grid.innerHTML = wList.map(p => `
            <div class="bg-white rounded-3xl p-4 shadow-sm border border-gray-100 flex flex-col relative group hover:shadow-md transition-shadow">
                <button onclick="removeWishlistItem(${p.id})" class="absolute top-6 right-6 w-8 h-8 bg-white/90 rounded-full flex items-center justify-center text-promo hover:bg-red-50 z-10 shadow-sm transition-colors"><i class="ph-fill ph-trash text-lg"></i></button>
                <div class="${p.bg_class || 'bg-gray-100'} rounded-2xl overflow-hidden aspect-[4/5] mb-4 flex items-center justify-center relative">
                    <img src="${p.image}" class="w-full h-full object-cover mix-blend-multiply p-4 transition-transform group-hover:scale-105 duration-500">
                </div>
                <div class="flex-1 flex flex-col">
                    <h3 class="font-extrabold text-primary text-[15px] leading-tight mb-2 line-clamp-2">${p.name}</h3>
                    <div class="mt-auto flex justify-between items-center mt-3">
                        <span class="font-black text-primary text-lg">${formatRp(p.price || p.basePrice)}</span>
                        <a href="shop.php?search=${encodeURIComponent(p.name)}" class="w-10 h-10 bg-primary text-white rounded-full flex items-center justify-center hover:bg-gray-800 transition-colors shadow-md" title="Lihat & Beli">
                            <i class="ph-bold ph-shopping-cart text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>
        `).join("");
    }

    function removeWishlistItem(id) {
        let wList = JSON.parse(localStorage.getItem("globebuy_wishlist")) || [];
        wList = wList.filter(item => item.id !== id);
        localStorage.setItem("globebuy_wishlist", JSON.stringify(wList));
        renderWishlistPage();
        
        // Memperbarui notifikasi angka merah di navigasi navbar atas
        const badge = document.getElementById("wishlist-count-badge");
        if(badge) badge.innerText = wList.length;
    }
    
    document.addEventListener("DOMContentLoaded", renderWishlistPage);
</script>

<?php include 'includes/footer.php'; ?>