<?php 
require 'config.php';
// Proteksi Halaman: Harus Login
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit;
}

// Proses pembuatan order
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_SESSION['user_id'];
    
    // Menangkap metode pembayaran dan menggabungkannya ke data pengiriman agar terlihat di Admin
    $paymentMethod = $_POST['payment_method'] ?? 'Tidak Diketahui';
    $address = $_POST['address'] . "<br><b>Telp:</b> " . $_POST['phone'] . "<br><b>Metode Pembayaran:</b> " . $paymentMethod;
    
    $cartData = json_decode($_POST['cart_data'], true);
    
    if ($cartData && count($cartData) > 0) {
        $total = 0;
        foreach($cartData as $item) {
            $total += ($item['price'] * $item['quantity']);
        }

        $stmt = $pdo->prepare("INSERT INTO orders (user_id, total, shipping_address) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $total, $address]);
        $orderId = $pdo->lastInsertId();

        $stmtItem = $pdo->prepare("INSERT INTO order_items (order_id, product_name, price, quantity, size) VALUES (?, ?, ?, ?, ?)");
        foreach($cartData as $item) {
            $stmtItem->execute([$orderId, $item['product']['name'], $item['price'], $item['quantity'], $item['size']]);
        }
        
        // Hapus cart via JS di halaman sukses, redirect
        echo "<script>localStorage.removeItem('globebuy_cart'); window.location.href='track.php';</script>";
        exit;
    }
}
include 'includes/header.php'; 
?>

<main class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-black tracking-tight mb-8">Formulir Checkout Pembayaran</h1>
    
    <div class="bg-blue-50 border border-blue-200 text-blue-800 p-4 rounded-2xl mb-8 flex items-start gap-3">
        <i class="ph-fill ph-info text-2xl text-blue-500"></i>
        <div>
            <h4 class="font-bold text-sm">Mode Simulasi Uji Coba</h4>
            <p class="text-xs mt-1 font-medium">Jangan khawatir, ini adalah project simulasi. Mengisi formulir ini <b>tidak akan melakukan penagihan uang asli</b>. Silakan isi asal-asalan untuk mempraktekkan alur e-commerce.</p>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
        <div class="lg:col-span-7 bg-card rounded-[32px] p-6 sm:p-8 shadow-premium border border-gray-100">
            
            <form id="checkout-form" method="POST" class="space-y-8">
                <input type="hidden" name="cart_data" id="cart_data_input">
                
                <div>
                    <h3 class="text-xl font-bold tracking-tight mb-6 flex items-center gap-2 text-primary">
                        <i class="ph ph-user-circle text-2xl"></i> Data Pengiriman
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-bold text-primary mb-2">Nama Penerima</label>
                            <input type="text" required value="<?= htmlspecialchars($_SESSION['user_name']) ?>" class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3.5 text-sm font-medium focus:outline-none focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-primary mb-2">Nomor Telepon Seluler</label>
                            <input type="tel" name="phone" required class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3.5 text-sm font-medium focus:outline-none focus:border-primary">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-primary mb-2">Alamat Lengkap</label>
                        <textarea name="address" rows="4" required class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3.5 text-sm font-medium focus:outline-none focus:border-primary resize-none"></textarea>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-100">
                    <h3 class="text-xl font-bold tracking-tight mb-6 flex items-center gap-2 text-primary">
                        <i class="ph ph-wallet text-2xl"></i> Metode Pembayaran
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        
                        <label class="payment-card border-2 border-primary bg-white rounded-2xl p-4 flex flex-col justify-between h-28 cursor-pointer relative shadow-sm transition-all">
                            <input type="radio" name="payment_method" value="E-Wallet (GoPay/Dana)" checked class="absolute top-4 right-4 accent-primary payment-radio">
                            <i class="ph-fill ph-device-mobile text-3xl text-primary icon-target"></i>
                            <span class="text-sm font-bold mt-2 text-primary text-target">E-Wallet (GoPay/OVO)</span>
                        </label>
                        
                        <label class="payment-card border border-gray-200 bg-white rounded-2xl p-4 flex flex-col justify-between h-28 cursor-pointer relative hover:border-gray-400 transition-all">
                            <input type="radio" name="payment_method" value="Transfer Bank VA" class="absolute top-4 right-4 accent-primary payment-radio">
                            <i class="ph-fill ph-bank text-3xl text-secondary icon-target transition-colors"></i>
                            <span class="text-sm font-bold mt-2 text-secondary text-target transition-colors">Transfer Bank VA</span>
                        </label>
                        
                        <label class="payment-card border border-gray-200 bg-white rounded-2xl p-4 flex flex-col justify-between h-28 cursor-pointer relative hover:border-gray-400 transition-all">
                            <input type="radio" name="payment_method" value="QRIS Otomatis" class="absolute top-4 right-4 accent-primary payment-radio">
                            <i class="ph-bold ph-qr-code text-3xl text-secondary icon-target transition-colors"></i>
                            <span class="text-sm font-bold mt-2 text-secondary text-target transition-colors">QRIS Otomatis</span>
                        </label>

                    </div>
                </div>

                <button type="submit" class="hidden" id="real-submit-btn"></button>
            </form>
        </div>

        <div class="lg:col-span-5 bg-white rounded-[32px] p-6 sm:p-8 shadow-premium border border-gray-100 lg:sticky lg:top-32">
            <h3 class="text-xl font-bold tracking-tight mb-6">Ringkasan Pesanan</h3>
            <div id="checkout-items-list" class="divide-y divide-gray-100 overflow-y-auto max-h-[40vh] pr-2 cart-scroll mb-6">
            </div>
            <div class="space-y-4 border-t border-gray-100 pt-6 font-medium text-sm text-secondary">
                <div class="flex justify-between">
                    <p>Subtotal Belanja</p>
                    <p id="checkout-subtotal" class="font-bold text-primary">Rp 0</p>
                </div>
                <div class="flex justify-between">
                    <p>Biaya Layanan</p>
                    <p class="font-bold text-primary">Gratis</p>
                </div>
                <div class="flex justify-between text-lg font-black text-primary pt-2 border-t border-gray-100">
                    <p>Total Akhir Tagihan</p>
                    <p id="checkout-total">Rp 0</p>
                </div>
            </div>
            <button type="button" onclick="submitCheckout()" class="w-full bg-primary text-white font-bold py-4 rounded-full shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2 mt-8 text-[15px]">
                <i class="ph-bold ph-check-circle text-xl"></i> Selesaikan Pesanan Saya
            </button>
        </div>
    </div>
</main>

<script>
    // Logika UI untuk merubah warna Card Metode Pembayaran saat dipilih
    document.addEventListener('DOMContentLoaded', () => {
        const radios = document.querySelectorAll('.payment-radio');
        const cards = document.querySelectorAll('.payment-card');

        radios.forEach(radio => {
            radio.addEventListener('change', function() {
                // Reset semua card ke tampilan abu-abu (tidak aktif)
                cards.forEach(card => {
                    card.classList.remove('border-2', 'border-primary', 'shadow-sm');
                    card.classList.add('border', 'border-gray-200');
                    card.querySelector('.icon-target').classList.replace('text-primary', 'text-secondary');
                    card.querySelector('.text-target').classList.replace('text-primary', 'text-secondary');
                });

                // Set card yang diklik ke tampilan biru (aktif)
                const activeCard = this.closest('.payment-card');
                activeCard.classList.remove('border', 'border-gray-200');
                activeCard.classList.add('border-2', 'border-primary', 'shadow-sm');
                activeCard.querySelector('.icon-target').classList.replace('text-secondary', 'text-primary');
                activeCard.querySelector('.text-target').classList.replace('text-secondary', 'text-primary');
            });
        });
    });

    // Logika merender Keranjang
    window.addEventListener('DOMContentLoaded', () => {
        const localCart = JSON.parse(localStorage.getItem('globebuy_cart')) || [];
        const container = document.getElementById('checkout-items-list');
        document.getElementById('cart_data_input').value = JSON.stringify(localCart);
        let subtotal = 0;

        if (localCart.length === 0) {
            container.innerHTML = `<p class="text-sm text-secondary py-4 text-center">Keranjang kosong.</p>`;
            return;
        }

        container.innerHTML = localCart.map(item => {
            const itemTotal = item.price * item.quantity;
            subtotal += itemTotal;
            return `
                <div class="flex items-center justify-between py-4 text-sm font-medium">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-gray-50 flex-shrink-0 flex items-center justify-center">
                            <img src="${item.product.image}" class="mix-blend-multiply max-h-full max-w-full">
                        </div>
                        <div>
                            <h5 class="text-primary font-bold line-clamp-1">${item.product.name}</h5>
                            <p class="text-xs text-secondary mt-0.5">Size: ${item.size} × ${item.quantity}</p>
                        </div>
                    </div>
                    <p class="font-bold text-primary ml-4">${new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(itemTotal)}</p>
                </div>
            `;
        }).join('');
        document.getElementById('checkout-subtotal').innerText = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(subtotal);
        document.getElementById('checkout-total').innerText = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(subtotal);
    });

    function submitCheckout() {
        const cart = JSON.parse(localStorage.getItem('globebuy_cart')) || [];
        if(cart.length === 0) {
            alert('Keranjang belanja kosong!');
            return;
        }
        document.getElementById('real-submit-btn').click();
    }
</script>
<?php include 'includes/footer.php'; ?>