<?php include 'includes/header.php'; ?>

<main class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <section class="text-center max-w-2xl mx-auto mb-16">
        <h1 class="text-4xl font-black tracking-tight mb-4">Hubungi Tim Kami</h1>
        <p class="text-gray-600">Ada pertanyaan mengenai produk, panduan ukuran, konfirmasi pesanan, atau kolaborasi bisnis khusus?</p>
    </section>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        <div class="lg:col-span-7 bg-card rounded-[32px] p-8 sm:p-10 shadow-premium border border-gray-100">
            <h3 class="text-2xl font-bold tracking-tight mb-6">Kirim Pesan Langsung</h3>
            <form class="space-y-6" onsubmit="event.preventDefault(); alert('Pesan Anda berhasil dikirim!');">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-primary mb-2">Nama Depan</label>
                        <input type="text" required class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-sm font-medium focus:outline-none focus:border-primary focus:bg-white transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-primary mb-2">Nama Belakang</label>
                        <input type="text" required class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-sm font-medium focus:outline-none focus:border-primary focus:bg-white transition-all">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-primary mb-2">Alamat Email Resmi</label>
                    <input type="email" required class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-sm font-medium focus:outline-none focus:border-primary focus:bg-white transition-all">
                </div>
                <div>
                    <label class="block text-sm font-bold text-primary mb-2">Isi Pesan Detail Anda</label>
                    <textarea rows="5" required class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-sm font-medium focus:outline-none focus:border-primary focus:bg-white transition-all resize-none"></textarea>
                </div>
                <button type="submit" class="w-full bg-primary text-white py-4 rounded-full font-bold hover:bg-gray-800 transition-all shadow-lg hover:shadow-xl">Kirim Formulir Kontak</button>
            </form>
        </div>

        <div class="lg:col-span-5 space-y-6">
            <div class="bg-card rounded-[32px] p-8 shadow-premium border border-gray-100 flex items-start gap-5">
                <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center text-xl border border-gray-100 flex-shrink-0 text-primary"><i class="ph ph-chat-circle"></i></div>
                <div>
                    <h4 class="font-bold text-lg mb-1">Dukungan Obrolan Live</h4>
                    <p class="text-secondary text-sm mb-2">Respon cepat via live chat WhatsApp.</p>
                    <span class="text-sm font-bold text-primary hover:underline cursor-pointer">+62 812-3456-7890</span>
                </div>
            </div>
            <div class="bg-card rounded-[32px] p-8 shadow-premium border border-gray-100 flex items-start gap-5">
                <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center text-xl border border-gray-100 flex-shrink-0 text-primary"><i class="ph ph-envelope"></i></div>
                <div>
                    <h4 class="font-bold text-lg mb-1">Korespondensi Email</h4>
                    <p class="text-secondary text-sm mb-2">Tim support kami membalas maksimal dalam 24 jam kerja.</p>
                    <span class="text-sm font-bold text-primary hover:underline cursor-pointer">support@globebuy.com</span>
                </div>
            </div>
            <div class="bg-card rounded-[32px] p-8 shadow-premium border border-gray-100 flex items-start gap-5">
                <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center text-xl border border-gray-100 flex-shrink-0 text-primary"><i class="ph ph-buildings"></i></div>
                <div>
                    <h4 class="font-bold text-lg mb-1">Kantor Pusat Showroom</h4>
                    <p class="text-secondary text-sm leading-relaxed">Jl. Fashion Premium No. 1, Jakarta Selatan, DKI Jakarta, 12190, Indonesia.</p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>