<?php
require 'config.php';

// Proteksi agar hanya user yang login yang bisa melihat halaman ini
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit;
}
include 'includes/header.php';

$userId = $_SESSION['user_id'];
// Mengambil data pesanan diurutkan dari yang paling baru
$orders = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
$orders->execute([$userId]);
$orderList = $orders->fetchAll();
?>

<main class="max-w-[1400px] mx-auto px-4 sm:px-6 py-12">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-black tracking-tight text-primary">Riwayat & Lacak Pesanan</h1>
            <p class="text-secondary mt-1">Pantau status pengiriman dan detail pesanan Anda di sini.</p>
        </div>
        <a href="shop.php" class="hidden sm:inline-flex items-center gap-2 bg-white border border-gray-200 px-5 py-2.5 rounded-full text-sm font-bold text-primary hover:bg-gray-50 transition-colors shadow-sm">
            <i class="ph-bold ph-shopping-bag"></i> Lanjut Belanja
        </a>
    </div>
    
    <div class="bg-white rounded-3xl shadow-premium border border-gray-100 overflow-hidden">
        <!-- Wrapper overflow-x-auto agar tabel responsif di layar Mobile -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap sm:whitespace-normal">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="py-4 px-6 font-bold text-primary">Order ID</th>
                        <th class="py-4 px-6 font-bold text-primary">Waktu Order</th>
                        <th class="py-4 px-6 font-bold text-primary min-w-[250px]">Detail Pengiriman & Pembayaran</th>
                        <th class="py-4 px-6 font-bold text-primary">Total Harga</th>
                        <th class="py-4 px-6 font-bold text-primary text-center">Status Paket</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($orderList) > 0): ?>
                        <?php foreach($orderList as $order): ?>
                            <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                                <!-- Order ID -->
                                <td class="py-5 px-6 font-black text-primary">
                                    #ORD-<?= str_pad($order['id'], 4, '0', STR_PAD_LEFT) ?>
                                </td>
                                
                                <!-- Tanggal dan Jam -->
                                <td class="py-5 px-6 text-secondary">
                                    <div class="font-bold text-primary"><?= date('d F Y', strtotime($order['created_at'])) ?></div>
                                    <div class="text-xs mt-0.5 flex items-center gap-1">
                                        <i class="ph-fill ph-clock"></i> <?= date('H:i', strtotime($order['created_at'])) ?> WIB
                                    </div>
                                </td>
                                
                                <!-- Detail Alamat dan Metode Pembayaran -->
                                <td class="py-5 px-6 text-secondary text-xs leading-relaxed">
                                    <!-- Karena sebelumnya sudah kita simpan dengan format HTML <br> dan <b> -->
                                    <?= $order['shipping_address'] ?>
                                </td>
                                
                                <!-- Total Harga -->
                                <td class="py-5 px-6 font-black text-primary text-base">
                                    Rp <?= number_format($order['total'], 0, ',', '.') ?>
                                </td>
                                
                                <!-- Status Badge -->
                                <td class="py-5 px-6 text-center">
                                    <?php 
                                        $colors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                            'processing' => 'bg-blue-100 text-blue-800 border-blue-200',
                                            'shipped' => 'bg-indigo-100 text-indigo-800 border-indigo-200',
                                            'delivered' => 'bg-green-100 text-green-800 border-green-200'
                                        ];
                                        $c = $colors[$order['status']] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                                    ?>
                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-[11px] font-bold uppercase tracking-wider border <?= $c ?>">
                                        <?= $order['status'] ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- State jika keranjang kosong -->
                        <tr>
                            <td colspan="5" class="py-20 text-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="ph-duotone ph-package text-3xl text-secondary"></i>
                                </div>
                                <p class="text-primary font-bold text-lg">Belum ada riwayat pesanan.</p>
                                <p class="text-secondary mt-1">Cari gaya favorit Anda dan mulai berbelanja sekarang!</p>
                                <a href="shop.php" class="inline-block mt-4 bg-primary text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-md hover:bg-gray-800 transition-colors">
                                    Mulai Belanja
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>