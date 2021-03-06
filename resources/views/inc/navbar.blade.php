<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link 
  href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" 
  rel="stylesheet"  type='text/css'>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="{{ route('pages.index') }}">村</a>
    </div>
      <ul class="navbar-nav">

      </ul>
      <ul class="nav navbar-nav navbar-right">
        
          <li class="nav-item active">
            <a class="nav-link" href="{{ route('product.shoppingCart') }}"><span class="fa fa-shopping-cart"></span> 購物車 <span class="badge">{{ Session::has('cart') ? Session::get('cart')->totalQty : '' }}</span></a>
          </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="fa fa-user"></span>會員中心
            </a>
          @if (Auth::check())
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="{{ route('users.profile') }}">訂單查詢</a>
                <a class="dropdown-item" href="{{ route('users.logout') }}">登出</a>
            </div>
                @else
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="{{ route('users.signup') }}">註冊</a>
                  <a class="dropdown-item" href="{{ route('users.signin') }}">登入</a>
            </div>
          @endif
        </li>
      </ul>
  </div>
</nav>
