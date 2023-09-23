<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Isabela LGU - HRMS</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('logo/loginlogo.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.lordicon.com/ritcuqlt.js"></script>
    <!-- Scripts -->
    </head>
    <body >
        <header>
            <div class="navigation">
                <div class="navtitle">
                    <img src="{{asset('logo/loginlogo.png')}}" alt="">
                    <h5>Isabela City Jobs Portal</h5>
                </div>
                <button class="bars" id="openbars"><i class="fas fa-bars"></i></button>
                <div class="navlinks" id="navlinks">
                    <a href="/" class="@if($activePage == "opportunities") active @endif" >Opportunities</a>
                    <a href="#" class="@if($activePage == "newhires") active @endif" >New Hires</a>
                  
                    @if(Auth::check())
                    <a href="{{route('register')}}" class="@if($activePage == "register") active @endif" >MyAccount </a>
                   
                    <a href="#" id="logout" class="@if($activePage == "opportunities") login @endif" >Logout <i class="fas fa-right-from-bracket text-danger"></i></a>
                    @else 
                    <a href="{{route('register')}}" class="@if($activePage == "register") active @endif" >Register</a>
                    <a href="{{route('login')}}" class="@if($activePage == "login") active @endif" >Login</a>
                    @endif
                   
                </div>
                <form action="{{route('logout')}}" class="d-none" method="post" >
                    @csrf
                    <button id="btnlogout" type="submit"></button>
                        
                </form>
            </div>
            @if(!$register)
            <div class="header"></div>
            @endif
          </header>
        @yield('content')

        
        <h6 style="
        position: fixed;
        bottom:0px;
        right:10px;
        font-size:10px;
        text-transform:uppercase;
        color:#7C81AD
        ">
            All Rights Reserved &middot; 2023
        </h6>
    </body>
    <script src="{{asset('js/action.js')}}"></script>
    <script>
        $('#logout').click(function(){
            $('#btnlogout').click();  
        })
 
        $('#searchkey').keyup(function(){
        var val = $(this).val().toLowerCase();
            var count = 0;
        $(".jobcard").each(function(){
            
            var itemText = $(this).text().toLowerCase();
            if(itemText.includes(val.toLowerCase()) == true){
                $(this).show();
                count++; 
            } else {
                $(this).hide();
               
            }
            if(itemText.indexOf(val) !== -1){
                $(this).show();
            
            } else {
                $(this).hide();
                
            }
        })

        if(count == 0){
            $('#pos').removeClass('d-none');
            $('#nosearchkey').text(val);
        }else{
            $('#pos').addClass('d-none');
        }
        })

        $('#openbars').click(function(){
            $('#navlinks').css('right','0px');
        })

        /* Clicking outside the Element */
        $(document).on('click', function(event) {
        if (!$(event.target).closest('#navlinks').length) {
          //  
            if($('#navlinks').css('right') === '0px'){
                $('#navlinks').css('right','-200px');
            }
        }
        });
    </script>
</html>
