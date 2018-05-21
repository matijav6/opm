<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">    
    <link rel="shortcut icon" href="{{ URL::asset('favicon.ico') }}" />

    <title>LU faktorizacija</title>

    <!-- Bootstrap core CSS -->    
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}" />
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/script.js') }}"></script>
   
    
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="">Matija Vuk</a>
        </div>
        <div class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">
            <li class="active"><a href="{{ route('home') }}">Početna</a></li>            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Zadaci <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="{{route('zadaci')}}?zadatak=7a">Zadatak 7 a)</a></li>
                    <li><a href="{{route('zadaci')}}?zadatak=7a&pivotiranje=1">Zadatak 7 a) sa pivotiranjem</a></li>
                    <li><a href="{{route('zadaci')}}?zadatak=7b">Zadatak 7 b)</a></li>
                    <li><a href="{{route('zadaci')}}?zadatak=7b&pivotiranje=1">Zadatak 7 b) sa pivotiranjem</a></li>
                    <li><a href="{{route('zadaci')}}?zadatak=7c">Zadatak 7 c)</a></li>
                    <li><a href="{{route('zadaci')}}?zadatak=7c&pivotiranje=1">Zadatak 7 c) sa pivotiranjem</a></li>
                    <li><a href="{{route('zadaci')}}?zadatak=7d">Zadatak 7 d)</a></li>
                    <li><a href="{{route('zadaci')}}?zadatak=7d&pivotiranje=1">Zadatak 7 d) sa pivotiranjem</a></li>
                    <li><a href="{{route('zadaci')}}?zadatak=7e">Zadatak 7 e)</a></li>
                    <li><a href="{{route('zadaci')}}?zadatak=7e&pivotiranje=1">Zadatak 7 e) sa pivotiranjem</a></li>
                    <li><a href="{{route('zadaci')}}?zadatak=10a&pivotiranje=1">Zadatak 10 a) sa pivotiranjem</a></li>                    
                    <li><a href="{{route('zadaci')}}?zadatak=10b&pivotiranje=1">Zadatak 10 b) sa pivotiranjem</a></li>
                    <li><a href="{{route('zadaci')}}?zadatak=10b&pivotiranje=1">Zadatak 10 b) sa pivotiranjem</a></li>

                    <li><a href="{{route('zadaci')}}?zadatak=12a">Zadatak 12 a)</a></li>
                    <li><a href="{{route('zadaci')}}?zadatak=12b">Zadatak 12 b)</a></li>
                    <li><a href="{{route('zadaci')}}?zadatak=13a">Zadatak 13 a)</a></li>
                    <li><a href="{{route('zadaci')}}?zadatak=13b">Zadatak 13 b)</a></li>
                </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <!-- *****************************************************************************************************************
     HEADERWRAP
     ***************************************************************************************************************** -->
    <div id="headerwrap" style="min-height: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">                
                    <h1>LU faktorizacija</h1>
                    <h5>Paula Vajdić, Toni Toplek, Matija Vuk</h5>                            
                </div>                
            </div><!-- /row -->
        </div> <!-- /container -->
    </div><!-- /headerwrap -->

    <!-- *****************************************************************************************************************
     MAIN SECTION
     ***************************************************************************************************************** -->
     <div id="service">
        <div class="container">
            <div class="row centered">              
                <div class="col-md-12" id="rezultat">                      
                    <h4>Rezultat:</h4>  
                    <div class="row ispis" style="display: grid; grid-template-columns: auto auto auto auto auto auto;" >
                        @if (isset($matrica))
                            <div class="col-sm matricaIspis" style="display: inline-table; margin-right: 30px;">
                                @foreach($matrica as $item)                            
                                        @for($i = 0; $i < count($matrica); $i++)                                    
                                            <input type="text" disabled name="a00" size="3" maxlength="3" value="{{round($item[$i],2)}}" style="margin: 2px;">
                                        @endfor
                                        </br>                                            
                                @endforeach  
                                </br>
                                <h3>A</h3>                                                                
                            </div>
                        @endif 
                        @if (isset($rjesenja))
                            <div class="col-sm matricaIspis" style="display: inline-table; margin-right: 30px;">
                                @for($i = 0; $i < count($rjesenja); $i++)                                    
                                    <input type="text" disabled name="a00" size="3" maxlength="3" value="{{round($rjesenja[$i],2)}}" style="margin: 2px;">
                                </br>
                                @endfor                                                                                                        
                                </br>
                                <h3>X</h3>                                                             
                            </div>
                        @endif    
                        @if (isset($matricaRjesenja))
                            <div class="col-sm matricaIspis" style="display: inline-table; margin-right: 30px;">
                                @for($i = 0; $i < count($matricaRjesenja); $i++)                                    
                                    <input type="text" disabled name="a00" size="3" maxlength="3" value="{{round($matricaRjesenja[$i],2)}}" style="margin: 2px;">
                                </br>
                                @endfor
                                </br>      
                                <h3>B</h3>                                                             
                            </div>
                        @endif                 
                    </div>                                    
                </div>                      
            </div>
        </div>
     </div>    
    <!-- *****************************************************************************************************************
     FOOTER
     ***************************************************************************************************************** -->
     <div id="footerwrap">
        <div class="container">
            <div class="row justify-content-md-center">                
                <div class="col-md-auto">
                    <h4>Social Links</h4>
                    <div class="hline-w col-md-auto"></div>
                    <p class="socialLinks">
                        <a href="https://www.facebook.com/vuk.matija.6" target="_blank"><i class="fab fa-facebook-square"></i></a>
                        <a href="https://www.instagram.com/matija.vuk" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://github.com/matijav6" target="_blank"><i class="fab fa-github"></i></a>
                        <a href="mailto:matija.vuk.97@gmail.com" target="_blank"><i class="fas fa-envelope"></i></a>
                    </p>
                    <p class="copyRight">&copy; Matija Vuk <img style="height: 12px; margin-left: 10px;" src="{{ URL::asset('favicon.ico') }}"></p>
                </div>                            
            </div><! --/row -->
        </div><! --/container -->
     </div><! --/footerwrap -->    
  </body>
</html>
