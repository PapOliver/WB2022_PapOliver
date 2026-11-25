@extends('layouts.app')
@section('title', '| Names Page')

@section('content')
    <div class="container">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Azonosító</th>
                    <th>Családnév</th>
                    <th>Létrehozás</th>
                    <th>Műveletek</th>
                </tr>
            </thead>
            <tbody>
                @foreach($names as $name)
                    <tr>
                        <td>{{ $name->id }}</td>
                        <td>{{ $name->surname }}</td>
                        <td>{{ $name->created_at }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-danger btn-delete-name" data-id="{{ $name->id }}">Törlés</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3 class="mt-3">Családnevek hozzáadása</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/names/manage/surname" method="post">
            @csrf
            <div class="form-group">
                <label for="inputFamily">Családnév</label>
                <input type="text" class="form-control" id="inputFamily" name="inputFamily" required value="{{ old('inputFamily') }}" minlength="2" maxlength="20">
            </div>
            <button type="submit" class="btn btn-primary">Hozzáadás</button>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
       $(".btn-delete-name").on("click", function() {
            let thisBtn = $(this);
            let Id = thisBtn.data("id");
            $.ajax({
                    type: "POST",
                    url: "/names/manage/surname/delete" ,
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: Id
                    },
                    success: function(data) {
                        if (data.success === true) {
                            thisBtn.closest('tr').fadeOut();
                        }
                        else {
                            alert("Hiba történt a törlés során:\nRészletek: " + data.message);
                        }
                    },
                    error: function() {
                        alert("Nem sikerült a törlés!");
                    }
                }
            )
            }
        );
    </script>
@endsection