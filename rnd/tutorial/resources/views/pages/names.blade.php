@extends('layouts.app')
@section('title', '| Names Page')

@section('content')
    <div class="container">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    @auth
                    <th>Azonosító</th>
                    <th>Családnév</th>
                    <th>Név</th>
                    <th>Létrehozás</th>
                    <th>Műveletek</th>
                    @endauth
                </tr>
            </thead>
            @auth
            <tbody>
                @foreach($names as $name)
                    <tr>
                        <td>{{ $name->id }}</td>
                        @empty($name->family)
                            <td><strong>Nincs családnév</strong></td>
                        @else
                            <td>{{ $name->family->surname }}</td>
                        @endempty

                        <td>{{ $name->name }}</td>
                        <td>{{ $name->created_at }}</td>
                        <td>
                            <a href="#" class="btn btn-sm btn-danger btn-delete-name" data-id="{{ $name->id }}">Törlés</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            @endauth
        </table>
        
        <h3 class="mt-3">Új név hozzáadása</h3>
        <form action="/names/manage/name/new" method="post">
            @csrf
            <div class="form-group">
                <label for="inputFamily">Családnév</label>
                <select name="inputFamily" id="inputFamily" class="form-control">
                    @foreach($families as $family)
                        <option value="{{ $family->id }}">{{ $family->surname }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="inputName">Keresztnév</label>
                <input type="text" class="form-control" id="inputName" name="inputName">
            </div>
            <button type="submit" class="btn btn-primary">Hozzáadás</button>
        </form>
    </div>
@endsection

@section('scripts')
    @auth
    <script>
       $(".btn-delete-name").on("click", function() {
            let thisBtn = $(this);
            let Id = thisBtn.data("id");
            $.ajax({
                    type: "POST",
                    url: "/names/delete" ,
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: Id
                    },
                    success: function(data) {
                        if (data.success === true) {
                            thisBtn.closest('tr').fadeOut();
                        } else {
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
    @endauth
@endsection