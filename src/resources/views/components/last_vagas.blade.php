<div class="links-busca">
    <?php $i = 0; ?>
    @foreach($vagas as $v)
        <?php
            $link = snake_case($v->titulo);
            $link = '/vaga/' . $link . '/' . $v->id
        ?>
        @if( $i % 5 == 0)
            <ul>
        @endif
        
        <li>
            
            <a href="{{ $link }}">{{ $v->titulo }}</a>
        </li>
        @if(++$i % 5 == 0)
            </ul>
        @endif
    @endforeach
</div>
