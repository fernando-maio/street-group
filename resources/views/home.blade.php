<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Street Group - CSV Reader</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-10 align-self-center">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br />
                        @endforeach
                    </div>
                @endif
                
                <div class="form-group">
                    <form role="form" method="POST" action="{{ route('csv.import') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                            <label for="csv_file">{{ __('Select a CSV file:') }}</label>
                            <input type="file" class="form-control-file" name="csv_file" id="csv_file">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>                    
            </div>
        </div>
        <div class="row">

            @isset($data)
                @if($data['status'] == 'success')
                    @foreach ($data['data'] as $person)
                        <div class="col-md-12 mt-2">
                            <ul class="list-group">
                                <li class="list-group-item">$person['title'] => {{ $person['title'] }}</li>
                                <li class="list-group-item">$person['first_name'] => {{ $person['first_name'] }}</li>
                                <li class="list-group-item">$person['initial'] => {{ $person['initial'] }}</li>
                                <li class="list-group-item">$person['last_name'] => {{ $person['last_name'] }}</li>
                            </ul>
                        </div>
                    @endforeach
                    <div class="col-md-12 mt-2">
                        {!! dd($data['data']) !!}
                    </div>
                @endif
            @endisset
        
        </div>
    </div>
</body>
</html>