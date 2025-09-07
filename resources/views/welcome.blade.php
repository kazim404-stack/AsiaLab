<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @php
        $test = App\Models\Test::with(relations: 'category')->where(column: 'id', operator: 30)->first();
    @endphp
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                    <div>{!! $test->getTranslation('description', 'en') !!}</div>
            </div>
        </div>
    </div>
</body>

</html>
