
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" id="_token">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{asset('img/favicon.ico')}}" type="image/x-icon">
    <meta property="og:url" content="{{url()->current()}}">
    <meta property="og:site_name" content="Trabalhos no Brasil">
    <meta property="og:title" content="Trabalhos no Brasil" />
    <meta property="og:type" content="website" />
    @if (isset( $vaga_titulo ))
        <meta property="og:description" content="Vaga para: {{$vaga_titulo}}" />
    @else
        <meta property="og:description" content="Encontre seu novo emprego aqui" />
    @endif

        @foreach($assets_css as $css)
            <link rel="stylesheet" href="{{ $css }}">
        @endforeach
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous">
    <title> {{isset($vaga_titulo) ? $vaga_titulo . " - " : ""}}Trabalhos no Brasil</title>
</head>