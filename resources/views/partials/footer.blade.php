<footer class="bg-brand-green text-white py-5 mt-5">
  <div class="container">
    <div class="row gy-4 text-center text-md-start align-items-center">
      
      <!-- Logo & Deskripsi -->
      <div class="col-md-4">
        <h5 class="fw-bold text-white mb-3">Lapor Sampah</h5>
        <p class="small mb-3 opacity-75">
          Bersama kita wujudkan Purwokerto yang lebih bersih dan sehat.
          Laporkan sampah di sekitarmu, dapatkan poin, dan jadilah bagian dari perubahan!
        </p>
        <p class="small mb-0 opacity-75">
          <i class="bi bi-geo-alt-fill me-1"></i> Purwokerto, Jawa Tengah, Indonesia
        </p>
      </div>

      <!-- Navigasi -->
      <div class="col-md-4">
        <h6 class="fw-semibold mb-3">Navigasi</h6>
        <ul class="list-unstyled small mb-0">
          <li><a href="{{ route('fitur') }}" class="text-white text-decoration-none d-block mb-1 opacity-75">Fitur</a></li>
          <li><a href="{{ route('pelajari') }}" class="text-white text-decoration-none d-block mb-1 opacity-75">Pelajari Lebih Lanjut</a></li>
          <li><a href="{{ route('tentang') }}" class="text-white text-decoration-none d-block mb-1 opacity-75">Tentang Kami</a></li>
          <li><a href="#" class="text-white text-decoration-none d-block opacity-75">Kontak</a></li>
        </ul>
      </div>

      <!-- Sosial Media -->
      <div class="col-md-4">
        <h6 class="fw-semibold mb-3">Ikuti Kami</h6>
        <div class="d-flex justify-content-center justify-content-md-start gap-3 fs-5">
          <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
          <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
          <a href="#" class="text-white"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="text-white"><i class="bi bi-youtube"></i></a>
        </div>
      </div>
    </div>

    <hr class="my-4 border-light opacity-50">

    <div class="text-center small opacity-75">
      © 2025 <strong>Lapor Sampah</strong>. Semua hak dilindungi.  
      | Purwokerto <i class="bi bi-heart-fill text-danger"></i> Banyumas Jawa Tengah.
    </div>
  </div>
</footer>


<style>
  :root {
  --brand-green: #17cf17;
}

/* Background footer */
.bg-brand-green {
  background-color: var(--brand-green) !important;
}

/* Text brand */
.text-brand-green {
  color: var(--brand-green) !important;
}

/* Border brand */
.border-brand-green {
  border-color: var(--brand-green) !important;
}

</style>