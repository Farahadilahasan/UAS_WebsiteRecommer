<?php
include_once("inc/configg.php");
include_once("inc/fungsi.php");
include_once("headerweb.php");
?>
<link rel="stylesheet" href="css/provide.css">
    <header>
       <!-- Formulir Input Data Rekomendasi -->
<section id="provide-recommendation">
    <div class="kolom">
        <p class="deskripsi">Provide Recommendation</p>
        <h2>Submit Your Recommendation</h2>
        <form action="add_provide.php" method="post" enctype="multipart/form-data">
            <label for="kota">Kota:</label>
            <select name="kota" required>
                <option value="Surabaya">Surabaya</option>
                <option value="Gresik">Gresik</option>
                <option value="Gresik">Malang</option>
                <option value="Gresik">Lamongan</option>
                <option value="Gresik">Kediri</option>
                <option value="Gresik">Madiun</option>
                <option value="Gresik">Batu</option>
            </select>

            <label for="kategori">Kategori:</label>
            <select name="kategori" required>
                <option value="Penginapan">Penginapan</option>
                <option value="Wisata">Wisata</option>
                
                <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
            </select>

            <label for="rekomendasi">Rekomendasi:</label>
            <input type="text" name="rekomendasi" required>

            <label for="foto">Foto:</label>
            <input type="file" name="foto" accept="image/*" required>

            <label for="deskripsi">Deskripsi:</label>
            <textarea name="deskripsi" rows="4" required></textarea>

            <button type="submit">Submit</button>
        </form>
    </div>
</section>
