<div class="app-content-header">
    <h1 class="app-content-headerText">{{ $mainTitle }}</h1>
    <section>

    @foreach ($buttons as $button)
        <a class="home-btn" href="{{ $button['href'] }}">
            <button class="app-content-headerButton">{{ $button['title'] }}</button>
        </a>
    @endforeach

    </section>
</div>
<div class="app-content-actions">
    @if(isset($pageLeader))
        <p class="app-content-headerText">{{ $pageLeader }}</p>
    @endif
    @if(Session::has('failed'))
        <section style="color: white; font-size: 15px;">
            <p>{{ Session::get('failed') }}</p>
            <hr />
        </section>
    @endif
    <div class="app-content-actions-wrapper"></div>
</div>