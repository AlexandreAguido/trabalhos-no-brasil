@component('components/header', ['assets_css' => $assets_css])
@endcomponent()

<body>
@component('components/mobile/modal')
@endcomponent()
    <header class="container">
        <img src="{{ asset('img/menu-hamburguer.svg') }}" alt="menu-hamburguer" id="modal-open">
        <div class="logo">Trabalhos no Brasil</div>

    </header>

    <main>
       
        <div class="container site-content">
            <h1>Todas as vagas do Brasil aqui</h1>
            <form action="/search" method="get" class="search">
                <p>Cargo:</p>
                <input type="text" name="vaga_home" placeholder="{{ $rand_vaga_nome }}">
                <p>Localidade:</p>
                <input type="text" name="local" placeholder="{{ $rand_estado }}">

                <button type="submit" class="search-btn">
                    Buscar Vaga
                </button>
            </form>
        </div>
    </main>


@component('components/footer', ['scripts' => $scripts])
@endcomponent()