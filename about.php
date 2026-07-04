<?php 
// Pastikan file config.php sudah di-require sebelum header
require_once 'config.php'; 
include 'includes/header.php'; 
?>
<main class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <section class="text-center max-w-3xl mx-auto mb-16">
        <span class="text-xs font-bold tracking-widest text-secondary uppercase bg-gray-200/50 px-4 py-1.5 rounded-full inline-block mb-4">Our Story</span>
        <h1 class="text-4xl md:text-5xl font-black tracking-tight mb-6">Mendefinisikan Ulang Gaya Modern Premium</h1>
        <p class="text-gray-600 text-base md:text-lg leading-relaxed">GlobeBuy hadir sejak 2026 untuk memenuhi kebutuhan fashion eksklusif dengan menggabungkan material premium kelas dunia dan potongan siluet kontemporer minimalis.</p>
    </section>

    <section class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-20">
        <div class="h-[450px] rounded-[32px] overflow-hidden shadow-premium bg-gray-300">
            <img src="https://images.unsplash.com/photo-1539533018447-63fcce2678e3?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover object-top" alt="">
        </div>
        <div class="space-y-6">
            <h2 class="text-3xl font-extrabold tracking-tight">Kualitas Tanpa Kompromi</h2>
            <p class="text-secondary leading-relaxed">Setiap benang, kain, dan kancing kemeja linen, hoodie fleece, serta produk luaran kami dipilih melalui proses kontrol kualitas yang ketat. Desain kami fokus pada esensi kenyamanan maksimal saat dipakai di iklim tropis maupun suasana formal semi-kasual.</p>
            <p class="text-secondary leading-relaxed">Kami berkolaborasi dengan pengrajin lokal berbakat tinggi serta manufaktur garmen modern bersertifikasi global untuk memproduksi koleksi terbatas yang tahan lama tanpa merusak ekosistem lingkungan sekitar.</p>
            <div class="grid grid-cols-3 gap-6 pt-4 border-t border-gray-200">
                <div>
                    <h4 class="text-3xl font-black text-primary">45K+</h4>
                    <p class="text-xs font-semibold text-secondary uppercase tracking-wider mt-1">Produk Terjual</p>
                </div>
                <div>
                    <h4 class="text-3xl font-black text-primary">99.8%</h4>
                    <p class="text-xs font-semibold text-secondary uppercase tracking-wider mt-1">Puas Pelanggan</p>
                </div>
                <div>
                    <h4 class="text-3xl font-black text-primary">240+</h4>
                    <p class="text-xs font-semibold text-secondary uppercase tracking-wider mt-1">Koleksi Desain</p>
                </div>
            </div>
        </div>
    </section>
</main>

<?php include 'includes/footer.php'; ?>