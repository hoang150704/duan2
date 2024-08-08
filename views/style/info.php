  <!-- Plugins CSS -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/user/theme_shop/assets/css/plugins.css">

  <!-- Main Style CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/user/theme_shop/assets/css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" />
  <!--  -->

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= BASE_URL ?>assets/admin/dist/css/adminlte.min.css">
  <style>
    .custom-hr {
      border: 0;
      height: 2px;
      background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
      margin: 20px 0;
      width: 100%;
      overflow: hidden;
    }

    .timeline {
      border-left: 3px solid #727cf5;
      border-bottom-right-radius: 4px;
      border-top-right-radius: 4px;
      background: rgba(114, 124, 245, 0.09);
      margin: 0 auto;
      letter-spacing: 0.2px;
      position: relative;
      line-height: 1.4em;
      font-size: 1.03em;
      padding: 25px 50px 25px 50px;
      list-style: none;
      text-align: left;
      
    }

    @media (max-width: 767px) {
      .timeline {
        max-width: 98%;
        padding: 25px;
      }
    }

    .timeline h1 {
      font-weight: 300;
      font-size: 1.4em;
    }

    .timeline h2,
    .timeline h3 {
      font-weight: 600;
      font-size: 1rem;
      margin-bottom: 10px;
    }

    .timeline .event {
      border-bottom: 1px dashed #e8ebf1;
      margin-bottom: 15px;
      position: relative;
    }

    @media (max-width: 767px) {
      .timeline .event {
        padding-top: 30px;
      }
    }

    .timeline .event:last-of-type {
      padding-bottom: 0;
      margin-bottom: 0;
      border: none;
    }

    .timeline .event:before,
    .timeline .event:after {
      position: absolute;
      display: block;
      top: 0;
    }

    .timeline .event:before {
      left: -207px;
      content: attr(data-date);
      text-align: right;
      font-weight: 100;
      font-size: 0.9em;
      min-width: 120px;
    }

    @media (max-width: 767px) {
      .timeline .event:before {
        left: 0px;
        text-align: left;
      }
    }

    .timeline .event:after {
      -webkit-box-shadow: 0 0 0 3px #727cf5;
      box-shadow: 0 0 0 3px #727cf5;
      left: -55.8px;
      background: #fff;
      border-radius: 50%;
      height: 9px;
      width: 9px;
      content: "";
      top: 5px;
    }

    @media (max-width: 767px) {
      .timeline .event:after {
        left: -31.8px;
      }
    }

    .rtl .timeline {
      border-left: 0;
      text-align: right;
      border-bottom-right-radius: 0;
      border-top-right-radius: 0;
      border-bottom-left-radius: 4px;
      border-top-left-radius: 4px;
      border-right: 3px solid #727cf5;
    }

    .rtl .timeline .event::before {
      left: 0;
      right: -170px;
    }

    .rtl .timeline .event::after {
      left: 0;
      right: -55.8px;
    }
    .order-summary {
            border: 1px solid #ddd;
            border-radius: .25rem;
            padding: 1rem;
            background-color: #f9f9f9;
        }
        .order-summary .title {
            font-weight: bold;
            margin-bottom: .5rem;
        }
  </style>