<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Data Recapture, recapture, IEI Anchor, IEI, IEI Anchor Pensions, PENCOM"">
    <meta name="author" content="">
    <!--<link rel="icon" href="../../../../favicon.ico">-->

    <title>IEI Anchor Pensions | Data-Recapture</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('/css/summary/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('/css/navbar-top.css')}}" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <a class="navbar-brand" href="#">Data<b>Recapture</b></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          
        </ul>
        <form class="form-inline mt-2 mt-md-0">
		  <a class="btn btn-success" href="{{route('logout')}}"><i class="fa fa-user-o"></i> Logout</a>
        </form>
      </div>
    </nav>

    <main role="main" class="container">
      <div class="jumbotron">
        <h1>Exercise Completed</h1>
        <p class="lead">thanks for updating your records with us. an email has been sent to you on your appointment schedule</p>
        <a class="btn btn-lg btn-success" href="{{route('logout')}}" role="button">End</a>
      </div>
    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="{{asset('/js/summary/jquery-3.2.1.slim.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/jquery-slim.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/popper.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
  </body>
</html>
