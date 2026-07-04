<?php 
require 'config.php';
include 'includes/header.php'; 
?>
<main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16 pb-32">
    <div class="text-center mb-12">
        <h1 class="text-4xl font-black tracking-tight text-primary mb-4">Pusat Bantuan (FAQ)</h1>
        <p class="text-secondary text-lg">Temukan jawaban atas pertanyaan yang sering diajukan pelanggan kami.</p>
    </div>

    <div class="space-y-4">
        <div class="bg-white border border-gray-200 rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all">
            <button onclick="toggleFAQ(this)" class="w-full text-left px-8 py-6 flex justify-between items-center focus:outline-none">
                <span class="font-bold text-lg text-primary">Berapa lama estimasi pengiriman barang?</span>
                <i class="ph-bold ph-caret-down text-xl text-secondary transition-transform duration-300"></i>
            </button>
            <div class="faq-content max-h-0 overflow-hidden transition-all duration-300 bg-gray-50/50">
                <p class="px-8 pb-6 text-secondary leading-relaxed text-sm font-medium">
                    Pengiriman reguler biasanya memakan waktu 2-3 hari kerja untuk wilayah Jabodetabek, dan 3-7 hari kerja untuk luar pulau Jawa. Anda bisa melacak resi langsung di menu <b>Track Order</b> yang ada pada ikon profil di navigasi.
                </p>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all">
            <button onclick="toggleFAQ(this)" class="w-full text-left px-8 py-6 flex justify-between items-center focus:outline-none">
                <span class="font-bold text-lg text-primary">Apakah saya harus login untuk berbelanja?</span>
                <i class="ph-bold ph-caret-down text-xl text-secondary transition-transform duration-300"></i>
            </button>
            <div class="faq-content max-h-0 overflow-hidden transition-all duration-300 bg-gray-50/50">
                <p class="px-8 pb-6 text-secondary leading-relaxed text-sm font-medium">
                    Ya. Anda dapat memasukkan barang ke keranjang terlebih dahulu (Guest Mode), namun untuk alasan keamanan data pribadi dan pencatatan resi pesanan, Anda diwajibkan melakukan pendaftaran atau login sebelum dapat mengakses halaman Checkout.
                </p>
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-3xl overflow-hidden shadow-sm hover:shadow-md transition-all">
            <button onclick="toggleFAQ(this)" class="w-full text-left px-8 py-6 flex justify-between items-center focus:outline-none">
                <span class="font-bold text-lg text-primary">Bagaimana kebijakan pengembalian barang (Return)?</span>
                <i class="ph-bold ph-caret-down text-xl text-secondary transition-transform duration-300"></i>
            </button>
            <div class="faq-content max-h-0 overflow-hidden transition-all duration-300 bg-gray-50/50">
                <p class="px-8 pb-6 text-secondary leading-relaxed text-sm font-medium">
                    Kami memberikan garansi penukaran selama 14 hari sejak barang diterima. Jika ukuran baju kebesaran/kekecilan atau terdapat cacat produksi dari pabrik, silakan hubungi tim CS kami melalui halaman <b>Contact</b> untuk pengembalian gratis!
                </p>
            </div>
        </div>
    </div>
</main>

<script>
    function toggleFAQ(element) {
        const content = element.nextElementSibling;
        const icon = element.querySelector('.ph-caret-down');
        
        // Menutup semua FAQ yang sedang terbuka (agar tidak menumpuk)
        document.querySelectorAll('.faq-content').forEach(el => {
            if(el !== content) {
                el.style.maxHeight = null;
                el.previousElementSibling.querySelector('.ph-caret-down').style.transform = "rotate(0deg)";
            }
        });

        // Toggle Buka / Tutup pada FAQ yang sedang di-klik
        if (content.style.maxHeight) {
            content.style.maxHeight = null;
            icon.style.transform = "rotate(0deg)";
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
            icon.style.transform = "rotate(180deg)";
        }
    }
</script>

<?php include 'includes/footer.php'; ?>