<?php
include_once("inc/configg.php");
include_once("inc/fungsi.php");
include_once("headerweb.php");
?>
    <link rel="stylesheet" href="css/recommend.css">
    <header>
        <h1>Explore Our Recommendations</h1>
    </header>
<div class="container">
    <div class="table city">
            <input type="radio" name="city" id="city1" checked>
            <label for="city1">Surabaya</label>
            
            <input type="radio" name="city" id="city2">
            <label for="city2">Gresik</label>
            
            <input type="radio" name="city" id="city3">
            <label for="city3">Lamongan</label>

            <input type="radio" name="city" id="city4">
            <label for="city4">Bojonegoro</label>

            <input type="radio" name="city" id="city5">
            <label for="city5">Malang</label>

            <input type="radio" name="city" id="city6">
            <label for="city6">Pasuruan</label>

            <input type="radio" name="city" id="city7">
            <label for="city7">Mojokerto</label>

            <input type="radio" name="city" id="city8">
            <label for="city8">Batu</label>
      
    </div>

    <div class="table category">
            
            <img src="gambar/inap.jpg">
            <input type="radio" name="category" id="penginapan" checked>
            <label for="penginapan">Penginapan</label>
            
            <img src="gambar/alam.jpg">
            <input type="radio" name="category" id="wisata">
            <label for="wisata">Wisata</label>
            
            <img src="gambar/jajanan.jpg">
            <input type="radio" name="category" id="kuliner">
            <label for="kuliner">Kuliner</label>

            <img src="gambar/blanja.jpg">
            <input type="radio" name="shopping" id="shopping">
            <label for="shopping">Pusat Perbelanjaan</label>
    </div>

    <div class="table recommendations">
        <!-- Di sini Anda dapat menambahkan rekomendasi untuk setiap kategori -->
        <div class="penginapan">
            <h2>Penginapan</h2>
            <ul class="accordion">
                <li>
                    <input type="radio" name="accordion" id="satu" checked>
                    <label class="kategori-label" for="satu"><?php echo ambil_rekomendasi('6')?></label>
                    <div class="content">
                        <img src="gambar/morningsun.jpg">
                        <p><?php echo ambil_deskripsi('6')?></p>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Rekomendasi Wisata Surabaya -->
        <div class="wisata">
            <h2>Wisata</h2>
            <ul class="accordion">
                <li>
                    <input type="radio" name="accordion" id="tiga" checked>
                    <label for="tiga"><?php echo ambil_rekomendasi('7')?></label>
                    <div class="content">
                        <img src="gambar/atlantis.jpg">
                        <p><?php echo ambil_deskripsi('7')?></p>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Rekomendasi Kuliner Surabaya -->
        <div class="kuliner">
            <h2>Kuliner</h2>
            <ul class="accordion">
                <li>
                    <input type="radio" name="accordion" id="tujuh" checked>
                    <label for="tujuh"><?php echo ambil_rekomendasi('6')?></label>
                    <div class="content">
                        <img src="asset/sinjay.jpg">
                        <p><?php echo ambil_deskripsi('6')?></p>
                    </div>
                </li>
                <li>
                    <input type="radio" name="accordion" id="delapan">
                    <label for="delapan"> Lontong Balap Garuda Pak Gendut</label>
                    <div class="content">
                        <img src="asset/lntongblp.jpg">
                        <p>Lontong balap juga menjadi salah satu kuliner Surabaya yang khas dan legendaris.dari kita mungkin akan menemukan banyak tempat makan Lontong Balap, tetapi yang paling legendaris adalah Lontong Balap Garuda Pak Gendut di Jalan Kranggan.
                            Tempat makan ini sudah ada sejak 1958 dan masih menjadi pilihan banyak warga lokal dan wisawatan saat berkunjung Surabaya.
                            Beberapa pelanggannya menyebut, rasa makanan di warung ini masih sangat terjaga hingga saat ini.
                            Padahal, makanan khas Surabaya ini sudah berdiri lebih dari empat dekade. <br>
                            Alamat : Jalan Kranggan no. 60, Sawahan, Surabaya (depan bekas Bioskop Garuda)</p>
                    </div>
                </li>
            </ul>
        </div>
        <script>
            // Fungsi untuk menyembunyikan semua rekomendasi
            function hideAllRecommendations() {
                const allRecommendations = document.querySelectorAll('.table.recommendations > div');
                allRecommendations.forEach(recommendation => {
                    recommendation.style.display = 'none';
                });
            }
    
            // Fungsi untuk menampilkan rekomendasi sesuai dengan kategori yang dipilih
            function showRecommendationsByCategory(category) {
                const selectedRecommendations = document.querySelectorAll(`.table.recommendations > .${category}`);
                selectedRecommendations.forEach(recommendation => {
                    recommendation.style.display = 'block';
                });
            }
    
            // Fungsi untuk menangani perubahan pemilihan kategori
            function handleCategoryChange() {
                const categoryRadios = document.querySelectorAll('input[type="radio"][name="category"]');
                categoryRadios.forEach(radio => {
                    radio.addEventListener('change', (event) => {
                        hideAllRecommendations(); // Sembunyikan semua rekomendasi
                        const selectedCategory = event.target.id; // Dapatkan ID kategori yang dipilih
                        showRecommendationsByCategory(selectedCategory); // Tampilkan rekomendasi yang sesuai
                    });
                });
            }
    
            // Panggil fungsi untuk menangani perubahan pemilihan kategori
            handleCategoryChange();
        </script>
          

</body>
</html>
