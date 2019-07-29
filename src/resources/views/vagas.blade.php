@component('components/header', ['assets_css' => $assets_css])
@endcomponent()

@php
$search_input_placeholder = !empty($rand_vaga_nome) ? 'Ex: ' . $rand_vaga_nome : ''
@endphp

<body>
    <header>
        <div class="container top-menu">
            <div class="logo">
                <a href="/vagas"><i class="fas fa-home"></i>  Trabalhos no Brasil</a>
            </div>
            <form action="/search" method="get">
                <input type="text" name="search_term" class="search_input"
                placeholder="{{$search_input_placeholder}}" required>
                <button class="btn-green" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </header>


    <h2 id="search-term">
    @if ( $show_warning )
    <p class="alert">Não encontramos nenhuma vaga com os critérios selecionados. Vamos exibir as vagas mais recentes</p>
    @endif
    </h2>
    <main>
       
        @component('components/menu_filtros', [
            'keyword' => $keyword,
            'estados' => $estados,
            'estado_id'  => $estado_id,
            'cidades' => empty($cidades) ? null : $cidades,
            'cidade_id' => $cidade_id,
            'periodo' => $periodo
            ])
        @endcomponent()
        
        @component('components/lista_vagas', ['vagas' => $vagas])
        @endcomponent()
           
        <div class="add">
            
        </div>

    </main>


@component('components/footer', ['scripts' => $scripts])
@endcomponent()