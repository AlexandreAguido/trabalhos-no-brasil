@component('components/header', [
    'assets_css' => $assets_css,
    'vaga_titulo' => $vaga->titulo
])
@endcomponent()


<body>
    @component('components/mobile/modal')
    @endcomponent()
    <header class="container">
        <img src="{{ asset('img/menu-hamburguer.svg') }}" alt="menu-hamburguer" id="modal-open">
        <a href="/"<div class="logo">Trabalhos no Brasil</div></a>
    </header>
    <main>
    <section class="vaga_container container">
                <article class="vaga">
                    <h1 class="titulo">{{ $vaga->titulo }}</h1>
                    <p class="empresa">Empresa:
                        @if ( !empty( $vaga->empresa ) )
                            {{ $vaga->empresa }}
                        @else
                             Confidencial
                        @endif

                    </p>
                    <br>
                    @if ($vaga->salario > 0)
                        <p class="salario"> 
                         Salario: R$ {{ $vaga->salario }}  
                        </p>
                    @else
                        <p>Salário a combinar</p>
                    @endif
                    <br>
                    <p>Local: {{ $vaga->cidade}}, {{ $vaga->estado }}</p>
                    
                    <br>
                    <p> {!! str_replace("\n", "<br>", $vaga->descricao) !!}  </p>
                    <!--
                        <div class="link-container">
                        <a href="{{ $vaga->vaga_url }}" class="vaga-link" rel="nofollow" target="_blank">Enviar Currículo</a>
                        @component('components/social_links', ['vaga_titulo' => $vaga->titulo] )
                        @endcomponent()
                    </div>
                    -->
                </article>
                
             </section>
    </main>

    @component('components/footer', ['scripts' => $scripts])
@endcomponent()
</body>

</html>