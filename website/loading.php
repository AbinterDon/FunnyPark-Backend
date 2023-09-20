<html>
  <head>
    <script>
    /***
      $(document).ready(function() {

        //loading setting
        $('.preloader-background').delay(1000).fadeOut('slow');
        $('.preloader-wrapper').delay(1000).fadeOut();

      });
      ***/
    </script>

    <style>

    .preloader-background {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #eee;

        position: fixed;
        z-index: 100;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
      }

    </style>

  </head>

  <body>

    <div class="preloader-background">
      <div class="preloader-wrapper active">
        <div class="spinner-layer spinner-blue-only">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div><div class="gap-patch">
            <div class="circle"></div>
          </div><div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
    </div>

  </body>
</html>
