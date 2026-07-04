<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="src/output.css" class="css">
</head>

<body>
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="text-xs text-gray-500 mb-8 flex items-center gap-2">
            <a href="index.html" class="hover:text-black">Home</a> <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <a href="shop.html" class="hover:text-black">Men</a> <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-black font-medium">Premium Oversized Hoodie</span>
        </div>

        <div class="flex flex-col lg:flex-row gap-12 mb-16">
            <div class="lg:w-1/2 flex gap-4">
                <div class="w-20 flex flex-col gap-4">
                    <img src="https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&w=200&q=80" onclick="changeMainImage(this.src)" class="w-full aspect-[4/5] object-cover rounded-xl cursor-pointer border-2 border-black">
                    <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=200&q=80" onclick="changeMainImage(this.src)" class="w-full aspect-[4/5] object-cover rounded-xl cursor-pointer hover:border border-gray-300">
                </div>
                <div class="flex-1 bg-[#F6F6F6] rounded-3xl overflow-hidden">
                    <img id="main-product-image" src="https://images.unsplash.com/photo-1556821840-3a63f95609a7?auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover">
                </div>
            </div>

            <div class="lg:w-1/2 flex flex-col justify-center">
                <h1 class="text-3xl font-bold mb-2">Premium Oversized Hoodie</h1>
                <div class="flex items-center gap-4 mb-6">
                    <span class="text-2xl font-bold">Rp209.000</span>
                    <div class="flex items-center text-sm">
                        <i data-lucide="star" class="w-4 h-4 text-yellow-400 fill-current"></i>
                        <span class="font-medium ml-1">4.8</span>
                        <span class="text-gray-400 ml-1">(124 Reviews)</span>
                    </div>
                </div>

                <p class="text-gray-600 text-sm leading-relaxed mb-8">
                    High-quality cotton blend oversized hoodie. Perfect for casual daily wear or streetwear layering. Features a spacious kangaroo pocket and ribbed cuffs.
                </p>

                <div class="mb-6">
                    <div class="flex justify-between items-center mb-3">
                        <span class="font-semibold text-sm">Select Size</span>
                        <a href="#" class="text-xs text-gray-500 underline">Size Guide</a>
                    </div>
                    <div class="flex gap-3">
                        <label class="cursor-pointer"><input type="radio" name="psize" class="peer sr-only"><span class="w-12 h-12 flex items-center justify-center border border-gray-200 rounded-xl peer-checked:bg-black peer-checked:text-white transition">S</span></label>
                        <label class="cursor-pointer"><input type="radio" name="psize" class="peer sr-only" checked><span class="w-12 h-12 flex items-center justify-center border border-gray-200 rounded-xl peer-checked:bg-black peer-checked:text-white transition">M</span></label>
                        <label class="cursor-pointer"><input type="radio" name="psize" class="peer sr-only"><span class="w-12 h-12 flex items-center justify-center border border-gray-200 rounded-xl peer-checked:bg-black peer-checked:text-white transition">L</span></label>
                        <label class="cursor-pointer"><input type="radio" name="psize" class="peer sr-only"><span class="w-12 h-12 flex items-center justify-center border border-gray-200 rounded-xl peer-checked:bg-black peer-checked:text-white transition">XL</span></label>
                    </div>
                </div>

                <hr class="border-gray-100 my-6">

                <div class="flex gap-4">
                    <div class="flex items-center border border-gray-300 rounded-full px-2 w-32">
                        <button class="w-8 h-8 flex items-center justify-center hover:text-black text-gray-500">-</button>
                        <input type="number" value="1" class="w-full text-center font-medium bg-transparent outline-none text-sm">
                        <button class="w-8 h-8 flex items-center justify-center hover:text-black text-gray-500">+</button>
                    </div>
                    <button onclick="addToCart('Premium Oversized Hoodie')" class="flex-1 bg-black text-white rounded-full font-medium hover:bg-gray-800 transition flex items-center justify-center gap-2">
                        <i data-lucide="shopping-cart" class="w-4 h-4"></i> Add to Cart
                    </button>
                </div>
            </div>
        </div>
    </main>
</body>

</html>