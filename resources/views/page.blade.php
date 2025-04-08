<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $name ?? '' }}</title>
    <meta name="author" content="Xmartlabs" />
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('public/admin-assets/logo.png')}}" />

    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />



    
  </head>

  <body id="terms-and-conditions">

    <div class="container-fluid">
      <div class="row terms-and-conditions-section">
        <div class="col-xs-12 text-center">
          <h1 class="title">{{ $name ?? '' }}</h1>
        </div>

        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
          <div class="content">
                {!! $data->value ?? ''  !!}
          </div>
        </div>
      </div>
    </div>
    
  </body>
</html>