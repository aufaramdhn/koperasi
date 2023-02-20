<?php
$active = 'Home';
$title = "Home | Koperasi";
include "../../layout/header.php";

date_default_timezone_set('Asia/jakarta');
$today = date("Y-m-d H:i:s");
?>

<style>
  @import url("https://fonts.googleapis.com/css?family=Poppins:400,700");

  .lines {
    margin: auto;
    width: 70px;
    position: relative;
    border-top: 2px solid #2192ff;
    margin-top: 15px;
  }

  .btn-common {
    border: 1px solid #2192ff;
    background: #2192ff;
    position: relative;
    color: #fff;
    z-index: 1;
    border-radius: 30px;
  }

  .btn-common:hover {
    color: #fff;
    background: #1484ec;
    border-color: #1484ec;
    transition: all 0.5s ease-in-out;
    -moz-transition: all 0.5s ease-in-out;
    -webkit-transition: all 0.5s ease-in-out;
  }

  p {
    font-size: 14px;
    line-height: 26px;
  }

  .section-header {
    color: #fff;
    margin-bottom: 40px;
    text-align: center;
  }

  .section-header .section-title {
    font-size: 42px;
    margin-top: 0;
    text-transform: uppercase;
    font-weight: 700;
    color: #333;
    position: relative;
  }
</style>

<div class="mt-3 container-fluid">
  <section class="mt-3">
    <div class="container">
      <div class="text-center section-header">
        <h2 class="section-title">Tentang Kami</h2>
        <hr class="mb-3 lines" />
      </div>
      <div class="row">
        <div class="order-2 order-md-1 col-12 col-md-6" style="text-align: justify;">
          <p class="">Dengan semangat perubahan dan visi menjadi koperasi terkini dan inovatif di Indonesia, Koperasi Namastra bertekad untuk menjadi koperasi yang modern, profesional dan antusias dalam membangun perekonomian rakyat. Perwujudan keseriusan para pendiri terlihat dalam penempatan pengelola yang sudah memiliki banyak pengalaman di Perbankan dan Koperasi.</p>
          <a href="#" class="btn btn-common">Daftar Sekarang</a>
        </div>
        <div class="order-1 mb-2 order-md-2 col-12 col-md-6">
          <img src="../../assets/landing-page/img/tentang-kami.jpg" width="100%">
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="row">
      <div class="mt-2 mb-2 text-center section-header">
        <h2 class="section-title">Visi & Misi</h2>
        <hr class="mb-3 lines" />
      </div>
      <div class="mb-3 col-12 col-md-6">
        <div class="card">test</div>
      </div>
      <div class="col-12 col-md-6">
        <div class="card">test</div>
      </div>
    </div>
  </section>
</div>

<?php include "../../layout/footer.php" ?>