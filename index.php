<!DOCTYPE html>
<html lang="bg">

<head>
  <title>Автосервиз</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap"
    rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- icons -->

  <link rel="stylesheet" href="css/animate.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/magnific-popup.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link rel="stylesheet" href="css/jquery.timepicker.css">

  <link rel="stylesheet" href="css/flaticon.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="wrap">
    <?php
    session_start();
    require 'header.php';
    ?>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
          aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="fa fa-bars"></span> Меню</button>
        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active"><a href="index.php" class="nav-link">Автосервиз</a></li>
            <?php
            if (isset($_SESSION['user_id'])) {
              ?>
              <li class="nav-item"><a href="contact.php" class="nav-link">Контакти</a></li>
              <li class="nav-item"><a href="car_accessories.php" class="nav-link">аксесоари</a></li>
              <li class="nav-item"><a href="car_parts.php" class="nav-link">Части</a></li>
              <li class="nav-item"><a href="car_tools.php" class="nav-link">Инструменти</a></li>
              <?php
            } else {
              ?>
              <?php
            }
            ?>
          </ul>
        </div>

        <div class="form-group d-flex">
          <?php
          if (isset($_SESSION['user_id'])) {
            ?>
            <a style="margin-right:100px; font-size: 19px" href="cart.php"><span
                class="fa fa-shopping-cart"></span>Количка</a>
            <?php
          } else {
            ?>
            <a style="padding-right:22px; font-size: 19px" href="register.php"><span class="fa fa-file-text-o"></span>
              Регистрация</a>
            <a style="padding-right:22px; font-size: 19px" href="login.php"><span class="fa fa-sign-in"></span>
              Вход</a>
            <?php
          }
          ?>
        </div>
      </div>
    </nav>
    <!-- END nav and header-->
    <!-- Slider-->
    <div class="hero-wrap">
      <div class="home-slider owl-carousel">
        <div class="slider-item" style="background-image:url(images/bg_1.jpg);">
          <div class="overlay"></div>
          <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-start">
              <div class="col-md-6 ftco-animate">
                <div class="text w-100">
                  <h2>Ние сме най-добрият автомобилен сервиз</h2>
                  <h1 class="mb-4">Направете колата си по-добра</h1>
                  <p><a href="#" class="btn btn-primary">Поддържане на сервизна книга</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="slider-item" style="background-image:url(images/WORKING.png);">
          <div class="overlay"></div>
          <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-start">
              <div class="col-md-6 ftco-animate">
                <div class="text w-100">
                  <h2>Грижете се за вашата кола</h2>
                  <h1 class="mb-4">Време е да ремонтирате колата си</h1>
                  <p><a href="#" class="btn btn-primary">Запазете час</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Slider-->
    <section class="intro">
      <div class="container intro-wrap">
        <div class="row no-gutters">
          <div class="col-md-12 col-lg-9 bg-intro d-sm-flex align-items-center align-items-stretch">
            <div class="intro-box d-flex align-items-center">
              <div class="icon d-flex align-items-center justify-content-center">
                <i class="flaticon-repair"></i>
              </div>
              <h2 class="mb-0">Готов ли си? <span>Нека го ремонтираме сега!</span></h2>
            </div>
            <a href="contact.php" class="bg-primary btn-custom d-flex align-items-center"><span>Резервирайте
                среща</span></a>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center pb-5 mb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <span class="subheading">Ние предлагаме услуги и части</span>
            <h2>Някои от нашите автомобилни услуги</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 services ftco-animate">
            <div class="d-block d-flex">
              <div class="icon d-flex justify-content-center align-items-center">
                <span class="flaticon-car-service"></span>
              </div>
              <div class="media-body pl-3">
                <h3 class="heading">Смяна на маслото</h3>
                <p>Моите производители на заменени масла във всички марки автомобили</p>
                <p><a href="#" class="btn-custom">Прочетете още</a></p>
              </div>
            </div>
            <div class="d-block d-flex">
              <div class="icon d-flex justify-content-center align-items-center">
                <span class="flaticon-tyre"></span>
              </div>
              <div class="media-body pl-3">
                <h3 class="heading">Смяна на гумите</h3>
                <p>Нашата компания предоставя услуги по сезонна заменена покривка, а също така предоставя място за
                  съхранение на вашите шин и дискове.</p>
                <p><a href="#" class="btn-custom">Прочетете още</a></p>
              </div>
            </div>

          </div>
          <div class="col-md-4 services ftco-animate">
            <div class="d-block d-flex">
              <div class="icon d-flex justify-content-center align-items-center">
                <span class="flaticon-battery"></span>
              </div>
              <div class="media-body pl-3">
                <h3 class="heading">Батерии</h3>
                <p>Диагностика, поддръжка, подмяна на автомобилни акумулатори</p>
                <p><a href="#" class="btn-custom">Прочетете още</a></p>
              </div>
            </div>
            <div class="d-block d-flex">
              <div class="icon d-flex justify-content-center align-items-center">
                <span class="flaticon-car-engine"></span>
              </div>
              <div class="media-body pl-3">
                <h3 class="heading">Ремонт на двигател</h3>
                <p>Ремонт на двигатели с всякаква сложност</p>
                <p><a href="#" class="btn-custom">Прочетете още</a></p>
              </div>
            </div>
          </div>

          <div class="col-md-4 services ftco-animate">
            <div class="d-block d-flex">
              <div class="icon d-flex justify-content-center align-items-center">
                <span class="flaticon-tow-truck"></span>
              </div>
              <div class="media-body pl-3">
                <h3 class="heading">Аварийна кола</h3>
                <p>Ние предлагаме услуги за теглене на камиони</p>
                <p><a href="#" class="btn-custom">Прочетете още</a></p>
              </div>
            </div>
            <div class="d-block d-flex">
              <div class="icon d-flex justify-content-center align-items-center">
                <span class="flaticon-repair"></span>
              </div>
              <div class="media-body pl-3">
                <h3 class="heading">Поддръжка на автомобила</h3>
                <p>Ние предлагаме услуги по поддръжка на автомобили от всички марки</p>
                <p><a href="#" class="btn-custom">Прочетете още</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- END car services-->
    <!-- If i want to get rid of the animations i have to delete animated.css and this class name -> ftco-animate -->
    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center pb-5 mb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2>Някои от частите ни за автомобили</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 services ftco-animate">
            <div class="d-block d-flex">
              <div class="icon d-flex justify-content-center align-items-center">
                <span class="flaticon-car-service"></span>
              </div>
              <div class="media-body pl-3">
                <h3 class="heading">Компоненти на двигателя</h3>
                <p>Запалителни свещи, филтри, ремъци, маркучи и уплътнения.</p>
                <p><a href="#" class="btn-custom">Прочетете още</a></p>
              </div>
            </div>
            <div class="d-block d-flex">
              <div class="icon d-flex justify-content-center align-items-center">
                <span class="flaticon-tyre"></span>
              </div>
              <div class="media-body pl-3">
                <h3 class="heading">Гуми и колела</h3>
                <p>Гуми, джанти и аксесоари за колела.</p>
                <p><a href="#" class="btn-custom">Прочетете още</a></p>
              </div>
            </div>

          </div>
          <div class="col-md-4 services ftco-animate">
            <div class="d-block d-flex">
              <div class="icon d-flex justify-content-center align-items-center">
                <span class="flaticon-battery"></span>
              </div>
              <div class="media-body pl-3">
                <h3 class="heading">Части на окачването и кормилното управление</h3>
                <p>Амортисьори, подпори, сачмени шарнири и съединителни пръти.</p>
                <p><a href="#" class="btn-custom">Прочетете още</a></p>
              </div>
            </div>
            <div class="d-block d-flex">
              <div class="icon d-flex justify-content-center align-items-center">
                <span class="flaticon-car-engine"></span>
              </div>
              <div class="media-body pl-3">
                <h3 class="heading">Електрически части</h3>
                <p>Акумулатори, алтернатори, стартери и предпазители.</p>
                <p><a href="#" class="btn-custom">Прочетете още</a></p>
              </div>
            </div>
          </div>

          <div class="col-md-4 services ftco-animate">
            <div class="d-block d-flex">
              <div class="icon d-flex justify-content-center align-items-center">
                <span class="flaticon-tow-truck"></span>
              </div>
              <div class="media-body pl-3">
                <h3 class="heading">Вътрешни принадлежности</h3>
                <p>Седалки, калъфи за седалки, постелки за под и освежители за въздух.</p>
                <p><a href="#" class="btn-custom">Прочетете още</a></p>
              </div>
            </div>
            <div class="d-block d-flex">
              <div class="icon d-flex justify-content-center align-items-center">
                <span class="flaticon-repair"></span>
              </div>
              <div class="media-body pl-3">
                <h3 class="heading">Външни аксесоари</h3>
                <p>Чистачки, огледала и панели на каросерията.</p>
                <p><a href="#" class="btn-custom">Прочетете още</a></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- END car parts-->

    <section class="ftco-counter" id="section-counter">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18 text-center">
              <div class="text">
                <strong class="number" data-number="45">0</strong>
              </div>
              <div class="text">
                <span>Години на опит</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18 text-center">
              <div class="text">
                <strong class="number" data-number="8500">0</strong>
              </div>
              <div class="text">
                <span>Резервни части</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18 text-center">
              <div class="text">
                <strong class="number" data-number="2342">0</strong>
              </div>
              <div class="text">
                <span>Клиенти</span>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
            <div class="block-18 text-center">
              <div class="text">
                <strong class="number" data-number="30">0</strong>
              </div>
              <div class="text">
                <span>Служители</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-appointment ftco-section ftco-no-pt ftco-no-pb img"
      style="background-image: url(images/bg_3.jpg);">
      <div class="overlay"></div>
      <div class="container">
        <div class="row d-md-flex justify-content-end">
          <div class="col-md-12 col-lg-6 half p-3 py-5 pl-lg-5 ftco-animate heading-section heading-section-white">
            <span class="subheading">Регистрирайте се за услугата</span>
            <h2 class="mb-4">Безплатна консултация</h2>
            <form action="#" class="appointment">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <div class="form-field">
                      <div class="select-wrap">
                        <div class="icon"><span class="fa fa-chevron-down"></span></div>
                        <select name="" id="" class="form-control">
                          <option value="">Изберете услуги</option>
                          <option value="">Change Oil</option>
                          <option value="">Engine Repair</option>
                          <option value="">Battery Replace</option>
                          <option value="">Change Tire</option>
                          <option value="">Tow Truck</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Твоето име">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Номер на превозното средство">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-wrap">
                      <div class="icon"><span class="fa fa-calendar"></span></div>
                      <input type="text" class="form-control appointment_date" placeholder="Дата">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-wrap">
                      <div class="icon"><span class="fa fa-clock-o"></span></div>
                      <input type="text" class="form-control appointment_time" placeholder="Време">
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <textarea name="" id="" cols="30" rows="7" class="form-control" placeholder="Съобщение"></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <input type="submit" value="Изпрати съобщение" class="btn btn-dark py-3 px-4">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>



    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center pb-5 mb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <span class="subheading">Цени и планове</span>
            <h2>Ценообразуване</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="block-7">
              <div class="text-center">
                <span class="excerpt d-block">Смяна на масло</span>
                <span class="price"><sup>$</sup> <span class="number">58.98</span></span>

                <div class="pricing-text">
                  <p>Замена масла и филтруващ елемент</p>
                </div>

                <a href="#" class="btn btn-secondary d-block px-2 py-3">Регистрирай се!</a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 ftco-animate">
            <div class="block-7">
              <div class="text-center">
                <span class="excerpt d-block">Диагностика на двигателя</span>
                <span class="price"><sup>$</sup> <span class="number">33.75</span></span>

                <div class="pricing-text">
                  <p>Компютърна диагностика на двигателя</p>
                </div>

                <a href="#" class="btn btn-secondary d-block px-2 py-3">Регистрирай се!</a>
              </div>
            </div>
          </div>
          <div class="col-lg-3 ftco-animate">
            <div class="block-7">
              <div class="text-center">
                <span class="excerpt d-block">Аварийна кола</span>
                <span class="price"><sup>$</sup> <span class="number">85.00</span></span>

                <div class="pricing-text">
                  <p>В целия град и в цялата страна</p>
                </div>

                <a href="#" class="btn btn-secondary d-block px-2 py-3">Регистрирай се!</a>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="block-7">
              <div class="text-center">
                <span class="excerpt d-block">Car Wash</span>
                <span class="price"><sup>$</sup> <span class="number">20.50</span></span>

                <div class="pricing-text">
                  <p>Сложна автомивка без химическо чистене</p>
                </div>

                <a href="#" class="btn btn-secondary d-block px-2 py-3">Регистрирай се!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <?php
    require "footer.php";
    ?>



    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10"
          stroke="#F96D00" />
      </svg></div>


    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.easing.1.3.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/scrollax.min.js"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="js/google-map.js"></script>
    <script src="js/main.js"></script>

</body>

</html>