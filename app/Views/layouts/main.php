<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-template="vertical-menu-template-free">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Authentification</title>

  <!-- Site favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="/assets/vendors/images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/assets/vendors/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/assets/vendors/images/favicon-16x16.png">


  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="/assets/vendors/styles/core.css">
  <link rel="stylesheet" type="text/css" href="/assets/vendors/styles/icon-font.min.css">
  <link rel="stylesheet" type="text/css" href="/assets/vendors/styles/style.css">

 <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- DevExtreme theme -->
    <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/23.1.3/css/dx.light.css">

  <?=$this->renderSection('css')?>
</head>

<body>

  <!-- Header -->
  <?=$this->include('layouts/partials/header.php')?>

  <!-- Sidebar -->
  <?=$this->include('layouts/partials/sidebar.php')?>

  <!-- Content -->
  <div class="main-container">
    <div class="pd-ltr-20">
      <?=$this->renderSection('content')?>
    </div>
  </div>


  <!-- js -->
  <!-- Sweeat alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.2/dist/sweetalert2.all.min.js"></script>

  <script src="/assets/vendors/scripts/core.js"></script>
  <script src="/assets/vendors/scripts/script.min.js"></script>
  <script src="/assets/vendors/scripts/layout-settings.js"></script>


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

<?=$this->renderSection('js')?>
</body>

</html>