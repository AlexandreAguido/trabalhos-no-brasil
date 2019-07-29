@component('components/header', [
    'assets_css' => $assets_css,
    'vaga_titulo' => $vaga->titulo
])
@endcomponent()


<body>
    <header>
        <div class="container top-menu">
            <div class="logo">
                <a href="/vagas"><i class="fas fa-home"></i>  Trabalhos no Brasil</a>
            </div>
            <form action="/search" method="get">
                <input type="text" name="search_term" class="search_input" required>
                <button class="btn-green" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </header>
    <main>
        <div class="add-left">

        </div>
        <div class="vaga">
            <h1 class="vaga-title">{{ $vaga->titulo }}</h1>

            <p>Empresa:
                @if ( !empty( $vaga->empresa ) )
                    {{ $vaga->empresa }}
                @else
                    {{ $vaga->empresa }}
                    Confidencial
                @endif
            </p>
            @if ($vaga->salario > 0)
                 <p class="salario"> 
                    Salario: R$ {{ $vaga->salario }}  
                 </p>
            @else
                <p>Salário a combinar</p>
            @endif
            <p>Local: {{ $vaga->cidade}}, {{ $vaga->estado }}</p>
            <br>
            <br>
            <div class="vaga-desc"> {!! str_replace("\n", "<br>", $vaga->descricao) !!}  </div>
            <div class="vaga-link-container">
                <a href="{{ $vaga->vaga_url }}" class="vaga-link" rel="nofollow" target="_blank">Enviar Currículo</a>
                <!--
                @component('components/social_links', ['vaga_titulo' => $vaga->titulo] )
                @endcomponent()
                -->
            </div>

            

        </div>
    </main>


    @component('components/footer')
    @endcomponent()

</body>

</html>