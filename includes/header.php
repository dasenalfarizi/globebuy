<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlobeBuy - Premium Fashion Store</title>

    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 256 256'><circle cx='128' cy='128' r='128' fill='%23111827'/><path fill='%23FFFFFF' d='M239.5,108.62c-8-27-28-50.62-56.12-66.52A104,104,0,0,0,49.88,183.38c8,27,28,50.62,56.12,66.52A104,104,0,0,0,239.5,108.62ZM44.25,116.25A87.94,87.94,0,0,1,116.25,44.25C139,52.38,157.37,68.83,168.7,90.41l-24.95,9.6a8.06,8.06,0,0,0-4.63,4.63L129.52,130,104.57,105a8,8,0,0,0-11.32,11.32L118.2,141.25a8,8,0,0,0,5.66,2.34h0a8.08,8.08,0,0,0,5.65-2.35l30.08-30.08,8.19,21.3a88.16,88.16,0,0,1-23.63,55.33C121,179.37,102.63,163.17,91.3,141.59l24.95-9.6a8.06,8.06,0,0,0,4.63-4.63l9.6-24.95a8,8,0,0,0-5.26-10.15A8.13,8.13,0,0,0,121.75,93.6l-21.3-8.19A88.16,88.16,0,0,1,44.25,116.25Z' transform='scale(0.65) translate(68 68)'/></svg>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: '#111827',
                        secondary: '#6B7280',
                        background: '#F5F5F3',
                        card: '#FFFFFF',
                        accent: '#E5E7EB',
                        promo: '#EF4444',
                        success: '#10B981',
                        hero: '#E8E4DF',
                    },
                    boxShadow: {
                        'premium': '0 10px 30px rgba(0,0,0,0.02)',
                        'premium-hover': '0 20px 40px rgba(0,0,0,0.08)',
                    },
                    borderRadius: {
                        '3xl': '1.5rem',
                        '4xl': '2rem',
                    },
                    scale: {
                        '103': '1.03',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            background-color: #F5F5F3;
            -webkit-font-smoothing: antialiased;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .marquee-container {
            overflow: hidden;
            white-space: nowrap;
        }

        .marquee-content {
            display: inline-block;
            animation: marquee 25s linear infinite;
        }

        @keyframes marquee {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        .cart-scroll::-webkit-scrollbar {
            width: 6px;
        }

        .cart-scroll::-webkit-scrollbar-track {
            background: transparent;
        }

        .cart-scroll::-webkit-scrollbar-thumb {
            background: #E5E7EB;
            border-radius: 10px;
        }

        .cart-scroll::-webkit-scrollbar-thumb:hover {
            background: #D1D5DB;
        }
    </style>
</head>

<body class="text-primary font-sans relative min-h-screen flex flex-col">

    <div class="bg-primary text-white text-xs py-2.5 marquee-container font-medium tracking-wide z-50">
        <div class="marquee-content space-x-12">
            <span>🚀 FLASH SALE HARI INI DISKON HINGGA 50%</span>
            <span>📦 GRATIS ONGKIR SELURUH INDONESIA</span>
            <span>👕 BELI 2 GRATIS 1 UNTUK PRODUK PILIHAN</span>
            <span>💸 CASHBACK 10% MENGGUNAKAN GOPAY</span>
            <span>🚀 FLASH SALE HARI INI DISKON HINGGA 50%</span>
        </div>
    </div>

    <nav class="bg-background sticky top-0 z-40 bg-opacity-90 backdrop-blur-lg border-b border-gray-200/50">
        <script>
            const IS_LOGGED_IN = <?= isset($_SESSION['user_id']) ? 'true' : 'false' ?>;
        </script>

        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-24">

                <a href="index.php" class="flex items-center cursor-pointer group">
                    <div class="w-10 h-10 bg-primary rounded-full mr-3 flex items-center justify-center group-hover:bg-gray-800 transition-colors">
                        <i class="ph-fill ph-planet text-white text-2xl"></i>
                    </div>
                    <span class="font-bold text-2xl tracking-tight">GLOBEBUY</span>
                </a>

                <?php $active_page = basename($_SERVER['PHP_SELF']); ?>
                <div class="hidden md:flex items-center space-x-10 text-[15px] font-medium">
                    <a href="index.php" class="<?= ($active_page == 'index.php') ? 'text-primary font-bold relative after:content-[\'\'] after:absolute after:-bottom-2 after:left-0 after:w-full after:h-0.5 after:bg-primary' : 'text-secondary hover:text-primary transition-colors' ?>">Home</a>
                    <a href="shop.php" class="<?= ($active_page == 'shop.php') ? 'text-primary font-bold relative after:content-[\'\'] after:absolute after:-bottom-2 after:left-0 after:w-full after:h-0.5 after:bg-primary' : 'text-secondary hover:text-primary transition-colors' ?>">Shop</a>
                    <a href="faq.php" class="<?= ($active_page == 'faq.php') ? 'text-primary font-bold relative after:content-[\'\'] after:absolute after:-bottom-2 after:left-0 after:w-full after:h-0.5 after:bg-primary' : 'text-secondary hover:text-primary transition-colors' ?>">FAQ</a>
                </div>

                <div class="flex items-center space-x-3 sm:space-x-5">
                    <div class="hidden sm:flex items-center bg-white border border-gray-200 rounded-full px-3 py-1.5 shadow-sm focus-within:border-primary transition-all">
                        <i class="ph ph-magnifying-glass text-xl text-secondary"></i>
                        <input type="text" id="search-input" placeholder="Cari..." class="bg-transparent border-none focus:outline-none text-sm px-2 w-24 md:w-32 text-primary font-medium">
                    </div>

                    <a href="wishlist.php" class="hidden md:flex items-center justify-center w-10 h-10 bg-white border border-gray-200 rounded-full hover:border-promo hover:text-promo transition-all shadow-sm relative text-secondary">
                        <i class="ph-bold ph-heart text-xl"></i>
                        <span id="wishlist-count-badge" class="absolute -top-1 -right-1 bg-promo text-white text-[10px] w-5 h-5 flex items-center justify-center rounded-full font-bold">0</span>
                    </a>

                    <?php if (isset($_SESSION['user_id'])): ?>
                        <button onclick="toggleCart()" class="hidden md:flex items-center gap-2.5 bg-white border border-gray-200 hover:border-primary px-5 py-2.5 rounded-full transition-all duration-300 shadow-sm hover:shadow-md">
                            <span class="text-sm font-semibold">MY CART</span>
                            <i class="ph-bold ph-shopping-cart text-lg"></i>
                            <span id="cart-count-badge" class="bg-primary text-white text-[11px] min-w-[22px] h-[22px] px-1 flex items-center justify-center rounded-full font-bold">0</span>
                        </button>

                        <button onclick="toggleCart()" class="md:hidden p-2.5 bg-white border border-gray-200 rounded-full transition-all shadow-sm relative">
                            <i class="ph-bold ph-shopping-cart text-xl"></i>
                            <span id="mobile-cart-count" class="absolute -top-1 -right-1 bg-primary text-white text-[10px] w-5 h-5 flex items-center justify-center rounded-full font-bold">0</span>
                        </button>

                        <div class="relative">
                            <button id="profile-btn" onclick="toggleProfileMenu()" class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold overflow-hidden hover:ring-2 hover:ring-gray-300 transition-all focus:outline-none">
                                <?= strtoupper(substr($_SESSION['user_name'], 0, 1)) ?>
                            </button>

                            <div id="profile-menu" class="absolute right-0 top-full mt-3 w-48 bg-white rounded-2xl shadow-premium border border-gray-100 py-2 hidden z-50 transition-all">
                                <div class="px-4 py-2 text-[11px] font-extrabold text-secondary uppercase tracking-wider">
                                    Halo, <?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?>
                                </div>
                                <hr class="border-gray-100 my-1">
                                <a href="profile.php" class="block px-4 py-2.5 text-sm font-medium text-primary hover:bg-gray-50 transition-colors"><i class="ph-bold ph-user mr-1"></i> Profil Saya</a>
                                <a href="track.php" class="block px-4 py-2.5 text-sm font-medium text-primary hover:bg-gray-50 transition-colors"><i class="ph-bold ph-package mr-1"></i> Lacak Pesanan</a>

                                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                                    <a href="admin.php" class="block px-4 py-2.5 text-sm font-medium text-primary hover:bg-gray-50 hover:text-blue-600 transition-colors">
                                        <i class="ph-bold ph-shield-star mr-1"></i> Admin Panel
                                    </a>
                                <?php endif; ?>

                                <hr class="border-gray-100 my-1">
                                <a href="logout.php" class="block px-4 py-2.5 text-sm font-bold text-promo hover:bg-red-50 transition-colors mt-1"><i class="ph-bold ph-sign-out mr-1"></i> Logout</a>
                            </div>
                        </div>

                    <?php else: ?>
                        <button onclick="toggleCart()" class="hidden md:flex items-center justify-center w-10 h-10 bg-white border border-gray-200 rounded-full hover:border-primary transition-all shadow-sm relative text-secondary hover:text-primary">
                            <i class="ph-bold ph-shopping-cart text-xl"></i>
                            <span id="cart-count-badge" class="absolute -top-1 -right-1 bg-primary text-white text-[10px] w-5 h-5 flex items-center justify-center rounded-full font-bold">0</span>
                        </button>
                        <a href="auth.php" class="bg-primary text-white text-sm font-bold px-6 py-2.5 rounded-full hover:bg-gray-800 transition-all shadow-md">Sign In</a>
                    <?php endif; ?>

                    <button onclick="toggleMobileNav()" class="md:hidden p-2.5 text-primary"><i class="ph-bold ph-list text-2xl"></i></button>
                </div>
            </div>
        </div>

        <div id="mobile-menu-drawer" class="hidden md:hidden bg-white border-t border-gray-200/60 px-4 pt-4 pb-6 space-y-3 shadow-inner">
            <a href="index.php" class="block px-4 py-2.5 rounded-xl text-sm font-semibold <?= ($active_page == 'index.php') ? 'bg-primary text-white' : 'text-secondary hover:bg-gray-50' ?>">Home</a>
            <a href="shop.php" class="block px-4 py-2.5 rounded-xl text-sm font-semibold <?= ($active_page == 'shop.php') ? 'bg-primary text-white' : 'text-secondary hover:bg-gray-50' ?>">Shop</a>
            <a href="faq.php" class="block px-4 py-2.5 rounded-xl text-sm font-semibold <?= ($active_page == 'faq.php') ? 'bg-primary text-white' : 'text-secondary hover:bg-gray-50' ?>">FAQ</a>
            <a href="contact.php" class="block px-4 py-2.5 rounded-xl text-sm font-semibold <?= ($active_page == 'contact.php') ? 'bg-primary text-white' : 'text-secondary hover:bg-gray-50' ?>">Contact</a>
        </div>
    </nav>

    <script>
        function toggleProfileMenu() {
            document.getElementById('profile-menu').classList.toggle('hidden');
        }
        document.addEventListener('click', function(event) {
            const btn = document.getElementById('profile-btn');
            const menu = document.getElementById('profile-menu');
            if (btn && menu && !btn.contains(event.target) && !menu.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });

        document.getElementById('search-input')?.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                window.location.href = 'shop.php?search=' + encodeURIComponent(this.value.trim());
            }
        });
    </script>