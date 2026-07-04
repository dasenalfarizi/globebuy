<footer class="bg-[#18181B] text-white pt-20 pb-10 mt-auto">
    <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 mb-16 border-b border-gray-800 pb-16">

            <div class="lg:col-span-4 pr-0 lg:pr-8">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-white rounded-full mr-3 flex items-center justify-center">
                        <i class="ph-fill ph-planet text-primary text-2xl"></i>
                    </div>
                    <span class="font-extrabold text-3xl tracking-tight">GLOBEBUY</span>
                </div>
                <p class="text-gray-400 text-[15px] leading-relaxed mb-8">
                    Menemukan gaya premium dengan kualitas terbaik. Kami menyediakan pakaian fashion dengan desain modern dan eksklusif untuk penampilan harian Anda.
                </p>
                <div class="flex gap-4">
                    <a href="#" class="w-11 h-11 rounded-full bg-gray-800 flex items-center justify-center hover:bg-white hover:text-primary transition-all duration-300 hover:-translate-y-1"><i class="ph-fill ph-instagram-logo text-xl"></i></a>
                    <a href="#" class="w-11 h-11 rounded-full bg-gray-800 flex items-center justify-center hover:bg-white hover:text-primary transition-all duration-300 hover:-translate-y-1"><i class="ph-fill ph-twitter-logo text-xl"></i></a>
                    <a href="#" class="w-11 h-11 rounded-full bg-gray-800 flex items-center justify-center hover:bg-white hover:text-primary transition-all duration-300 hover:-translate-y-1"><i class="ph-fill ph-facebook-logo text-xl"></i></a>
                </div>
            </div>

            <div class="lg:col-span-2 lg:col-start-6">
                <h4 class="font-bold text-lg mb-6 tracking-wide">Company</h4>
                <ul class="space-y-4 text-[15px] text-gray-400 font-medium">
                    <li><a href="about.php" class="hover:text-white hover:translate-x-1 inline-block transition-transform duration-300">About Us</a></li>
                    <li><a href="#" class="hover:text-white hover:translate-x-1 inline-block transition-transform duration-300">Blog</a></li>
                    <li><a href="contact.php" class="hover:text-white hover:translate-x-1 inline-block transition-transform duration-300">Contact Us</a></li>
                    <li><a href="#" class="hover:text-white hover:translate-x-1 inline-block transition-transform duration-300">Careers</a></li>
                </ul>
            </div>

            <div class="lg:col-span-2">
                <h4 class="font-bold text-lg mb-6 tracking-wide">Customer Services</h4>
                <ul class="space-y-4 text-[15px] text-gray-400 font-medium">
                    <li><a href="#" class="hover:text-white hover:translate-x-1 inline-block transition-transform duration-300">My Account</a></li>
                    <li><a href="#" class="hover:text-white hover:translate-x-1 inline-block transition-transform duration-300">Track Order</a></li>
                    <li><a href="#" class="hover:text-white hover:translate-x-1 inline-block transition-transform duration-300">Returns</a></li>
                    <li><a href="#" class="hover:text-white hover:translate-x-1 inline-block transition-transform duration-300">FAQ</a></li>
                </ul>
            </div>

            <div class="lg:col-span-3">
                <h4 class="font-bold text-lg mb-6 tracking-wide">Contact Info</h4>
                <ul class="space-y-5 text-[15px] text-gray-400">
                    <li class="flex items-center gap-4 group cursor-pointer">
                        <div class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center flex-shrink-0 group-hover:bg-white group-hover:text-primary transition-colors">
                            <i class="ph-fill ph-phone text-lg"></i>
                        </div>
                        <span class="font-medium group-hover:text-white transition-colors">+62 812-3456-7890</span>
                    </li>
                    <li class="flex items-center gap-4 group cursor-pointer">
                        <div class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center flex-shrink-0 group-hover:bg-white group-hover:text-primary transition-colors">
                            <i class="ph-fill ph-envelope-simple text-lg"></i>
                        </div>
                        <span class="font-medium group-hover:text-white transition-colors">hello@globebuy.com</span>
                    </li>
                    <li class="flex items-start gap-4 group cursor-pointer">
                        <div class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center flex-shrink-0 group-hover:bg-white group-hover:text-primary transition-colors mt-0.5">
                            <i class="ph-fill ph-map-pin text-lg"></i>
                        </div>
                        <span class="font-medium leading-relaxed group-hover:text-white transition-colors">Jl. Fashion Premium No. 1, Jakarta Selatan</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="flex flex-col md:flex-row justify-between items-center gap-6 text-[15px] text-gray-500 font-medium">
            <p>&copy; <?= date('Y'); ?> GlobeBuy. All rights reserved.</p>
            <!-- <div class="flex gap-4 text-3xl opacity-70">
                <i class="ph-fill ph-stripe-logo hover:opacity-100 transition-opacity cursor-pointer"></i>
                <i class="ph-fill ph-paypal-logo hover:opacity-100 transition-opacity cursor-pointer"></i>
                <i class="ph-fill ph-credit-card hover:opacity-100 transition-opacity cursor-pointer"></i>
            </div> -->
        </div>
    </div>
</footer>

<div id="cart-slideover" class="fixed inset-0 overflow-hidden z-50 hidden">
    <div class="absolute inset-0 overflow-hidden">
        <div id="cart-backdrop" class="absolute inset-0 bg-black/60 backdrop-blur-sm opacity-0 transition-opacity duration-400" onclick="toggleCart()"></div>
        <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
            <div class="pointer-events-auto w-screen max-w-md transform transition-transform duration-400 ease-in-out translate-x-full" id="cart-panel">
                <div class="flex h-full flex-col bg-white shadow-2xl rounded-l-[32px] overflow-hidden">
                    <div class="flex items-center justify-between px-8 py-6 border-b border-gray-100 bg-white z-10">
                        <div class="flex items-center gap-3">
                            <i class="ph-bold ph-shopping-bag text-2xl text-primary"></i>
                            <h2 class="text-xl font-extrabold text-primary tracking-tight">Shopping Cart</h2>
                        </div>
                        <button type="button" onclick="toggleCart()" class="text-secondary hover:text-primary hover:bg-gray-100 p-2 rounded-full transition-all">
                            <i class="ph-bold ph-x text-xl"></i>
                        </button>
                    </div>
                    <div class="flex-1 overflow-y-auto px-8 py-6 cart-scroll" id="cart-items-container">
                        <div class="flex flex-col items-center justify-center h-full text-secondary opacity-60" id="empty-cart-msg">
                            <i class="ph-duotone ph-shopping-cart text-7xl mb-6"></i>
                            <p class="text-lg font-medium">Keranjang Anda masih kosong.</p>
                            <a href="shop.php"
                                class="inline-block mt-6 px-6 py-2.5 rounded-full border-2 border-primary text-primary font-bold hover:bg-primary hover:text-white transition-colors text-center">
                                Mulai Belanja
                            </a>
                        </div>
                    </div>
                    <div class="border-t border-gray-100 px-8 py-8 bg-gray-50 z-10">
                        <div class="flex justify-between text-lg font-bold text-primary mb-2">
                            <p>Subtotal</p>
                            <p id="cart-subtotal">Rp 0</p>
                        </div>
                        <p class="text-sm text-secondary font-medium mb-6">Biaya pengiriman dan pajak dihitung saat checkout.</p>
                        <div class="mt-6">
                            <button onclick="simulateCheckout()" class="flex items-center justify-center w-full rounded-full bg-primary px-6 py-4 text-[17px] font-bold text-white shadow-lg hover:shadow-xl hover:bg-gray-800 transition-all hover:-translate-y-0.5 gap-2">
                                Proceed to Checkout <i class="ph-bold ph-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="quickview-modal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-6">
    <div id="qv-backdrop" class="absolute inset-0 bg-black/70 backdrop-blur-md opacity-0 transition-opacity duration-300" onclick="closeQuickView()"></div>
    <div class="bg-white rounded-[32px] w-full max-w-4xl max-h-[95vh] overflow-y-auto no-scrollbar shadow-2xl z-10 relative flex flex-col md:flex-row transform scale-95 opacity-0 transition-all duration-300" id="quickview-content">
        <button onclick="closeQuickView()" class="absolute top-4 right-4 z-20 w-10 h-10 bg-white/90 backdrop-blur rounded-full flex items-center justify-center text-primary hover:bg-gray-100 transition-all shadow-md">
            <i class="ph-bold ph-x text-lg"></i>
        </button>
        <div class="w-full md:w-1/2 h-72 md:h-auto min-h-[400px] relative" id="qv-image-bg">
            <img id="qv-image" src="" alt="Product" class="w-full h-full object-cover mix-blend-multiply absolute inset-0 p-8">
        </div>
        <div class="w-full md:w-1/2 p-8 sm:p-10 flex flex-col justify-center bg-white">
            <div class="flex items-center justify-between mb-3">
                <div class="text-[13px] text-secondary font-bold uppercase tracking-wider px-3 py-1 bg-gray-100 rounded-full" id="qv-category">Category</div>
                <div class="flex items-center gap-1 text-yellow-400 text-sm bg-yellow-50 px-2 py-1 rounded-md">
                    <i class="ph-fill ph-star"></i>
                    <span class="font-bold text-primary text-xs ml-1" id="qv-rating">4.8</span>
                    <span class="text-xs text-secondary font-normal" id="qv-reviews">(120)</span>
                </div>
            </div>
            <h2 class="text-3xl font-extrabold text-primary mb-4 leading-tight tracking-tight" id="qv-name">Product Name</h2>
            <h3 class="text-3xl font-black text-primary mb-6" id="qv-price">Rp 0</h3>
            <p class="text-[15px] text-gray-600 mb-8 leading-relaxed font-medium" id="qv-desc">Description</p>
            <div class="mb-8 p-5 bg-gray-50 rounded-2xl border border-gray-100">
                <div class="mb-5">
                    <div class="flex justify-between text-sm mb-3">
                        <span class="font-bold text-primary">Select Size</span>
                    </div>
                    <div class="flex gap-3" id="qv-sizes"></div>
                </div>
                <div>
                    <div class="text-sm font-bold text-primary mb-3">Color: <span id="selected-color-name" class="font-medium text-secondary"></span></div>
                    <div class="flex gap-3" id="qv-colors"></div>
                </div>
            </div>
            <div class="flex gap-4">
                <div class="flex items-center border-2 border-gray-200 rounded-full px-4 w-32 bg-white">
                    <button onclick="changeQvQty(-1)" class="text-gray-500 hover:text-primary text-lg font-bold w-1/3">-</button>
                    <input type="text" id="qv-qty" value="1" readonly class="w-1/3 text-center font-bold text-primary bg-transparent focus:outline-none">
                    <button onclick="changeQvQty(1)" class="text-gray-500 hover:text-primary text-lg font-bold w-1/3">+</button>
                </div>
                <button id="qv-add-btn" class="flex-1 bg-primary text-white rounded-full py-4 font-bold hover:bg-gray-800 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5 flex items-center justify-center gap-2 text-[15px]">
                    <i class="ph-bold ph-shopping-cart-simple text-xl"></i> Add to Cart
                </button>
            </div>
        </div>
    </div>
</div>

<div id="toast" class="fixed top-24 right-5 bg-white border border-gray-100 px-6 py-4 rounded-2xl shadow-premium-hover transform translate-x-full opacity-0 transition-all duration-400 z-[100] flex items-center gap-4 min-w-[300px]">
    <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center flex-shrink-0">
        <i class="ph-fill ph-check-circle text-success text-2xl"></i>
    </div>
    <div>
        <p class="font-extrabold text-primary text-sm">Success!</p>
        <p class="text-[13px] text-gray-500 font-medium" id="toast-msg">Item added to cart.</p>
    </div>
</div>

<script src="assets/js/main.js"></script>
</body>

</html>