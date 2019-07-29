@component('components/header', ['assets_css' => $assets_css])
@endcomponent()

<body>
    @component('components/mobile/modal')
    @endcomponent()
    <header class="container">
        <img src="{{ asset('img/menu-hamburguer.svg') }}" alt="menu-hamburguer" id="modal-open">
        <a href="/"<div class="logo">Trabalhos no Brasil</div></a>
    </header>
    <main class="container">
            <div class=" site-content">
                <form action="/search" method="get" class="search">
                    <input type="text" name="search_term" placeholder="Ex: {{ $rand_vaga_nome}}" required="required" />
                    <button type="submit" class="search-btn btn-green">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>

                <h2 id="search-term">
                    @if ($show_warning)
                        <p class="alert">Não encontramos nenhuma vaga com os critérios selecionados. Vamos exibir as vagas mais recentes</p>
                    @endif
                </h2>    
        
        @component('components/mobile/lista_vagas', ['vagas' => $vagas])
        @endcomponent()
           
        <div class="add">
            
        </div>

    </main>



@component('components/footer', ['scripts' => $scripts])
@endcomponent()