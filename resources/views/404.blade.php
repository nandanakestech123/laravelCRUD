<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Page Not Found</title>

    <link href="{{asset('')}}css\bootstrap.min.css" rel="stylesheet" type="text/css">

</head>
<body>
<!--==========================-->
    <!--=         Error         =-->
    <!--==========================-->
    <section class="error-page">
      <div class="container">
        <center>
        <div class="error-content-wrapper text-center">
          <div class="error-content">
            <img src="{{asset('')}}images/404.jpg" alt="error">

            <h2 class="error-title">Page Not Found</h2>

            <p>We are unable to find the page you are looking for.</p>

            <a href="{{url('')}}" class="btn btn-primary">Go Home</a>
          </div>
          <!-- /.error-content -->
        </div>
        </center>
        <!-- /.error-content-wrapper -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /.error-page -->
</body>

    <script src="{{asset('')}}js\jquery.min.js"></script>

    <script src="{{asset('')}}js\bootstrap.min.js"></script>

</html>
