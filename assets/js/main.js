// ==========================================
// 1. STATE & FILTER LOGIC
// ==========================================

let currentFilters = { category: "", min_price: 0, max_price: 0, size: "", color: "" };
let productsData = [];
let currentSearch = "";
let currentSort = "newest";
let currentPage = 1;
const itemsPerPage = 6;
let wishlist = JSON.parse(localStorage.getItem("globebuy_wishlist")) || [];

const fetchProducts = async () => {
  try {
    updateActiveFiltersUI();
    syncSidebarUI();
    const params = {};
    for (const key in currentFilters) {
      if (currentFilters[key]) params[key] = currentFilters[key];
    }
    const queryParams = new URLSearchParams(params).toString();
    const response = await fetch(`api_products.php?${queryParams}`);
    if (!response.ok) throw new Error("API error");
    productsData = await response.json();
    renderProducts();
  } catch (error) {
    console.error("Gagal mengambil data produk:", error);
  }
};

document.addEventListener("DOMContentLoaded", () => {
  if (document.getElementById("product-grid")) {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has("category")) currentFilters.category = urlParams.get("category");
    if (urlParams.has("search")) currentSearch = urlParams.get("search");
    fetchProducts();
    setupFilterListeners();
  }
  updateCartUI();
  updateWishlistBadge();
});

const setupFilterListeners = () => {
  const bindFilterEvent = (selector, filterKey) => {
    document.querySelectorAll(selector).forEach((el) => {
      el.addEventListener("click", (e) => {
        const value = e.currentTarget.dataset.value;
        if (currentFilters[filterKey] === value) currentFilters[filterKey] = "";
        else currentFilters[filterKey] = value;
        fetchProducts();
      });
    });
  };
  bindFilterEvent(".filter-category", "category");
  bindFilterEvent(".filter-color", "color");
  bindFilterEvent(".filter-size", "size");

  document.querySelectorAll(".filter-price").forEach((el) => {
    el.addEventListener("click", (e) => {
      const min = e.currentTarget.dataset.min || 0;
      const max = e.currentTarget.dataset.max || 0;
      if (currentFilters.min_price == min && currentFilters.max_price == max) {
        currentFilters.min_price = 0; currentFilters.max_price = 0;
      } else {
        currentFilters.min_price = min; currentFilters.max_price = max;
      }
      fetchProducts();
    });
  });
};

const syncSidebarUI = () => {
  document.querySelectorAll(".filter-category").forEach((el) => {
    const isActive = el.dataset.value === currentFilters.category;
    const iconContainer = el.querySelector(".w-5.h-5");
    if (iconContainer) {
      if (isActive) {
        iconContainer.classList.add("bg-primary", "border-primary");
        iconContainer.classList.remove("border-gray-300");
        iconContainer.innerHTML = '<i class="ph-bold ph-check text-white text-xs"></i>';
      } else {
        iconContainer.classList.add("border-gray-300");
        iconContainer.classList.remove("bg-primary", "border-primary");
        iconContainer.innerHTML = "";
      }
    }
  });

  document.querySelectorAll(".filter-price").forEach((el) => {
    const min = el.dataset.min || 0;
    const max = el.dataset.max || 0;
    const isActive = currentFilters.min_price == min && currentFilters.max_price == max;
    if (isActive) {
      el.classList.add("bg-white", "border-primary", "shadow-md");
      el.classList.remove("bg-gray-50", "border-gray-200", "shadow-sm");
    } else {
      el.classList.add("bg-gray-50", "border-gray-200", "shadow-sm");
      el.classList.remove("bg-white", "border-primary", "shadow-md");
    }
  });

  document.querySelectorAll(".filter-color").forEach((el) => {
    const isActive = el.dataset.value === currentFilters.color;
    const colorBox = el.querySelector(".w-6.h-6");
    if (colorBox) {
      if (isActive) colorBox.classList.add("ring-2", "ring-offset-2", "ring-primary");
      else colorBox.classList.remove("ring-2", "ring-offset-2", "ring-primary");
    }
  });

  document.querySelectorAll(".filter-size").forEach((el) => {
    const isActive = el.dataset.value === currentFilters.size;
    if (isActive) {
      el.classList.add("bg-primary", "text-white", "font-bold", "border-primary");
      el.classList.remove("bg-white", "text-secondary", "font-medium", "border-gray-200");
    } else {
      el.classList.add("bg-white", "text-secondary", "font-medium", "border-gray-200");
      el.classList.remove("bg-primary", "text-white", "font-bold", "border-primary");
    }
  });
};

const updateActiveFiltersUI = () => {
  const container = document.getElementById("active-filters-container");
  if (!container) return;

  let html = '<span class="text-secondary font-medium mr-2">Active Filter :</span>';
  let hasFilters = false;

  const displayLabels = {
    category: currentFilters.category,
    size: `Size: ${currentFilters.size}`,
    color: `Color: ${currentFilters.color}`,
    price: currentFilters.min_price || currentFilters.max_price ? `Rp ${currentFilters.min_price / 1000}k - Rp ${currentFilters.max_price / 1000}k` : "",
  };

  if (currentFilters.category) { hasFilters = true; html += generateChip("category", displayLabels.category); }
  if (currentFilters.size) { hasFilters = true; html += generateChip("size", displayLabels.size); }
  if (currentFilters.color) { hasFilters = true; html += generateChip("color", displayLabels.color); }
  if (currentFilters.min_price || currentFilters.max_price) { hasFilters = true; html += generateChip("price", displayLabels.price); }

  if (hasFilters) {
    html += `<button onclick="clearAllFilters()" class="text-promo font-bold hover:underline text-[13px] ml-2 tracking-wide">Clear All</button>`;
    container.innerHTML = html;
    container.classList.remove("hidden");
  } else {
    container.classList.add("hidden");
    container.innerHTML = "";
  }
};

const generateChip = (key, text) => {
  return `<div class="px-4 py-2 border border-gray-200 rounded-full flex items-center gap-2 font-medium bg-white shadow-sm capitalize">${text} <button onclick="removeFilter('${key}')" class="text-secondary hover:text-promo transition-colors"><i class="ph-bold ph-x"></i></button></div>`;
};

const removeFilter = (key) => {
  if (key === "price") { currentFilters.min_price = 0; currentFilters.max_price = 0; } 
  else { currentFilters[key] = ""; }
  fetchProducts();
};

const clearAllFilters = () => {
  currentFilters = { category: "", min_price: 0, max_price: 0, size: "", color: "" };
  fetchProducts();
};

// ==========================================
// 2. RENDER PRODUCTS, WISHLIST, SORT, & PAGINATION
// ==========================================

const formatRupiah = (number) => {
  return new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", minimumFractionDigits: 0 }).format(number);
};

const changeSort = (sortValue) => {
  currentSort = sortValue;
  currentPage = 1;
  renderProducts();
};

const changePage = (pageNumber) => {
  currentPage = pageNumber;
  renderProducts();
  document.getElementById("product-grid").scrollIntoView({ behavior: "smooth", block: "start" });
};

const toggleWishlist = (productId, event) => {
  event.stopPropagation();
  const product = productsData.find(p => p.id === productId);
  if(!product) return;

  const index = wishlist.findIndex(w => w.id === productId);
  if(index > -1) {
      wishlist.splice(index, 1);
      showToast("Dihapus dari Wishlist");
  } else {
      wishlist.push(product);
      showToast("Ditambahkan ke Wishlist ❤️");
  }
  localStorage.setItem("globebuy_wishlist", JSON.stringify(wishlist));
  renderProducts(); 
  updateWishlistBadge();
};

const updateWishlistBadge = () => {
  const badge = document.getElementById("wishlist-count-badge");
  if(badge) badge.innerText = wishlist.length;
};

const renderProducts = () => {
  const grid = document.getElementById("product-grid");
  const pagination = document.getElementById("pagination-container");
  if (!grid) return;

  let filteredData = productsData;
  if (currentSearch) {
    filteredData = filteredData.filter((p) => p.name.toLowerCase().includes(currentSearch.toLowerCase()));
  }

  if (currentSort === "price_asc") {
    filteredData.sort((a, b) => parseFloat(a.price) - parseFloat(b.price));
  } else if (currentSort === "price_desc") {
    filteredData.sort((a, b) => parseFloat(b.price) - parseFloat(a.price));
  } else {
    filteredData.sort((a, b) => parseInt(b.id) - parseInt(a.id));
  }

  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  if (currentPage > totalPages) currentPage = totalPages || 1;

  const startIndex = (currentPage - 1) * itemsPerPage;
  const paginatedData = filteredData.slice(startIndex, startIndex + itemsPerPage);

  if (paginatedData.length === 0) {
    grid.innerHTML = `<div class="col-span-full py-20 text-center text-secondary font-medium text-lg">Tidak ada produk yang sesuai.</div>`;
    if (pagination) pagination.innerHTML = "";
    return;
  }

  grid.innerHTML = paginatedData.map((p) => `
        <div class="group bg-card rounded-[32px] p-5 shadow-sm hover:shadow-premium transition-all duration-500 hover:scale-[1.02] cursor-pointer border border-gray-100/50 flex flex-col relative animate-fade-in">
            <button onclick="toggleWishlist(${p.id}, event)" class="absolute top-8 right-8 z-20 w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-md hover:scale-110 transition-transform">
                <i class="${wishlist.some(w => w.id === p.id) ? 'ph-fill text-promo' : 'ph text-secondary hover:text-promo'} ph-heart text-xl transition-colors"></i>
            </button>

            ${p.badge ? `<div class="absolute top-8 left-8 z-10 px-3 py-1 bg-white/80 backdrop-blur text-[11px] font-bold text-primary rounded-full shadow-sm uppercase tracking-wider">${p.badge}</div>` : ""}
            <div class="${p.bg_class || "bg-gray-100"} rounded-[24px] overflow-hidden aspect-[4/5] relative mb-5 flex items-center justify-center">
                <img src="${p.image}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 mix-blend-multiply p-4" alt="${p.name}">
                <div class="absolute inset-0 bg-black/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center z-10">
                    <button onclick="openQuickView(${p.id})" class="bg-white text-primary px-6 py-3 rounded-full font-bold shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:bg-primary hover:text-white flex items-center gap-2">
                        <i class="ph-bold ph-eye"></i> Quick View
                    </button>
                </div>
            </div>
            <div class="flex-1 flex flex-col">
                <p class="text-[12px] text-secondary font-bold uppercase tracking-wider mb-1">${p.category}</p>
                <h3 class="font-extrabold text-primary text-[17px] leading-tight mb-2 line-clamp-1">${p.name}</h3>
                <div class="mt-auto flex justify-between items-center mt-4">
                    <span class="font-black text-primary text-xl">${formatRupiah(p.price || p.basePrice)}</span>
                    <button onclick="openQuickView(${p.id})" class="w-12 h-12 bg-gray-50 border border-gray-200 rounded-full flex items-center justify-center text-primary hover:bg-primary hover:text-white hover:border-primary transition-all shadow-sm">
                        <i class="ph-bold ph-plus text-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    `).join("");

  if (pagination) {
    let pageHtml = "";
    pageHtml += `<button onclick="changePage(${currentPage - 1})" ${currentPage === 1 ? "disabled" : ""} class="w-11 h-11 rounded-full bg-white border border-gray-200 flex items-center justify-center text-secondary hover:border-primary hover:text-primary transition-all disabled:opacity-50 disabled:cursor-not-allowed"><i class="ph-bold ph-caret-left"></i></button>`;
    for (let i = 1; i <= totalPages; i++) {
      if (i === currentPage) {
        pageHtml += `<button class="w-11 h-11 rounded-full bg-primary text-white font-bold flex items-center justify-center shadow-md">${i}</button>`;
      } else {
        pageHtml += `<button onclick="changePage(${i})" class="w-11 h-11 rounded-full bg-white border border-gray-200 flex items-center justify-center text-secondary hover:border-primary hover:text-primary transition-all font-semibold">${i}</button>`;
      }
    }
    pageHtml += `<button onclick="changePage(${currentPage + 1})" ${currentPage === totalPages ? "disabled" : ""} class="w-11 h-11 rounded-full bg-white border border-gray-200 flex items-center justify-center text-secondary hover:border-primary hover:text-primary transition-all disabled:opacity-50 disabled:cursor-not-allowed"><i class="ph-bold ph-caret-right"></i></button>`;
    pagination.innerHTML = pageHtml;
  }
};

// ==========================================
// 3. CART & QUICKVIEW LOGIC
// ==========================================

let cart = JSON.parse(localStorage.getItem("globebuy_cart")) || [];
let currentQuickViewProduct = null;
let selectedSize = "";
let selectedColor = null;
let qvQty = 1;

let toastTimeout;
const showToast = (message) => {
  const toast = document.getElementById("toast");
  if (!toast) return;
  document.getElementById("toast-msg").innerText = message;
  toast.classList.remove("translate-x-full", "opacity-0");
  clearTimeout(toastTimeout);
  toastTimeout = setTimeout(() => {
    toast.classList.add("translate-x-full", "opacity-0");
  }, 3000);
};

const toggleCart = () => {
  const slideover = document.getElementById("cart-slideover");
  const panel = document.getElementById("cart-panel");
  const backdrop = document.getElementById("cart-backdrop");
  if (!slideover) return;
  if (slideover.classList.contains("hidden")) {
    slideover.classList.remove("hidden");
    void slideover.offsetWidth;
    backdrop.classList.remove("opacity-0");
    panel.classList.remove("translate-x-full");
  } else {
    backdrop.classList.add("opacity-0");
    panel.classList.add("translate-x-full");
    setTimeout(() => { slideover.classList.add("hidden"); }, 400);
  }
};

const openQuickView = (productId) => {
  const product = productsData.find((p) => p.id === productId);
  if (!product) return;
  currentQuickViewProduct = product;
  const availableSizes = Array.isArray(product.sizes) ? product.sizes : product.variants ? Object.keys(product.variants) : [];
  const availableColors = Array.isArray(product.colors) ? product.colors : [];
  selectedSize = availableSizes.length > 0 ? availableSizes[0] : "";
  selectedColor = availableColors.length > 0 ? availableColors[0] : null;
  qvQty = 1;

  document.getElementById("qv-image").src = product.image;
  document.getElementById("qv-image-bg").className = `w-full md:w-1/2 h-72 md:h-auto min-h-[400px] relative rounded-t-[32px] md:rounded-l-[32px] md:rounded-tr-none ${product.bg_class || "bg-gray-100"}`;
  document.getElementById("qv-category").innerText = product.category;
  document.getElementById("qv-name").innerText = product.name;
  if (document.getElementById("qv-desc")) document.getElementById("qv-desc").innerText = product.description || product.desc || "";
  document.getElementById("qv-price").innerText = formatRupiah(product.price || product.basePrice);
  document.getElementById("qv-qty").value = qvQty;
  renderQvVariants();

  const modal = document.getElementById("quickview-modal");
  const backdrop = document.getElementById("qv-backdrop");
  const content = document.getElementById("quickview-content");
  modal.classList.remove("hidden");
  void modal.offsetWidth;
  backdrop.classList.remove("opacity-0");
  content.classList.remove("scale-95", "opacity-0");
  content.classList.add("scale-100", "opacity-100");

  document.getElementById("qv-add-btn").onclick = () => {
    addToCart(product, selectedSize, selectedColor, qvQty);
    closeQuickView();
  };
};

const closeQuickView = () => {
  const backdrop = document.getElementById("qv-backdrop");
  const content = document.getElementById("quickview-content");
  if (!content) return;
  backdrop.classList.add("opacity-0");
  content.classList.remove("scale-100", "opacity-100");
  content.classList.add("scale-95", "opacity-0");
  setTimeout(() => { document.getElementById("quickview-modal").classList.add("hidden"); }, 300);
};

const changeQvQty = (amount) => {
  let newQty = qvQty + amount;
  if (newQty >= 1) { qvQty = newQty; document.getElementById("qv-qty").value = qvQty; }
};

const renderQvVariants = () => {
  if (!currentQuickViewProduct) return;
  const sizes = Array.isArray(currentQuickViewProduct.sizes) ? currentQuickViewProduct.sizes : currentQuickViewProduct.variants ? Object.keys(currentQuickViewProduct.variants) : [];
  const colors = Array.isArray(currentQuickViewProduct.colors) ? currentQuickViewProduct.colors : [];

  document.getElementById("qv-sizes").innerHTML = sizes.map((size) => {
      return `<div onclick="selectSize('${size}')" class="w-12 h-12 rounded-full text-sm font-bold flex items-center justify-center transition-all cursor-pointer ${size === selectedSize ? "bg-primary text-white shadow-md ring-2 ring-primary ring-offset-2" : "border border-gray-300 text-secondary bg-white hover:border-primary"}">${size}</div>`;
  }).join("");

  document.getElementById("qv-colors").innerHTML = colors.map((color) => {
      return `<div onclick="selectColor('${color.name}')" class="w-8 h-8 rounded-full cursor-pointer transition-all shadow-sm ${selectedColor && selectedColor.name === color.name ? "ring-2 ring-primary ring-offset-2 scale-110" : "border border-gray-200 hover:scale-110"}" style="background-color: ${color.hex};" title="${color.name}"></div>`;
  }).join("");

  if (selectedColor && document.getElementById("selected-color-name")) {
    document.getElementById("selected-color-name").innerText = selectedColor.name;
  }
};

const selectSize = (size) => { selectedSize = size; renderQvVariants(); };
const selectColor = (colorName) => {
  const colors = Array.isArray(currentQuickViewProduct.colors) ? currentQuickViewProduct.colors : [];
  selectedColor = colors.find((c) => c.name === colorName);
  renderQvVariants();
};

const addToCart = (product, size, color, quantity = 1) => {
  const price = product.price || product.basePrice;
  const cartItemId = `${product.id}-${size}-${color ? color.name : "def"}`;
  const existingIndex = cart.findIndex((item) => item.cartItemId === cartItemId);

  if (existingIndex > -1) { cart[existingIndex].quantity += quantity; } 
  else { cart.push({ cartItemId, product, size, color, price, quantity }); }
  updateCartUI();
  showToast(`${product.name} berhasil ditambahkan ke keranjang.`);
};

const updateQuantity = (cartItemId, change) => {
  const index = cart.findIndex((item) => item.cartItemId === cartItemId);
  if (index > -1) {
    let newQty = cart[index].quantity + change;
    if (newQty > 0) cart[index].quantity = newQty;
    else cart.splice(index, 1);
    updateCartUI();
  }
};

const removeFromCart = (cartItemId) => {
  cart = cart.filter((item) => item.cartItemId !== cartItemId);
  updateCartUI();
};

const updateCartUI = () => {
  localStorage.setItem("globebuy_cart", JSON.stringify(cart));
  const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);

  const countBadge = document.getElementById("cart-count-badge");
  const mobileBadge = document.getElementById("mobile-cart-count");
  if (countBadge) countBadge.innerText = totalItems;
  if (mobileBadge) mobileBadge.innerText = totalItems;

  const container = document.getElementById("cart-items-container");
  const emptyMsg = document.getElementById("empty-cart-msg");
  if (!container) return;

  if (cart.length === 0) {
    emptyMsg.style.display = "flex";
    Array.from(container.children).forEach((child) => {
      if (child.id !== "empty-cart-msg") child.remove();
    });
    document.getElementById("cart-subtotal").innerText = "Rp 0";
    return;
  }

  emptyMsg.style.display = "none";
  const itemsHtml = cart.map((item) => `
        <div class="flex py-6 border-b border-gray-100 items-center">
            <div class="h-24 w-20 flex-shrink-0 overflow-hidden rounded-2xl ${item.product.bg_class || "bg-gray-100"} border border-gray-100 p-2 flex items-center justify-center">
                <img src="${item.product.image}" class="max-h-full max-w-full object-contain mix-blend-multiply">
            </div>
            <div class="ml-4 flex flex-1 flex-col">
                <div>
                    <div class="flex justify-between text-sm font-bold text-primary mb-1">
                        <h4 class="line-clamp-1 pr-2">${item.product.name}</h4>
                        <p class="whitespace-nowrap ml-2">${formatRupiah(item.price * item.quantity)}</p>
                    </div>
                    <p class="text-xs text-secondary font-medium">Size: ${item.size} ${item.color ? `| Color: ${item.color.name}` : ""}</p>
                </div>
                <div class="flex flex-1 items-end justify-between text-xs mt-2">
                    <div class="flex items-center border border-gray-200 rounded-full px-2 py-1 bg-gray-50">
                        <button onclick="updateQuantity('${item.cartItemId}', -1)" class="text-secondary hover:text-primary font-bold px-2">-</button>
                        <span class="font-bold text-primary w-6 text-center">${item.quantity}</span>
                        <button onclick="updateQuantity('${item.cartItemId}', 1)" class="text-secondary hover:text-primary font-bold px-2">+</button>
                    </div>
                    <button type="button" onclick="removeFromCart('${item.cartItemId}')" class="font-bold text-promo bg-red-50 p-2 rounded-full hover:bg-red-100 transition-colors"><i class="ph-bold ph-trash"></i></button>
                </div>
            </div>
        </div>
    `).join("");

  container.innerHTML = `<div class="flex flex-col items-center justify-center h-full text-secondary opacity-60 hidden" id="empty-cart-msg">${emptyMsg.innerHTML}</div>` + itemsHtml;
  document.getElementById("cart-subtotal").innerText = formatRupiah(cart.reduce((sum, item) => sum + item.price * item.quantity, 0));
};

// ==========================================
// 4. CHECKOUT GUARD (CEK LOGIN) & LAINNYA
// ==========================================

const simulateCheckout = () => {
  if (cart.length === 0) {
    showToast("Keranjang belanja kosong!");
    return;
  }
  
  // Perlindungan agar User Tamu (Guest) harus Sign In dulu
  if (typeof IS_LOGGED_IN !== 'undefined' && IS_LOGGED_IN === false) {
      showToast("Silakan Sign In terlebih dahulu untuk melakukan Checkout.");
      setTimeout(() => { window.location.href = "auth.php"; }, 1500); // Redirect otomatis ke halaman login
      return;
  }
  
  toggleCart();
  window.location.href = "checkout.php";
};

const toggleMobileNav = () => {
  const drawer = document.getElementById("mobile-menu-drawer");
  if (drawer) drawer.classList.toggle("hidden");
};

const toggleMobileFilters = () => {
  const sidebar = document.getElementById("filter-sidebar");
  if (sidebar) sidebar.classList.toggle("hidden");
};