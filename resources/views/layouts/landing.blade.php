<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
  <style>
    .main-container {
      width: 100%;
      max-width: 430px;
      min-width: 316px;
      height: 966px;
      border-radius: 48px;
      background-color: #290b4b;
      position: absolute;
      top: 2%;
      left: 50%;
      transform: translateX(-50%);
      text-align: center;
      padding: 20px;
      box-sizing: border-box;
    }

    @media (max-width: 768px) {
      .main-container {
        width: 90%;
        min-width: 250px;
        max-width: 380px;
        top: 5%;
        height: 966px;
      }
    }

    @media (max-width: 480px) {
      .main-container {
        width: 95%;
        padding: 15px;
        height: 966px;
        top: 10%;
        min-width: 230px;
        max-width: 350px;
      }
    }

    .layout {
      width: 121px;
      height: 32px;
      top: 25px;
      left: 20px;
      position: absolute;
      font-family: "Montserrat", sans-serif;
      font-weight: 800;
      font-size: 23px;
      line-height: 32px;
      letter-spacing: 0px;
      color: #ffffff;
    }

    .fixed-layout {
      width: 110px;
      height: 32px;
      top: 25px;
      left: 77%;
      transform: translateX(-50%);
      position: absolute;
      border-radius: 16px;
      background-color: #00ba44;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: "Montserrat", sans-serif;
      font-weight: 800;
      font-size: 23px;
      line-height: 32px;
      color: #ffffff;
    }

    .icon {
      width: 19.5px;
      height: 15px;
      margin-right: 10px;
    }

    .inner-icon {
      width: 30px;
      height: 32px;
      position: absolute;
      top: 0;
      left: 83%;
      border-radius: 6px 10px 10px 0;
      background-color: #09a542;
    }

    .fixed-layout img {
      width: 19.5px;
      height: 15px;
      object-fit: contain;
    }

    .fixed-layout p {
      margin-left: 10px;
      font-size: 14px;
      margin: 0;
      color: white;
    }

    .carousel-inner {
      text-align: center;
    }

    .carousel1 {
      top: 109px;
      height: 158px;
    }

    .carousel-img {
      height: 158px;
    }

    /* ////////////4 icon div css///////// */
    .main-container-box {
      position: absolute;
      text-align: center;
      padding-left: 10px;
      padding-right: 10px;
      display: flex;
      gap: 12px;
    }


    .box img {
      width: 87%;
      margin-left: 8px;
      height: 60px;
    }



    .hidden-button {
      padding: 0;
      border: none;
      background: none;
      position: relative;
      cursor: pointer;
    }

    .slider-container {
      display: flex;
      width: 100%;
      overflow-x: auto;
      justify-content: start;
      gap: 10px;
      padding: 20px;
      box-sizing: border-box;
    }

    .slider-item {
      width: 208px;
      height: 325px;
      background-color: #ff914d;
      border-radius: 23px;
      position: relative;
      display: inline-block;
      flex-shrink: 0;
    }

    .slider-item img {
      width: 100%;
      height: 78%;
      border-bottom-left-radius: 20px;
      border-bottom-right-radius: 20px;
      object-fit: cover;
    }

    /* menu bar  */
    .dropbtn {
      padding: 0;
      border: none;
      background: none;
      position: relative;
      cursor: pointer;
      color: white;
      font-weight: bold;
    }

    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown img {
      margin-left: 20px;
      height: 20px;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      border-radius: 10px;
      right: 0;
      background-color: #290b4b;
      min-width: 160px;
      box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
      z-index: 1;
    }

    .dropdown-content a {
      color: white;

      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {
      background-color: black;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

    .dropdown:hover .dropbtn {
      padding: 0;
      border: none;
      background: none;
      position: relative;
      cursor: pointer;
    }

    /* ///////// */

    .new-box {
      width: 100%;
      max-width: 430px;
      height: 60px;
      background: rgba(67, 19, 120, 1);
      position: absolute;
      top: 839px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      align-items: center;
      justify-content: space-around;
      padding: 10px 15px;
      border-radius: 0 0 29px 29px;
      margin-top: 67px;
    }

    .icon-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 3px;
    }

    .icon {
      width: 30px;
      height: auto;
      margin-left: 10px;
    }

    .icon-container1 p {
      font-family: "Avenir LT Std", sans-serif;
      font-weight: 750;
      font-size: 9px;
      line-height: 12px;
      text-align: center;
      color: white;
      margin: 0;
    }

    /* ✅ Responsive Design */
    @media (max-width: 600px) {
      .new-box {
        width: 100%;
        padding: 8px;
      }

      .icon {
        width: 25px;
      }

      .icon-container p {
        font-size: 8px;
      }
    }

    @media (min-width: 601px) and (max-width: 1024px) {
      .new-box {
        width: 100%;
      }

      .icon {
        width: 25px;
      }
    }

    @media (min-width: 1025px) {
      .new-box {}

      .icon {
        width: 25px;
      }
    }

    .title {
      display: flex;
      align-items: center;
    }

    .icon-container {
      margin-right: 14%;
    }

    .text-container {
      font-size: 24px;
    }


    /* ///////////////self-mon */
    /* Container to hold both images */
    .container {
      display: flex;
      justify-content: space-between;
      flex-wrap: wrap;
      max-width: 430px;
      min-width: 316px;
      /* margin: 0 auto; */
      margin-top: 36%;
    }

    /* Individual image sections */
    .image-section,
    .tutorial-section {
      flex: 1;
      padding: 10px;
      box-sizing: border-box;
    }

    .image-section img,
    .tutorial-section img {
      width: 100%;
      height: auto;
    }

    /* Responsive behavior */
    @media (max-width: 430px) and (min-width: 316px) {
      .container {
        display: flex;
        justify-content: space-between;
      }

      .image-section,
      .tutorial-section {
        width: 48%;
        /* Adjust the width to fit side by side */
        margin: 1%;
      }
    }

    @media (max-width: 315px) {
      .container {
        display: block;
      }

      .image-section,
      .tutorial-section {
        width: 100%;
        /* Stack vertically on very small screens */
        margin-bottom: 10px;
      }
    }
  </style>
</head>

<body>
  <div class="main-container">
    <div class="layout">
      Mymoney
    </div>

    <div class="fixed-layout">
      <img src="{{asset('assets/images/img/home v icon.png')}}" alt="" class="icon" />
      <p>$500</p>
      <div class="inner-icon">
        <img src="{{asset('assets/images/img/plus icon.png')}}" alt="icon" />
      </div>
    </div>
    <div id="carouselExampleIndicators" class="carousel slide carousel1" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
          aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
          aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner text-center">
        <div class="carousel-item active text-center">
          <img src="{{asset('assets/images/img/Rectangle 1.png')}}" class="d-block w-100 carousel-img" alt="..." />
        </div>
        <div class="carousel-item text-center">
          <img src="{{asset('assets/images/img/Rectangle 1.png')}}" class="d-block w-100 carousel-img" alt="..." />
        </div>
        <div class="carousel-item text-center">
          <img src="{{asset('assets/images/img/Rectangle 1.png')}}" class="d-block w-100 carousel-img" alt="..." />
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <div class="container">
      <div class="image-section">
        <button class="hidden-button"><img src="{{asset('assets/images/img/mon to sat.png')}}" alt="Mon to Sat Image"/></button>
        
      </div>
      <div class="tutorial-section">
        <button class="hidden-button"> <img src="{{asset('assets/images/img/Untitled design.png')}}" alt="Tutorial Image" style="border-radius: 6px;"/></button> 
      </div>
    </div>
    <br/>
    <div class="main-container-box">
      <div class="box box-1"> <button class="hidden-button"> <img src="{{asset('assets/images/img/first-box.png')}}" alt="box1" /></div></button>
      <div class="box box-2"> <button class="hidden-button"><img src="{{asset('assets/images/img/second-box.png')}}" alt="box2" /></button> </div>
      <div class="box box-3"> <button class="hidden-button"> <img src="{{asset('assets/images/img/thard-box.png')}}" alt="box3" /></button></div>
      <div class="box box-4"> <button class="hidden-button"><img src="{{asset('assets/images/img/forth-div.png')}}" alt="box4" /></button> </div>
    </div><br /><br /><br /><br/>
    <!-- /////menu bar//////////// -->
    <div class="dropdown" style="float:left;">
      <button class="dropbtn"><img src="img/menu icon.png" alt="" > CHOOSE YOUR PLAN </button>
      <div class="dropdown-content" style="left:0;">
        <a href="#">Demo 1</a>
        <a href="#">Demo 2</a>
        <a href="#">Demo 3</a>
        <a href="#">Demo 4</a>
      </div>
    </div><br/><br/>
    <div class="slider-container">
      <div class="slider-item">
        <h3>Professional</h3>
        <h3>60</h3>
        <img src="{{asset('assets/images/img/slider-img1.png')}}" alt="Image 1" />
      </div>
      <div class="slider-item">
        <h3>Business</h3>
        <h3>40</h3>
        <!-- Add any content inside this div, such as an image or text -->
        <img src="{{asset('assets/images/img/slider-img2.png')}}" alt="Image 2" />
      </div>
      <div class="slider-item">
        <h3>Professional</h3>
        <h3>60</h3>
        <img src="{{asset('assets/images/img/slider-img1.png')}}" alt="Image 3" />
      </div>
    </div>
    <div class="new-box">
      <div class="icon-container1">
        <img src="{{asset('assets/images/img/home icon.png')}}" alt="Icon 1" class="icon" />
        <p>Home</p>
      </div>
      <div class="icon-container1">
        <img src="{{asset('assets/images/img/gift icon.png')}}" alt="Icon 2" class="icon" />
        <p>Bonus</p>
      </div>
      <div class="icon-container1">
        <img src="{{asset('assets/images/img/money icon.png')}}" alt="Icon 3" class="icon" />
        <p>Erun 5 Laks</p>
      </div>
      <div class="icon-container1">
        <img src="{{asset('assets/images/img/profile icon.png')}}" alt="Icon 4" class="icon" />
         <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"
                            class="dropdown-item">
                            <i class="ti ti-power"></i>
                            <p>{{ __('Logout') }}</p>
                        </a>
                        <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
        <!-- <p>Account</p> -->
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>