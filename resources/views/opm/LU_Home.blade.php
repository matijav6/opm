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
          <a class="navbar-brand" href="index.html">Matija Vuk</a>
        </div>
        <div class="navbar-collapse collapse navbar-right">
          <ul class="nav navbar-nav">
            <li class="active"><a href="{{ route('home') }}">Početna</a></li>            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Zadaci <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="blog.html">Zadatak 1</a></li>
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
                <form method="POST" action="{{ route('izracunaj') }}" accept-charset="UTF-8"  enctype="multipart/form-data" onsubmit="return provjeriInput();">
                    <div class="col-md-2">                                        
                        <h4>Odaberite veličinu matrice:</h4>
                        <br/>
                        <label for="operacija">2x2</label>
                        <input type="radio" name="operacija" value="2"></br>
                        <label for="operacija">3x3</label>
                        <input type="radio" name="operacija" value="3"></br>
                        <label for="operacija">4x4</label>
                        <input type="radio" name="operacija" value="4"></br>                     
                        <a href="#prikaziMatricu" class="btn btn-theme" id="prikaziMatricu" onclick="provjeriRadio();;">Prikaži matricu</a>                  
                    </div>
                    <div class="col-md-4" id="PocetnaMatrica" style="visibility: hidden;" >                    
                        <h4>Početna matrica</h4>          
                        <div id="matrica" style="margin-top: 20px;">
                            
                        </div>        
                        <label for="operacija">Pivotiranje</label>
                        <input type="checkbox" name="pivotiranje" value="pivotiranje"></br>                          
                        <button type="submit" class="btn btn-theme title="Izračunaj" style="margin-top: 15px;" value="1" >Izračunaj</button>
                                                                        {{ csrf_field() }}                         
                    </div>
                </form>
                <div class="col-md-6">  
                    @if (isset($det))
                        <h4>Rezultat:</h4>  
                        <div class="row">
                            @if (isset($matrica))
                                <div class="col-sm" style="display: inline-table; margin-right: 30px;">
                                    @foreach($matrica as $item)                            
                                            @for($i = 0; $i < count($matrica); $i++)                                    
                                                <input type="text" disabled name="a00" size="3" maxlength="3" value="{{round($item[$i],2)}}" style="margin: 2px;">
                                            @endfor
                                            </br>
                                    @endforeach                                                                  
                                </div>
                            @endif 
                            @if (isset($p))
                                <div class="col-sm" style="display: inline-table; margin-right: 30px;">
                                    @foreach($p as $item)                            
                                            @for($i = 0; $i < count($p); $i++)                                    
                                                <input type="text" disabled name="a00" size="3" maxlength="3" value="{{round($item[$i],2)}}" style="margin: 2px;">
                                            @endfor
                                            </br>
                                    @endforeach                                                              
                                </div>
                            @endif 
                            <div class="col-sm" style="display: inline-table; margin-right: 30px;">
                                @foreach($l as $item)                            
                                        @for($i = 0; $i < count($l); $i++)                                    
                                            <input type="text" disabled name="a00" size="3" maxlength="3" value="{{round($item[$i],2)}}" style="margin: 2px;">
                                        @endfor
                                        </br>
                                @endforeach                                                              
                            </div>                                                                 
                            <div col-sm style="display: inline-table;">
                                @foreach($u as $item)                            
                                        @for($i = 0; $i < count($u); $i++)                                    
                                            <input type="text" disabled name="a00" size="3" maxlength="3" value="{{round($item[$i],2)}}" style="margin: 2px;">
                                        @endfor
                                        </br>
                                @endforeach                         
                            </div>  
                        </div>                          
                        <div class="row" style="display: grid; grid-template-columns: auto auto auto auto auto auto;">
                            @if (isset($matrica))
                                <div col-sm style="display: inline-table;">
                                    <h3>A</h3>
                                </div>
                            @endif
                            @if (isset($p))
                                <div col-sm style="display: inline-table;">
                                    <h3>P</h3>
                                </div>
                            @endif
                            <div col-sm style="display: inline-table;">
                                    <h3>=</h3>
                                </div>
                            @if (isset($l))
                                <div col-sm style="display: inline-table;">
                                    <h3>L</h3>
                                </div>
                            @endif
                            @if (isset($u))
                                <div col-sm style="display: inline-table;">
                                    <h3>U</h3>
                                </div>
                            @endif
                        </div>    
                        <div class="row">
                            <h4>Determinanta iznosi: {{$det}}</h4>
                        </div>            
                    @endif                 
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
                    <p>
                        <a href="https://www.facebook.com/vuk.matija.6"><i class="fab fa-facebook-square"></i></a>
                        <a href="https://www.instagram.com/matija.vuk"><i class="fab fa-instagram"></i></a>
                        <a href="https://github.com/matijav6"><i class="fab fa-github"></i></a>
                        <a href="mailto:matija.vuk.97@gmail.com"><i class="fas fa-envelope"></i></a>
                    </p>
                    <p style="float: right; margin-top: -50px;">&copy; Matija Vuk <img style="height: 12px; margin-left: 10px;" src="{{ URL::asset('favicon.ico') }}"></p>
                </div>                            
            </div><! --/row -->
        </div><! --/container -->
     </div><! --/footerwrap -->    
  </body>
</html>
