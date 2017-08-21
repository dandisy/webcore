<div class="col-sm-12">
    @if(count($widgetContent) > 0)
        <table class="table course-list-table">
            <thead class="main-color-1-bg dark-div">
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Asal</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($widgetContent as $item)
                    <tr>
                        <td><a href="#">{{$item->id}}</a></td>
                        <td><a href="#">{{$item->judul}}</a></td>
                        <td>{{$item->asal}}</td>
                        <td>{{$item->updated_at}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-center">{{ $widgetContent->links() }}</div>
    @else
        <div class="no-content">
            <div class="panel">
                <div class="panel-body">
                    <h2>Tidak ada sumber data!</h2>
                    <p>Buat dan tulis data pada sumber data untuk halaman ini.</p>
                </div>
            </div>
        </div>
    @endif
</div>