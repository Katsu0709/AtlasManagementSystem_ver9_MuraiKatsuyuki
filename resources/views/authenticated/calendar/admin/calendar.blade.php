<x-sidebar>
  <div class="vh-100 pt-4" style="background:#ECF1F6;">
    <div class="w-75 m-auto pt-5 pb-4 shadow" style="border-radius:5px; background:#FFF;">
      <div class="calendar_table">
        <p class="text-center" style="font-size:1.5rem;">{{ $calendar->getTitle() }}</p>
        <div class="">
          {!! $calendar->render() !!}
        </div>
      </div>
</x-sidebar>
