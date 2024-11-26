<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../libs/img/icon.png" type="image/x-icon">
    <title><?php echo $title_page; ?></title>
    <link rel="stylesheet" href="../libs/css/wirefigma.css">
    <link rel="stylesheet" href="../libs/css/style.css">
    <link rel="stylesheet" href="../libs/icofont/icofont.min.css">
    <style>
        #send-notif{
            display: none;
        }
        @media (max-width: 768px) {
        .wrapper {
            grid-template-columns: auto;
        }
        .wrapper-left {
            grid-template-columns: 1fr;
        }
        .body-bold, .label-bold {
            font-size: 14px;
        }
        .card-horizontal .card__wrap {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
                -ms-flex-direction: column;
                    flex-direction: column;
        }
        .card-horizontal .card__wrap .card__image img {
            width: 100%;
            max-height: 350px;
        }
        }
        @media (max-width: 540px) {
        .card__action {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
                -ms-flex-direction: column;
                    flex-direction: column;
            -webkit-box-align: start;
                -ms-flex-align: start;
                    align-items: flex-start;
        }
        }
    </style>
</head>
<body>