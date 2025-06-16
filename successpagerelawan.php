<?php include 'components/header.php'; ?>

<main>
  <div style="min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1.5rem; text-align: center;">
    <h1 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1.5rem;">
      Horeee! Kamu sudah daftar menjadi bagian dari <br />
      <span style="font-weight: bold;">Janji Baik</span>, dan kami super excited!
    </h1>

    <img 
      src="assets/images/successpage/daftarrelawan.png" 
      alt="Terima Kasih" 
      style="width: 100%; max-width: 320px; margin-bottom: 2rem;" 
    />

    <p style="max-width: 48rem; font-size: 1rem; margin-bottom: 2.5rem;">
      Terima kasih sudah mau mulai perjalanan keren ini bareng kami.
      Petualangan seru baru aja dimulai. Yuk, kita wujudkan janji baikmu mulai hari ini!
    </p>

    <div>
      <a 
        href="/janji-baik/index.php" 
        style="position: absolute; right: 2rem; display: flex; align-items: center; gap: 0.5rem; margin-top: 2rem; background-color: #fb923c; color: white; padding: 0.5rem 1.5rem; border-radius: 9999px; text-decoration: none;"
        onmouseover="this.style.backgroundColor='#f97316'"
        onmouseout="this.style.backgroundColor='#fb923c'"
      >
        <img src="assets/images/arrowleft.png" alt="Kembali" style="height: 1.25rem; width: 1.25rem;" />
        <p style="margin: 0;">Kembali</p>
      </a>
    </div>
  </div>
</main>

<?php include 'components/footer.php'; ?>
