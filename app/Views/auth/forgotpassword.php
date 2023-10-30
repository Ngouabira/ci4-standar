<!DOCTYPE html>
<html>

<head>
  <!-- Basic Page Info -->
  <meta charset="utf-8">
  <title><?=translate('auth.forgotPassword')?></title>

  <!-- Site favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="assets/vendors/images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/vendors/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/vendors/images/favicon-16x16.png">

  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="assets/vendors/styles/core.css">
  <link rel="stylesheet" type="text/css" href="assets/vendors/styles/icon-font.min.css">
  <link rel="stylesheet" type="text/css" href="assets/vendors/styles/style.css">

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-119386393-1');
  </script>
</head>

<body class="login-page">
  <div class="login-header box-shadow">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <div class="brand-logo">
        <a href="/login">
          <img src="assets/vendors/images/deskapp-logo.svg" alt="">
        </a>
      </div>
      <div class="login-menu">
        <ul>
          <li><a href="/login"><?=translate('base.login')?></a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 col-lg-7">
          <img src="assets/vendors/images/login-page-img.png" alt="">
        </div>
        <div class="col-md-6 col-lg-5">
          <div class="login-box bg-white box-shadow border-radius-10">
            <div class="login-title">
              <h2 class="text-center text-primary"><?=translate('auth.forgotPassword')?> 🔒</h2>
            </div>
            <form action="/forgotpassword" method="POST">
              <?=csrf_field()?>
              <?=$this->include('components/message.php')?>
              <div class="input-group custom">
                <input type="email" name="email" class="form-control form-control-lg" placeholder="<?=translate('auth.email')?>">
                <div class="input-group-append custom">
                  <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="input-group mb-0">
                    <button class="btn btn-primary btn-lg btn-block" type="submit"><?=translate('auth.sendInstructions')?></button>
                  </div>
                  <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373"> <a class="btn btn-outline-primary btn-lg btn-block" href="/login"><?=translate('base.back_to_login')?></a></div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- js -->
  <script src="assets/vendors/scripts/core.js"></script>
  <script src="assets/vendors/scripts/script.min.js"></script>
  <script src="assets/vendors/scripts/process.js"></script>
  <script src="assets/vendors/scripts/layout-settings.js"></script>
</body>

</html>