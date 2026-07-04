<?php
require 'config.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$error = '';
$success = '';
$active_tab = 'login'; // Default tab

// Logika Proses Register
if (isset($_POST['register'])) {
    $active_tab = 'signup'; // Tetap di tab signup jika ada proses
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $error = "Email sudah terdaftar!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $password]);
        $success = "Pendaftaran berhasil! Silakan Login.";
        $active_tab = 'login'; // Pindah ke login setelah sukses
    }
}

// Logika Proses Login
if (isset($_POST['login'])) {
    $active_tab = 'login';
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_start(); // Pastikan session_start dipanggil sebelum setting variable
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];

        // Debug: Coba tambahkan ini untuk tes apakah sesi terbaca
        // var_dump($_SESSION); die(); 

        header("Location: index.php");
        exit;
    }
}

include 'includes/header.php';
?>

<main class="max-w-[450px] mx-auto px-4 py-16">
    <div id="login-form" class="<?= $active_tab == 'login' ? '' : 'hidden' ?> bg-white p-8 rounded-3xl shadow-premium border border-gray-100">
        <h2 class="text-2xl font-bold text-primary mb-6">Sign In</h2>
        <?php if ($error && $active_tab == 'login'): ?>
            <div class="bg-red-50 text-promo p-3 rounded-lg mb-4 text-sm font-medium"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" class="space-y-4">
            <input type="email" name="email" placeholder="Email" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-primary">
            <input type="password" name="password" placeholder="Password" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 focus:outline-primary">
            <button type="submit" name="login" class="w-full bg-primary text-white font-bold py-3.5 rounded-xl hover:bg-gray-800 transition-all">Masuk</button>
        </form>
        <p class="mt-6 text-sm text-center text-secondary">Belum punya akun? <button onclick="toggleAuth('signup')" class="text-primary font-bold hover:underline">Daftar sekarang</button></p>
    </div>

    <div id="signup-form" class="<?= $active_tab == 'signup' ? '' : 'hidden' ?> bg-white p-8 rounded-3xl shadow-premium border border-gray-100">
        <h2 class="text-2xl font-bold text-primary mb-6">Buat Akun Baru</h2>
        <?php if ($error && $active_tab == 'signup'): ?>
            <div class="bg-red-50 text-promo p-3 rounded-lg mb-4 text-sm font-medium"><?= $error ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="bg-green-50 text-success p-3 rounded-lg mb-4 text-sm font-medium"><?= $success ?></div>
        <?php endif; ?>
        <form method="POST" class="space-y-4">
            <input type="text" name="name" placeholder="Nama Lengkap" required class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-primary">
            <input type="email" name="email" placeholder="Email" required class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-primary">
            <input type="password" name="password" placeholder="Password" required class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-primary">
            <button type="submit" name="register" class="w-full bg-primary text-white font-bold py-3.5 rounded-xl hover:bg-gray-800 transition-all">Daftar</button>
        </form>
        <p class="mt-6 text-sm text-center text-secondary">Sudah punya akun? <button onclick="toggleAuth('login')" class="text-primary font-bold hover:underline">Sign In di sini</button></p>
    </div>
</main>

<script>
    function toggleAuth(type) {
        const loginForm = document.getElementById('login-form');
        const signupForm = document.getElementById('signup-form');
        if (type === 'signup') {
            loginForm.classList.add('hidden');
            signupForm.classList.remove('hidden');
        } else {
            loginForm.classList.remove('hidden');
            signupForm.classList.add('hidden');
        }
    }
</script>

<?php include 'includes/footer.php'; ?>