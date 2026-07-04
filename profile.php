<?php
require 'config.php';

// Proteksi Halaman: Hanya user yang login yang bisa masuk
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit;
}

$userId = $_SESSION['user_id'];
$successMsg = '';
$errorMsg = '';

// 1. Proses Update Profil (Nama & Email)
if (isset($_POST['update_profile'])) {
    $newName = trim($_POST['name']);
    $newEmail = trim($_POST['email']);
    
    // Cek apakah email yang baru dimasukkan sudah dipakai oleh user lain
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
    $stmt->execute([$newEmail, $userId]);
    if ($stmt->fetch()) {
        $errorMsg = "Email tersebut sudah digunakan oleh akun lain!";
    } else {
        $stmt = $pdo->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        if($stmt->execute([$newName, $newEmail, $userId])) {
            $_SESSION['user_name'] = $newName; // Update nama di sesi agar navbar ikut berubah
            $successMsg = "Informasi profil Anda berhasil diperbarui!";
        } else {
            $errorMsg = "Terjadi kesalahan saat memperbarui profil.";
        }
    }
}

// 2. Proses Ubah Password
if (isset($_POST['change_password'])) {
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // Ambil password lama dari database
    $stmt = $pdo->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    // Verifikasi password lama
    if (password_verify($oldPassword, $user['password'])) {
        if ($newPassword === $confirmPassword) {
            // Hash password baru dan simpan
            $newHash = password_hash($newPassword, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
            $stmt->execute([$newHash, $userId]);
            $successMsg = "Password keamanan Anda berhasil diubah!";
        } else {
            $errorMsg = "Password baru dan konfirmasi password tidak cocok!";
        }
    } else {
        $errorMsg = "Password saat ini (lama) yang Anda masukkan salah!";
    }
}

// Ambil data user terbaru untuk ditampilkan di form
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$userId]);
$userData = $stmt->fetch();

include 'includes/header.php';
?>

<main class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-black tracking-tight mb-8 text-primary">Pengaturan Akun</h1>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
        
        <div class="lg:col-span-3 bg-white rounded-[32px] p-6 shadow-premium border border-gray-100 lg:sticky lg:top-32">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-14 h-14 bg-primary text-white rounded-full flex items-center justify-center text-2xl font-bold shadow-md">
                    <?= strtoupper(substr($userData['name'], 0, 1)) ?>
                </div>
                <div>
                    <p class="font-bold text-primary line-clamp-1"><?= htmlspecialchars($userData['name']) ?></p>
                    <p class="text-xs font-bold text-secondary uppercase tracking-wider mt-0.5"><?= htmlspecialchars($userData['role']) ?></p>
                </div>
            </div>
            
            <nav class="space-y-2">
                <a href="profile.php" class="flex items-center gap-3 px-4 py-3.5 bg-primary text-white rounded-2xl font-bold text-sm shadow-md transition-all">
                    <i class="ph-bold ph-user"></i> Informasi Profil
                </a>
                <a href="track.php" class="flex items-center gap-3 px-4 py-3.5 text-secondary hover:text-primary hover:bg-gray-50 rounded-2xl font-bold text-sm transition-all">
                    <i class="ph-bold ph-package"></i> Lacak Pesanan
                </a>
                
                <?php if($userData['role'] === 'admin'): ?>
                <a href="admin.php" class="flex items-center gap-3 px-4 py-3.5 text-secondary hover:text-primary hover:bg-gray-50 rounded-2xl font-bold text-sm transition-all">
                    <i class="ph-bold ph-shield-star"></i> Admin Dashboard
                </a>
                <?php endif; ?>
                
                <hr class="border-gray-100 my-4">
                <a href="logout.php" class="flex items-center gap-3 px-4 py-3.5 text-promo hover:bg-red-50 rounded-2xl font-bold text-sm transition-all">
                    <i class="ph-bold ph-sign-out"></i> Keluar Akun
                </a>
            </nav>
        </div>

        <div class="lg:col-span-9 space-y-8">
            
            <?php if($successMsg): ?>
                <div class="bg-green-50 border border-green-200 text-success p-4 rounded-2xl text-sm font-bold flex items-center gap-3 shadow-sm animate-fade-in">
                    <i class="ph-fill ph-check-circle text-2xl"></i> <?= $successMsg ?>
                </div>
            <?php endif; ?>
            <?php if($errorMsg): ?>
                <div class="bg-red-50 border border-red-200 text-promo p-4 rounded-2xl text-sm font-bold flex items-center gap-3 shadow-sm animate-fade-in">
                    <i class="ph-fill ph-warning-circle text-2xl"></i> <?= $errorMsg ?>
                </div>
            <?php endif; ?>

            <div class="bg-white p-8 sm:p-10 rounded-[32px] shadow-premium border border-gray-100">
                <h3 class="text-xl font-bold tracking-tight mb-6 flex items-center gap-2">
                    <i class="ph-duotone ph-identification-card text-2xl text-primary"></i> Data Diri Pribadi
                </h3>
                <form method="POST" class="space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-primary mb-2">Nama Lengkap</label>
                            <input type="text" name="name" value="<?= htmlspecialchars($userData['name']) ?>" required class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-sm font-medium focus:outline-none focus:border-primary focus:bg-white focus:ring-1 focus:ring-primary transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-primary mb-2">Alamat Email</label>
                            <input type="email" name="email" value="<?= htmlspecialchars($userData['email']) ?>" required class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-sm font-medium focus:outline-none focus:border-primary focus:bg-white focus:ring-1 focus:ring-primary transition-all">
                        </div>
                    </div>
                    <div class="flex justify-end pt-2">
                        <button type="submit" name="update_profile" class="w-full sm:w-auto bg-primary text-white px-8 py-3.5 rounded-full font-bold hover:bg-gray-800 transition-all shadow-md">Simpan Perubahan</button>
                    </div>
                </form>
            </div>

            <div class="bg-white p-8 sm:p-10 rounded-[32px] shadow-premium border border-gray-100">
                <h3 class="text-xl font-bold tracking-tight mb-6 flex items-center gap-2">
                    <i class="ph-duotone ph-lock-key text-2xl text-primary"></i> Keamanan & Password
                </h3>
                <form method="POST" class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-primary mb-2">Password Saat Ini</label>
                        <input type="password" name="old_password" required placeholder="Masukkan password lama..." class="w-full sm:w-1/2 bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-sm font-medium focus:outline-none focus:border-primary focus:bg-white focus:ring-1 focus:ring-primary transition-all">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-gray-100">
                        <div>
                            <label class="block text-sm font-bold text-primary mb-2">Password Baru</label>
                            <input type="password" name="new_password" required placeholder="Buat password baru..." class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-sm font-medium focus:outline-none focus:border-primary focus:bg-white focus:ring-1 focus:ring-primary transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-primary mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="confirm_password" required placeholder="Ulangi password baru..." class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-5 py-4 text-sm font-medium focus:outline-none focus:border-primary focus:bg-white focus:ring-1 focus:ring-primary transition-all">
                        </div>
                    </div>
                    <div class="flex justify-end pt-2">
                        <button type="submit" name="change_password" class="w-full sm:w-auto bg-white border-2 border-primary text-primary px-8 py-3.5 rounded-full font-bold hover:bg-primary hover:text-white transition-all shadow-sm">Perbarui Password</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>