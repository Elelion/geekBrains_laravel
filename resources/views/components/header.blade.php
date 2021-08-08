<header class="masthead">
  <div class="container position-relative px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
      <div class="col-md-10 col-lg-8 col-xl-7">
        <div class="site-heading">

          {{--
          @show, как и @endsection, используется для обозначения конца секции.
          @show выводит содержимое секции на экран, сразу после объявления секции.
          @endsection не делает ничего, кроме обозначения конца объявления секции.
          @show и @endsection не могут существовать без предшествующей директивы @section.
          --}}
          <span class="subheading">@section('slug') Блог новостей @show</span>
        </div>
      </div>
    </div>
  </div>
</header>
