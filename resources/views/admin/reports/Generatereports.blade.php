<h3 style="text-align: center">{{$title}}</h3>
<table class="table table-bordered">
  <thead>
    <tr>
      @foreach($header as $thead)
        <th>{{ $thead }}</th>
      @endforeach
    </tr>
  </thead>
  <tbody>
    @foreach ($body as $item)
      <tr>
        @foreach ($header as $headerItem)
          <td>{{ $item[$headerItem] }}</td>
        @endforeach
      </tr>
    @endforeach
  </tbody>
</table>
