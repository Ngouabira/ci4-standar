<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <!-- Basic Page Info -->
  <meta charset="utf-8">
  <title>Authentification</title>

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
  <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css">
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

  <?=$this->renderSection('css')?>
  <!-- Icons. Uncomment required icon fonts -->

  <!-- DevExtreme theme -->
  <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/23.1.3/css/dx.light.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/cldrjs/0.5.0/cldr.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cldrjs/0.5.0/cldr/event.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cldrjs/0.5.0/cldr/supplemental.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/globalize/1.3.0/globalize.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/globalize/1.3.0/globalize/message.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/globalize/1.3.0/globalize/number.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/globalize/1.3.0/globalize/currency.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/globalize/1.3.0/globalize/date.min.js"></script>
  <!-- DevExtreme library -->
  <script src="https://cdn3.devexpress.com/jslib/23.1.3/js/dx.all.js"></script>
  <!-- Dictionary files for German language -->
  <script src="https://cdn3.devexpress.com/jslib/23.1.3/js/localization/dx.messages.fr.js"></script>
  <script src="https://cdn3.devexpress.com/jslib/23.1.3/js/localization/dx.messages.it.js"></script>
  <!-- Common and language-specific CLDR data -->
  <!-- <script src="https://unpkg.com/devextreme-cldr-data/supplemental.js"></script> -->
  <!-- <script src="https://unpkg.com/devextreme-cldr-data/fr.js"></script> -->
  <script src="/assets/js/app.js"></script>

</head>

<body>


  <!-- Header -->
  <?=$this->include('layouts/partials/header.php')?>

  <!-- Sidebar -->
  <?=$this->include('layouts/partials/sidebar.php')?>

  <!-- Layout container -->


  <!-- Content -->
  <div class="main-container">
		<div class="pd-ltr-20">
  <?=$this->renderSection('content')?>
    </div>
  </div>


  <!-- Footer -->
  <?=$this->include('layouts/partials/footer.php')?>





  <!-- js -->
  <script src="assets/vendors/scripts/core.js"></script>
  <script src="assets/vendors/scripts/script.min.js"></script>
  <script src="assets/vendors/scripts/process.js"></script>
  <script src="assets/vendors/scripts/layout-settings.js"></script>
  <script src="assets/src/plugins/apexcharts/apexcharts.min.js"></script>
  <script src="assets/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
  <script src="assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
  <script src="assets/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
  <script src="assets/vendors/scripts/dashboard.js"></script>
  <?=$this->renderSection('js')?>
</body>

</html>