@component('components/header', ['assets_css' => $assets_css])
@endcomponent()

<body>
    <main>
        <section class="search"> 
            <div class="layer"></div>
            <div class="container first-section">
                <h1>Trabalhosnobrasil.com.br todas as vagas aqui</h1>
                <form action="/search" class="search-form" method="get">
                    <div class="input-1">
                        <label for="vaga">Cargo:</label>
                        <input type="text" name="vaga_home" placeholder=" {{ $rand_vaga_nome }}">
                    </div>

                    <div class="input-2">
                        <label for="local">Onde:</label>
                        <input type="text" name="local" placeholder=" {{ $rand_estado }}">
                    </div>
                    
                    <button type="submit" class="btn-green">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                
            </div>
            
            
                
            </form>
        </section>
        <section class="call container">
            <h2>Seu próximo emprego está aqui
            </h2>
            <p>
                O nosso buscador visita minuto a minuto os principais sites
                de emprego e armazena todas as vagas, permitindo
                que você visite um único site para achar a vaga ideal.
            </p>
        </section>

        <section class="vagas">
            <div class="container">
                <h2>Últimas vagas</h2>
                
                @component('components/last_vagas', ['vagas' => $ultimas_vagas])
                @endcomponent


                <a href="/vagas" id="search2-btn" class="btn-green">Todas as vagas</a> 
            </div>
        </section>
    </main>

@component('components/footer')
@endcomponent()