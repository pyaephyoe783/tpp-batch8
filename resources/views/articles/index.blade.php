<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Article</title>
</head>

<body>
    {{-- @php
        $articles = [
            [
                'id' => 1,
                'name' => 'First Article',
            ],
            [
                'id' => 2,
                'name' => 'Second Article',
            ],
            [
                'id' => 3,
                'name' => 'Third Article',
            ],
            [
                'id' => 4,
                'name' => 'Final Article',
            ],
        ];
    @endphp --}}
    {{-- {{ dd($articles); }} --}}
    <div>
        <h1>Article List</h1>
        @foreach ($articles as $data)
            <p>{{ $data['id'] }} : {{ $data['name'] }}</p>
        @endforeach

    </div>
</body>

</html>
