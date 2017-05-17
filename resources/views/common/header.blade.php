<div id="navbar" class="navbar navbar-default">
 <div id="navbar-container" class="navbar-container">

    <!-- toggle buttons are here or inside brand container -->
    <div class="navbar-header pull-left">
    <a href="#" class="navbar-brand">
    <small>
        <img src="{{ asset('images/lieplus.png') }}">
      猎加应用系统
    </small>
   </a>
 </div>

    <div class="navbar-header pull-left">
      <!-- brand text here -->
    </div><!-- /.navbar-header -->


    <div class="navbar-buttons navbar-header pull-right ">
      <ul class="nav ace-nav">
        <!-- user buttons such as messages, notifications and user menu -->
      </ul>
    </div><!-- /.navbar-buttons -->


    <nav class="navbar-menu pull-left">
      <!-- optional menu & form inside navbar -->
    </nav><!-- /.navbar-menu -->

    @include('common.nav_right')

 </div><!-- /.navbar-container -->
</div><!-- /.navbar -->