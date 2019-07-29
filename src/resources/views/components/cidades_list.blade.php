<option value="0">todas</option>
@foreach ($cidades as $cidade)
    <option value="{{ $cidade->id }}" <?php if($id == $cidade->id){echo 'selected';}?>>{{ $cidade->nome }}</option>
@endforeach
