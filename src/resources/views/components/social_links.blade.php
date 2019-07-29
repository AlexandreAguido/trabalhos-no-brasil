@php
    $full_url = $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
    $linkedin_link = "https://www.linkedin.com/shareArticle?url=" . $full_url;
    $whatsapp_text = "Vaga de emprego: " . $vaga_titulo;
@endphp


 <div class="share-vaga">
    <p>Indicar para um amigo:</p>
    <div class="social_icons_wrapper">
        <a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" target="_blank" >
            <i class="fab fa-facebook-square" aria-hidden="true"></i>
        </a>
        <a href="whatsapp://send?text={{ $whatsapp_text }} target="_blank"">
            <i class="fab fa-whatsapp" aria-hidden="true"></i>
        </a>
        <a href="{{ $linkedin_link }}" target="_blank" rel="nofollow">
            <i class="fab fa-linkedin" aria-hidden="true" ></i>
        </a>
    </div>
</div>