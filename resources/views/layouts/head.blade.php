<!-- Title -->
<title> Elasley -  POS </title>
<!-- Favicon -->
<link rel="icon" href="{{URL::asset('assets/img/brand/favicon.svg')}}" type="image/x-icon"/>
<!-- Icons css -->
<link href="{{URL::asset('assets/css/icons.css')}}" rel="stylesheet">
<!--  Custom Scroll bar-->
<link href="{{URL::asset('assets/plugins/mscrollbar/jquery.mCustomScrollbar.css')}}" rel="stylesheet"/>
<!--  Sidebar css -->
<link href="{{URL::asset('assets/plugins/sidebar/sidebar.css')}}" rel="stylesheet">
<!-- Sidemenu css -->
<link rel="stylesheet" href="{{URL::asset('assets/css-rtl/sidemenu.css')}}">
@yield('css')
<!--- Style css -->
<link href="{{URL::asset('assets/css-rtl/style.css')}}" rel="stylesheet">
<!--- Dark-mode css -->
<link href="{{URL::asset('assets/css-rtl/style-dark.css')}}" rel="stylesheet">
<!---Skinmodes css-->
<link href="{{URL::asset('assets/css-rtl/skin-modes.css')}}" rel="stylesheet">
<style>

    .switch {
      position: absolute;
      top: 50%;
      left: 40%;
      width: 250px;
      height: 50px;
      text-align: center;
      margin: -30px 0 0 -75px;
      background: #4cd964;
      -webkit-transition: all 0.2s ease;
      -moz-transition: all 0.2s ease;
      -o-transition: all 0.2s ease;
      -ms-transition: all 0.2s ease;
      transition: all 0.2s ease;
      border-radius: 25px;
    }
    .switch span {
      position: absolute;
      width: 20px;
      height: 4px;
      top: 50%;
      left: 50%;
      margin: -2px 0px 0px -4px;
      background: #fff;
      display: block;
      -webkit-transform: rotate(45deg);
      -moz-transform: rotate(45deg);
      -o-transform: rotate(45deg);
      -ms-transform: rotate(45deg);
      transform: rotate(135deg);
      -webkit-transition: all 0.2s ease;
      -moz-transition: all 0.2s ease;
      -o-transition: all 0.2s ease;
      -ms-transition: all 0.2s ease;
      transition: all 0.2s ease;
      border-radius: 2px;
    }
    .switch span:after {
      content: "";
      display: block;
      position: absolute;
      width: 4px;
      height: 12px;
      margin-top: 0px;
      background: #fff;
      -webkit-transition: all 0.2s ease;
      -moz-transition: all 0.2s ease;
      -o-transition: all 0.2s ease;
      -ms-transition: all 0.2s ease;
      transition: all 0.2s ease;
      border-radius: 2px;
    }
    input[type=radio] {
      display: none;
    }
    .switch label {
      cursor: pointer;
      color: rgba(0,0,0,0.2);
      width: 60px;
      font-size: 20px;
      font-weight: bold;
      margin: 0px 10px;
      line-height: 50px;
      -webkit-transition: all 0.2s ease;
      -moz-transition: all 0.2s ease;
      -o-transition: all 0.2s ease;
      -ms-transition: all 0.2s ease;
      transition: all 0.2s ease;
    }
    label[for=yes] {
      position: absolute;
      left: 0px;
      height: 20px;
    }
    label[for=no] {
      position: absolute;
      right: 0px;
    }
    #no:checked ~ .switch {
      background: #ff3b30;
    }
    
    
    #no:checked ~ .switch span {
      background: #fff;
      margin-right: -8px;
    }
    #no:checked ~ .switch span:after {
      background: #fff;
      height: 20px;
      margin-top: -8px;
      margin-right: 8px;
    }
    #yes:checked ~ .switch label[for=yes] {
      color: #fff;
    }
    #no:checked ~ .switch label[for=no] {
      color: #fff;
    }
    

    











/* The switch-permission - the box around the slider */
.switch-permission {
  position: relative;
  display: inline-block;
  width: 45px;
  height: 28px;
}

/* Hide default HTML checkbox */
.switch-permission input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 20px;
  width: 20px;
  left: 1px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: rgb(61, 220, 247);
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(10px);
  -ms-transform: translateX(10px);
  transform: translateX(22px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

/*switch-permission css end here*/
    
    </style>