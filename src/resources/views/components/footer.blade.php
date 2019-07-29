
<footer>
    <p>&copy; <?php echo date('Y'); ?> Trabalhos no Brasil</p>
    <p>Site feito por 
        <a href="https://github.com/AlexandreAguido/" target="_blank">Alexandre Aguido</a>
         e hospedado em 
        <a href="https://m.do.co/c/e85d032defc7">DigitalOcean</a>
    </p>
</footer>
@if( isset($scripts) )
    @foreach($scripts as $script)
        <script src="{{ $script }}"></script>
    @endforeach()
@endif
</body>
</html>