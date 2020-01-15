<section class="vagas_container">
    @foreach($vagas as $vaga)
        <article class="vaga_card">
            <h2><a class="titulo" href="/vaga/{{urlencode($vaga->titulo) . '/' . $vaga->id}}">{{ $vaga->titulo }}</a></h2>
            @if ($vaga->empresa)
                <p>Empresa: {{ $vaga->empresa }}
            @else
                <p>Empresa:confidencial</p>
            @endif

            @if( $vaga->salario != 0 )
                <p>Salário: R$ {{ $vaga->salario }}</p>
            @else
                <p> Salário: não informado </p>
            @endif
            <p>{{ $vaga->cidade }}, {{ $vaga->uf }}</p>
            <p><i class="far fa-clock">  </i> {{ pretty_creation_date($vaga->criado_em) }}</p>
            <p></p>
        </article>
    @endforeach()

    {{ $vagas->links('components/vagas_pagination', ['paginator' => $vagas]) }}
</section>