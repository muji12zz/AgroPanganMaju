<!-- index.php -->
<style>

.whatsapp-container {
  position: fixed;
  bottom: 20px;
  right: 20px;
  display: flex;
  align-items: center;
  background-color: #f4c97d;
  border-radius: 50px;
  padding: 10px 15px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  z-index: 9999;
  transition: opacity 0.3s ease;
}

.whatsapp-text {
  font-family: sans-serif;
  font-weight: bold;
  margin-right: 10px;
  color: #000;
  line-height: 1.2;
}

.whatsapp-icon {
  width: 40px;
  height: 40px;
  background-color: #ba2b2b;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
}

.whatsapp-icon img {
  width: 24px;
  height: 24px;
}

.close-btn {
  margin-left: 10px;
  font-size: 20px;
  cursor: pointer;
  color: #333;
}
</style>



<?php include 'header.php'; ?>

 <!-- Hero Section -->
 <main class="bg-black text-white text-center py-24">
    <h1 class="text-5xl font-bold mb-6">AGRO PANGAN MAJU</h1>
    <h2 id="typewriter" class="text-2xl md:text-3xl font-medium h-12 cursor"></h2>
  </main>

  <!-- Floating WhatsApp Button -->
  <div class="whatsapp-container" id="whatsappBubble">
    <div class="whatsapp-text">
      want to <br> negotiate? <br> contact us!
    </div>
    <div class="whatsapp-icon" onclick="openWhatsApp()">
      <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp">
    </div>
    <div class="close-btn" onclick="closeBubble()">×</div>
  </div>

  <!-- Our Top 5 Clients -->
  <section class="bg-yellow-100 py-20">
    <div class="max-w-7xl mx-auto text-center px-4">
      <h4 class="text-4xl font-bold mb-16 text-gray-800">Our Top 5 Clients</h4>
      <div class="bg-white py-12 px-10 rounded-2xl shadow-2xl inline-block w-full">
        <div class="flex flex-wrap justify-center items-center gap-20">
          <img src="image/client1.png" alt="Client 1 logo" class="h-24 w-auto transition-transform duration-300 hover:scale-105">
          <img src="image/client2.png" alt="Client 2 logo" class="h-24 w-auto transition-transform duration-300 hover:scale-105">
          <img src="image/client3.png" alt="Client 3 logo" class="h-24 w-auto transition-transform duration-300 hover:scale-105">
          <img src="image/client4.png" alt="Client 4 logo" class="h-24 w-auto transition-transform duration-300 hover:scale-105">
          <img src="image/client5.png" alt="Client 5 logo" class="h-24 w-auto transition-transform duration-300 hover:scale-105">
        </div>
      </div>
    </div>
  </section>

  <section class="bg-yellow-100 py-20">
    <div class="max-w-7xl mx-auto text-center px-4">
      <h2 class="text-4xl font-bold text-orange-600 mb-4">The Best Product You Can Get on Earth</h2>
      <p class="text-orange-700 mb-10 max-w-3xl mx-auto">
        PT Agro Pangan Maju distribusi rantai dingin yang menyediakan berbagai produk dengan dedikasi yang tinggi.
        Kami terus berkomitmen untuk memberikan produk yang berkualitas.
      </p>
      <button class="bg-orange-600 text-white py-2 px-6 rounded-full hover:bg-orange-700 transition mb-10">
        LEARN MORE
      </button>
  
      <div class="relative overflow-hidden">
        <div id="carousel" class="flex transition-transform duration-700 ease-in-out">
          <!-- Slide 1 -->
          <div class="w-1/4 px-4 flex flex-col items-center">
            <img src="image/poultry.png" alt="Poultry" class="h-56 w-56 object-cover rounded-xl shadow-lg">
            <p class="mt-4 text-xl font-semibold text-orange-800">Poultry</p>
          </div>
          <!-- Slide 2 -->
          <div class="w-1/4 px-4 flex flex-col items-center">
            <img src="image/seafood.png" alt="Seafood" class="h-56 w-56 object-cover rounded-xl shadow-lg">
            <p class="mt-4 text-xl font-semibold text-orange-800">Seafood</p>
          </div>
          <!-- Slide 3 -->
          <div class="w-1/4 px-4 flex flex-col items-center">
            <img src="image/daging.png" alt="Meat" class="h-56 w-56 object-cover rounded-xl shadow-lg">
            <p class="mt-4 text-xl font-semibold text-orange-800">Meat</p>
          </div>
          <!-- Slide 4 -->
          <div class="w-1/4 px-4 flex flex-col items-center">
            <img src="image/sausages.png" alt="Vegetable" class="h-56 w-56 object-cover rounded-xl shadow-lg">
            <p class="mt-4 text-xl font-semibold text-orange-800">sausages</p>
          </div>
          <!-- Slide 5 -->
          <div class="w-1/4 px-4 flex flex-col items-center">
            <img src="image/frozen.png" alt="Fruit" class="h-56 w-56 object-cover rounded-xl shadow-lg">
            <p class="mt-4 text-xl font-semibold text-orange-800">Frozen Food</p>
          </div>
        </div>
  
        <!-- Carousel Controls -->
        <div class="absolute inset-0 flex items-center justify-between px-4">
          <button onclick="prevSlide()" class="bg-white p-2 rounded-full shadow-md hover:bg-gray-100 transition">
            <i class="fas fa-chevron-left text-orange-600"></i>
          </button>
          <button onclick="nextSlide()" class="bg-white p-2 rounded-full shadow-md hover:bg-gray-100 transition">
            <i class="fas fa-chevron-right text-orange-600"></i>
          </button>
        </div>
      </div>
    </div>
  </section>

 <!-- Customer Review Section -->

<!-- Customer Review Section -->
<section class="bg-white py-20">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h2 class="text-4xl font-bold text-orange-600 mb-10">What Our Customers Say</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-yellow-50 p-6 rounded-2xl shadow-md hover:shadow-xl transition">
          <p class="text-gray-700 italic mb-4">"Produk dari Agro Pangan Maju sangat segar dan pengirimannya cepat. Saya sangat puas dengan pelayanannya!"</p>
          <div class="flex flex-col items-center gap-1">
            <div class="text-orange-500 text-lg">★★★★★</div>
            <p class="font-semibold text-gray-800">Sarah Wijaya</p>
          </div>
        </div>
        <div class="bg-yellow-50 p-6 rounded-2xl shadow-md hover:shadow-xl transition">
          <p class="text-gray-700 italic mb-4">"Kualitas daging dan seafood yang kami terima selalu dalam kondisi prima. Mitra yang bisa diandalkan!"</p>
          <div class="flex flex-col items-center gap-1">
            <div class="text-orange-500 text-lg">★★★★★</div>
            <p class="font-semibold text-gray-800">Budi Santoso</p>
          </div>
        </div>
        <div class="bg-yellow-50 p-6 rounded-2xl shadow-md hover:shadow-xl transition">
          <p class="text-gray-700 italic mb-4">"Distribusi rantai dinginnya sangat terjaga, kami tidak pernah mengalami masalah kualitas!"</p>
          <div class="flex flex-col items-center gap-1">
            <div class="text-orange-500 text-lg">★★★★★</div>
            <p class="font-semibold text-gray-800">Dewi Lestari</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-yellow-100 py-20">
    <div class="max-w-6xl mx-auto px-6 text-center">
      <h2 class="text-4xl font-bold text-orange-600 mb-4">OUR SERVICES</h2>
      <p class="text-orange-700 mb-10 max-w-3xl mx-auto">
        PT Agro Pangan Maju menyediakan layanan distribusi dan yang kami sediakan meliputi berbagai layanan berikut. Layanan kami bertujuan untuk memenuhi kebutuhan beberapa layanan yang umumnya kami tawarkan yaitu:
      </p>
      <button class="bg-orange-600 text-white py-2 px-6 rounded-full hover:bg-orange-700 transition mb-10">
        LEARN MORE
      </button>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition">
          <h3 class="text-xl font-semibold text-orange-800 mb-2">Penyedia Bahan Baku</h3>
          <p class="text-gray-700">Penyediaan bahan baku yang berkualitas tinggi untuk memenuhi kebutuhan industri makanan dan minuman. Kami menyediakan bahan baku seperti seafood, ikan, dan lainnya.</p>
        </div>
        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition">
          <h3 class="text-xl font-semibold text-orange-800 mb-2">Distribusi dan Pengiriman</h3>
          <p class="text-gray-700">Dari mengambil distribusi dan pengiriman produk makanan dan minuman ke berbagai lokasi. Kami memastikan produk sampai dengan aman dan tepat waktu.</p>
        </div>
        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition">
          <h3 class="text-xl font-semibold text-orange-800 mb-2">Jasa Pengolahan</h3>
          <p class="text-gray-700">Menerima jasa pengolahan makanan, pengemasan, dan penyimpanan. Kami memastikan produk yang diolah memenuhi standar kebersihan dan kualitas.</p>
        </div>
        <div class="bg-white rounded-2xl shadow-md p-6 hover:shadow-xl transition">
          <h3 class="text-xl font-semibold text-orange-800 mb-2">Penyimpanan</h3>
          <p class="text-gray-700">Menyediakan fasilitas penyimpanan dengan kondisi yang sesuai untuk menjaga kesegaran dan kualitas produk. Kami memastikan produk tetap dalam kondisi terbaik.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Typing Effect Script -->
  <script>
    const phrases = [
      {
        before: "The Best ",
        highlight: "Food Supplier",
        after: " on Earth"
      },
      {
        before: "The Best ",
        highlight: "Meat Supplier",
        after: " on Earth"
      },
      {
        before: "The Best ",
        highlight: "Seafood Supplier",
        after: " on Earth"
      },
      {
        before: "The Best ",
        highlight: "Poultry Supplier",
        after: " on Earth"
      }
    ];
  
    const el = document.getElementById("typewriter");
  
    let phraseIndex = 0;
    let charIndex = 0;
    let part = 'before'; // bagian mana yg sedang diketik
    let isDeleting = false;
  
    function typeLoop() {
      const current = phrases[phraseIndex];
      let display = "";
  
      if (!isDeleting) {
        if (part === 'before') {
          charIndex++;
          display = current.before.substring(0, charIndex);
          if (charIndex === current.before.length) {
            part = 'highlight';
            charIndex = 0;
          }
        } else if (part === 'highlight') {
          charIndex++;
          display = current.before + `<span class="text-red-600 font-semibold">` + current.highlight.substring(0, charIndex) + `</span>`;
          if (charIndex === current.highlight.length) {
            part = 'after';
            charIndex = 0;
          }
        } else if (part === 'after') {
          charIndex++;
          display = current.before + `<span class="text-red-600 font-semibold">` + current.highlight + `</span>` + current.after.substring(0, charIndex);
          el.innerHTML = display;
  
          if (charIndex === current.after.length) {
            isDeleting = true;
            setTimeout(typeLoop, 2000); // jeda sebelum mulai menghapus
            return;
          }
        }
      } else {
        if (part === 'after') {
          charIndex--;
          display = current.before + `<span class="text-red-600 font-semibold">` + current.highlight + `</span>` + current.after.substring(0, charIndex);
          if (charIndex === 0) {
            part = 'highlight';
            charIndex = current.highlight.length;
          }
        } else if (part === 'highlight') {
          charIndex--;
          display = current.before + `<span class="text-red-600 font-semibold">` + current.highlight.substring(0, charIndex) + `</span>`;
          if (charIndex === 0) {
            part = 'before';
            charIndex = current.before.length;
          }
        } else if (part === 'before') {
          charIndex--;
          display = current.before.substring(0, charIndex);
          if (charIndex === 0) {
            isDeleting = false;
            phraseIndex = (phraseIndex + 1) % phrases.length;
            part = 'before';
            charIndex = 0;
          }
        }
      }
  
      el.innerHTML = display;
  
      const typingSpeed = isDeleting ? 50 : 120;
      setTimeout(typeLoop, typingSpeed);
    }
  
    document.addEventListener("DOMContentLoaded", typeLoop);

    let currentIndex = 0;
  const carousel = document.getElementById('carousel');
  const slidesToShow = 4;
  const totalSlides = carousel.children.length;

  function updateCarousel() {
    const offset = -(100 / slidesToShow) * currentIndex;
    carousel.style.transform = `translateX(${offset}%)`;
  }

  function nextSlide() {
    if (currentIndex < totalSlides - slidesToShow) {
      currentIndex++;
    } else {
      currentIndex = 0;
    }
    updateCarousel();
  }

  function prevSlide() {
    if (currentIndex > 0) {
      currentIndex--;
    } else {
      currentIndex = totalSlides - slidesToShow;
    }
    updateCarousel();
  }

  function openWhatsApp() {
    const phone = "628123456789"; // Ganti dengan nomor WA kamu
    const message = "Halo! Saya tertarik dan ingin berdiskusi.";
    const url = `https://wa.me/${phone}?text=${encodeURIComponent(message)}`;
    window.open(url, "_blank");
  }

  function closeBubble() {
    document.getElementById("whatsappBubble").style.display = "none";
  }
  </script>
<?php include 'footer.php'; ?>
