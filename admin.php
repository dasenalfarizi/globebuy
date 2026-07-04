<?php
// Pastikan file config.php sudah di-require sebelum header
require_once 'config.php';
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
    die("Akses ditolak! Anda bukan admin.");
}

// 1. Handle Update Status Order
if (isset($_POST['update_order'])) {
    $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->execute([$_POST['status'], $_POST['order_id']]);
    header("Location: admin.php?tab=orders");
    exit;
}

// 2. Handle Hapus Produk
if (isset($_GET['delete_product'])) {
    $stmt = $pdo->prepare("SELECT image FROM products WHERE id = ?");
    $stmt->execute([$_GET['delete_product']]);
    $product = $stmt->fetch();
    if ($product && file_exists($product['image'])) unlink($product['image']);
    $pdo->prepare("DELETE FROM products WHERE id = ?")->execute([$_GET['delete_product']]);
    header("Location: admin.php");
    exit;
}

// 3. Handle Simpan/Update Produk (DENGAN KEAMANAN EKSTRA)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_product'])) {
    $id = $_POST['product_id'] ?? null;
    $sku = $_POST['sku'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $sizesJson = json_encode(array_map('trim', explode(',', $_POST['sizes'])));
    $colorsArray = array_map('trim', explode(',', $_POST['colors']));
    $colorsJsonArr = [];
    foreach ($colorsArray as $c) {
        $colorsJsonArr[] = ["name" => $c, "hex" => "#000000"];
    }
    $colorsJson = json_encode($colorsJsonArr);

    $imagePath = $_POST['existing_image'] ?? '';
    
    // SISTEM KEAMANAN UPLOAD GAMBAR
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $fileName = $_FILES['image']['name'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $fileSize = $_FILES['image']['size'];

        // Cek ekstensi file dan ukuran (Maksimal 3MB = 3.000.000 byte)
        if (in_array($fileExt, $allowedExtensions) && $fileSize <= 3000000) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            $targetFilePath = $uploadDir . time() . '_' . basename($fileName);
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
                if ($imagePath && file_exists($imagePath)) unlink($imagePath); // Hapus foto lama
                $imagePath = $targetFilePath;
            }
        } else {
            die("
                <div style='text-align:center; margin-top:50px; font-family:sans-serif;'>
                    <h2 style='color:red;'>Upload Produk Gagal!</h2>
                    <p>Demi keamanan, format gambar harus <b>JPG, PNG, atau WEBP</b> dan ukuran file maksimal <b>3MB</b>.</p>
                    <a href='admin.php' style='display:inline-block; margin-top:15px; padding:10px 20px; background:#111827; color:white; text-decoration:none; border-radius:50px;'>Kembali ke Panel Admin</a>
                </div>
            ");
        }
    }

    if ($id) {
        $stmt = $pdo->prepare("UPDATE products SET sku=?, name=?, category=?, price=?, description=?, image=?, sizes=?, colors=? WHERE id=?");
        $stmt->execute([$sku, $name, $category, $price, $description, $imagePath, $sizesJson, $colorsJson, $id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO products (sku, name, category, price, description, image, sizes, colors) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$sku, $name, $category, $price, $description, $imagePath, $sizesJson, $colorsJson]);
    }
    header("Location: admin.php");
    exit;
}

$tab = $_GET['tab'] ?? 'products';
$editProduct = null;
if (isset($_GET['edit_product'])) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$_GET['edit_product']]);
    $editProduct = $stmt->fetch();
}

$products = $pdo->query("SELECT * FROM products ORDER BY id DESC")->fetchAll();
$orders = $pdo->query("SELECT orders.*, users.name as user_name FROM orders JOIN users ON orders.user_id = users.id ORDER BY orders.created_at DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - GlobeBuy</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'], },
                    colors: { primary: '#111827', secondary: '#6B7280', background: '#F5F5F3', card: '#FFFFFF', promo: '#EF4444', success: '#10B981', },
                    boxShadow: { 'premium': '0 10px 30px rgba(0,0,0,0.02)', },
                    borderRadius: { '3xl': '1.5rem', },
                }
            }
        }
    </script>
    <style> body { background-color: #F5F5F3; -webkit-font-smoothing: antialiased; } </style>
</head>

<body class="text-primary font-sans p-4 sm:p-8">
    <div class="max-w-[1400px] mx-auto">

        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4 bg-white p-6 rounded-3xl shadow-premium border border-gray-100">
            <h1 class="text-2xl font-black flex items-center gap-3">
                <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white"><i class="ph-fill ph-planet text-xl"></i></div>
                GlobeBuy Admin
            </h1>
            <div class="flex items-center gap-2 sm:gap-6 text-sm font-bold">
                <a href="?tab=products" class="px-4 py-2 rounded-full transition-all <?= $tab == 'products' ? 'bg-primary text-white' : 'text-secondary hover:bg-gray-100' ?>">Manajemen Produk</a>
                <a href="?tab=orders" class="px-4 py-2 rounded-full transition-all <?= $tab == 'orders' ? 'bg-primary text-white' : 'text-secondary hover:bg-gray-100' ?>">Pesanan Masuk</a>
                <div class="w-px h-6 bg-gray-200 hidden sm:block"></div>
                <a href="index.php" class="text-secondary hover:text-primary flex items-center gap-2"><i class="ph-bold ph-storefront"></i> Lihat Web</a>
            </div>
        </div>

        <?php if ($tab == 'products'): ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                <div class="bg-white p-8 rounded-3xl shadow-premium border border-gray-100">
                    <h2 class="text-xl font-bold mb-6 flex items-center gap-2 text-primary">
                        <i class="ph-bold <?= $editProduct ? 'ph-pencil-simple' : 'ph-plus-circle' ?> text-2xl"></i>
                        <?= $editProduct ? 'Edit Data Produk' : 'Tambah Produk Baru' ?>
                    </h2>
                    <form method="POST" enctype="multipart/form-data" class="space-y-5 text-sm">
                        <?php if ($editProduct): ?>
                            <input type="hidden" name="product_id" value="<?= $editProduct['id'] ?>">
                            <input type="hidden" name="existing_image" value="<?= $editProduct['image'] ?>">
                        <?php endif; ?>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold mb-2 text-primary">SKU Code</label>
                                <input type="text" name="sku" value="<?= $editProduct['sku'] ?? '' ?>" required class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus:bg-white focus:outline-primary transition-all">
                            </div>
                            <div>
                                <label class="block font-bold mb-2 text-primary">Kategori</label>
                                <select name="category" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus:bg-white focus:outline-primary transition-all">
                                    <option value="Men Fashion" <?= ($editProduct['category'] ?? '') == 'Men Fashion' ? 'selected' : '' ?>>Men Fashion</option>
                                    <option value="Women Fashion" <?= ($editProduct['category'] ?? '') == 'Women Fashion' ? 'selected' : '' ?>>Women Fashion</option>
                                    <option value="Outerwear" <?= ($editProduct['category'] ?? '') == 'Outerwear' ? 'selected' : '' ?>>Outerwear</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-primary">Nama Produk</label>
                            <input type="text" name="name" value="<?= $editProduct['name'] ?? '' ?>" required class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus:bg-white focus:outline-primary transition-all">
                        </div>
                        <div>
                            <label class="block font-bold mb-2 text-primary">Harga Dasar (Rp)</label>
                            <input type="number" name="price" value="<?= $editProduct['price'] ?? '' ?>" required class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus:bg-white focus:outline-primary transition-all">
                        </div>
                        <div>
                            <label class="block font-bold mb-2 text-primary">Deskripsi Lengkap</label>
                            <textarea name="description" rows="3" required class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus:bg-white focus:outline-primary transition-all resize-none"><?= $editProduct['description'] ?? '' ?></textarea>
                        </div>

                        <div>
                            <label class="block font-bold mb-2 text-primary">Foto Produk <?= $editProduct ? '(Abaikan jika tidak diubah)' : '' ?></label>
                            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp" <?= $editProduct ? '' : 'required' ?> class="w-full border border-gray-200 rounded-xl px-4 py-2 bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-primary file:text-white cursor-pointer hover:file:bg-gray-800">
                        </div>

                        <?php
                        $sVal = $editProduct ? implode(', ', json_decode($editProduct['sizes'])) : '';
                        $cArr = $editProduct ? json_decode($editProduct['colors'], true) : [];
                        $cVal = implode(', ', array_column($cArr, 'name'));
                        ?>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block font-bold mb-2 text-primary">Ukuran (ex: S, M, L)</label>
                                <input type="text" name="sizes" value="<?= $sVal ?>" required class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus:bg-white focus:outline-primary transition-all">
                            </div>
                            <div>
                                <label class="block font-bold mb-2 text-primary">Warna (ex: Black, Red)</label>
                                <input type="text" name="colors" value="<?= $cVal ?>" required class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-gray-50 focus:bg-white focus:outline-primary transition-all">
                            </div>
                        </div>

                        <button type="submit" name="save_product" class="w-full bg-primary text-white font-bold py-4 rounded-xl shadow-md hover:shadow-lg hover:bg-gray-800 transition-all mt-4">
                            Simpan Produk
                        </button>
                        <?php if ($editProduct): ?>
                            <a href="admin.php" class="block text-center mt-3 text-secondary font-bold hover:text-primary">Batalkan Edit</a>
                        <?php endif; ?>
                    </form>
                </div>

                <div class="lg:col-span-2 bg-white p-8 rounded-3xl shadow-premium border border-gray-100 overflow-x-auto">
                    <h2 class="text-xl font-bold mb-6 text-primary flex items-center gap-2"><i class="ph-bold ph-list-dashes text-2xl"></i> Daftar Koleksi Produk</h2>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b-2 border-gray-100 text-secondary text-sm">
                                <th class="py-4 px-2 font-bold">Produk</th>
                                <th class="py-4 px-2 font-bold">Kategori / SKU</th>
                                <th class="py-4 px-2 font-bold">Harga</th>
                                <th class="py-4 px-2 text-right font-bold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            <?php foreach ($products as $p): ?>
                                <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-2 flex gap-4 items-center">
                                        <div class="w-14 h-14 bg-gray-100 rounded-xl p-1 flex items-center justify-center border border-gray-200">
                                            <img src="<?= htmlspecialchars($p['image']) ?>" class="max-w-full max-h-full object-contain mix-blend-multiply">
                                        </div>
                                        <p class="font-bold text-primary"><?= htmlspecialchars($p['name']) ?></p>
                                    </td>
                                    <td class="py-4 px-2">
                                        <span class="bg-gray-100 text-secondary px-2 py-1 rounded-md text-xs font-bold"><?= htmlspecialchars($p['category']) ?></span>
                                        <div class="mt-1 text-xs text-secondary font-medium">#<?= htmlspecialchars($p['sku']) ?></div>
                                    </td>
                                    <td class="py-4 px-2 font-black text-primary">Rp <?= number_format($p['price'], 0, ',', '.') ?></td>
                                    <td class="py-4 px-2 text-right space-x-2 whitespace-nowrap">
                                        <a href="?edit_product=<?= $p['id'] ?>" class="text-blue-500 hover:bg-blue-50 p-2 rounded-lg inline-block transition-colors"><i class="ph-bold ph-pencil-simple text-xl"></i></a>
                                        <a href="?delete_product=<?= $p['id'] ?>" onclick="return confirm('Hapus produk secara permanen?')" class="text-promo hover:bg-red-50 p-2 rounded-lg inline-block transition-colors"><i class="ph-bold ph-trash text-xl"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php elseif ($tab == 'orders'): ?>
            <div class="bg-white p-8 rounded-3xl shadow-premium border border-gray-100 overflow-x-auto">
                <h2 class="text-xl font-bold mb-6 text-primary flex items-center gap-2"><i class="ph-bold ph-package text-2xl"></i> Manajemen Order Pelanggan</h2>
                <table class="w-full text-left text-sm border-collapse">
                    <thead>
                        <tr class="border-b-2 border-gray-100 text-secondary">
                            <th class="py-4 px-3 font-bold">ID Transaksi</th>
                            <th class="py-4 px-3 font-bold">Detail Pelanggan</th>
                            <th class="py-4 px-3 font-bold min-w-[200px]">Alamat Pengiriman</th>
                            <th class="py-4 px-3 font-bold">Total Nilai</th>
                            <th class="py-4 px-3 font-bold">Status</th>
                            <th class="py-4 px-3 font-bold text-right">Perbarui Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $o): ?>
                            <tr class="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-3 font-black text-primary">#ORD-<?= str_pad($o['id'], 4, '0', STR_PAD_LEFT) ?></td>
                                <td class="py-4 px-3">
                                    <p class="font-bold text-primary"><?= htmlspecialchars($o['user_name']) ?></p>
                                    <p class="text-xs text-secondary mt-0.5"><?= date('d M Y, H:i', strtotime($o['created_at'])) ?></p>
                                </td>
                                <td class="py-4 px-3 text-xs leading-relaxed text-secondary font-medium">
                                    <?= nl2br(htmlspecialchars($o['shipping_address'])) ?>
                                </td>
                                <td class="py-4 px-3 font-black text-primary whitespace-nowrap">Rp <?= number_format($o['total'], 0, ',', '.') ?></td>
                                <td class="py-4 px-3">
                                    <?php
                                    $c = 'bg-gray-100 text-gray-800';
                                    if ($o['status'] == 'pending') $c = 'bg-yellow-100 text-yellow-800';
                                    if ($o['status'] == 'processing') $c = 'bg-blue-100 text-blue-800';
                                    if ($o['status'] == 'shipped') $c = 'bg-indigo-100 text-indigo-800';
                                    if ($o['status'] == 'delivered') $c = 'bg-green-100 text-green-800';
                                    ?>
                                    <span class="px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider <?= $c ?>"><?= $o['status'] ?></span>
                                </td>
                                <td class="py-4 px-3 text-right">
                                    <form method="POST" class="flex justify-end gap-2">
                                        <input type="hidden" name="order_id" value="<?= $o['id'] ?>">
                                        <select name="status" class="border border-gray-200 rounded-lg px-3 py-2 bg-white text-xs font-bold text-primary focus:outline-primary">
                                            <option value="pending" <?= $o['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                            <option value="processing" <?= $o['status'] == 'processing' ? 'selected' : '' ?>>Processing</option>
                                            <option value="shipped" <?= $o['status'] == 'shipped' ? 'selected' : '' ?>>Shipped</option>
                                            <option value="delivered" <?= $o['status'] == 'delivered' ? 'selected' : '' ?>>Delivered</option>
                                        </select>
                                        <button type="submit" name="update_order" class="bg-primary text-white px-4 py-2 rounded-lg text-xs font-bold hover:bg-gray-800 transition-colors">Simpan</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>