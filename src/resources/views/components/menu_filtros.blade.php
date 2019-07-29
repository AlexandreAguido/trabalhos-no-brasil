<aside class="filtros">
    <br>
    <form action="/search" method="get">
        <p>Estado</p>
        <select name="e" id="estadoSelect" onchange="get_cities()">
            <option value="0">todos</option>
            @foreach ($estados as $estado)
                <option value="{{ $estado->id }}"<?php if($estado->id == $estado_id){echo 'selected';} ?>>
                    {{ $estado->nome }}
                </option>
            @endforeach
        </select>

        <p>Cidade</p>
        @if (!empty($cidades))
            <select name="c" id="cidadeSelect">
            @component('components/cidades_list', ['cidades' => $cidades, 'id' => $cidade_id])
            @endcomponent()
            </select>
        @else
            <select name="c" id="cidadeSelect" disabled>
                <option value="0">       </option>
            </select>
        @endif
        <p>Data de Publicação</p><br>

        <div class="date-option">
            <input type="radio" id="dia" name="d" value="dia" class="checkbox_date"{{$periodo == 'dia' ? 'checked' : " " }}>
            <label for="dia" class="checkbox_label">Hoje</label>
        
        </div>

        <div class="date-option">
            <input type="radio" id="tres_dias" name="d" value="tres_dias" class="checkbox_date" {{$periodo == 'tres_dias' ? 'checked' : " " }}>
            <label for="tres_dias" class="checkbox_label">3 dias</label>
        </div>

        <div class="date-option">
            <input type="radio" id="semana" name="d" class="checkbox_date" value="w" {{$periodo == 'w' ? 'checked' : " " }}>
            <label for="semana" class="checkbox_label">Esta semana</label>
        </div>

        <div class="date-option">
            <input type="radio" id="mes" name="d" class="checkbox_date" value="m" {{$periodo == 'm' ? 'checked' : " " }}>
            <label for="mes" class="checkbox_label">Este mês</label>
        </div>

        <div class="date-option">
            <input type="radio" name="d" id="todas" value="all" {{$periodo == 'all' | !$periodo ? 'checked' : " " }}>
            <label for="todas" class="checkbox_label">Qualquer data</label>
        </div>
        
        <br><br>
        <input type="hidden" value="{{ $keyword }}" name="vaga_hidden">
        <button type="submit" class="btn_filter">Filtrar Vagas</button>
    </form>
 </aside>