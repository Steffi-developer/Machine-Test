<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .search-container { margin: 20px; }
        .user-card { border: 1px solid #ccc; border-radius: 8px; padding: 10px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="container search-container">
        <div class="mb-3">
        <input type="text" id="search-input" class="form-control" placeholder="Search name/designation/department">
        </div>
        <div class="row mt-4" id="user-list">
            @foreach($users as $user)
                <div class="col-md-6 user-card-container">
                    <div class="user-card" data-name="{{ $user->name }}" data-department="{{ $user->department->name }}" data-designation="{{ $user->designation->name }}">
                        <h5>{{ $user->name }}</h5>
                        <p>{{ $user->designation->name }}</p>
                        <p>{{ $user->department->name }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search-input').on('keyup', function() {
                var query = $(this).val().toLowerCase();
                $('.user-card-container').filter(function() {
                    var name = $(this).find('.user-card').data('name').toLowerCase();
                    var department = $(this).find('.user-card').data('department').toLowerCase();
                    var designation = $(this).find('.user-card').data('designation').toLowerCase();
                    $(this).toggle(name.includes(query) || department.includes(query) || designation.includes(query));
                });
            });
        });
    </script>
       <script>
        $(document).ready(function() {
            $('#search-input').on('keyup', function() {
                var query = $(this).val();
                $.ajax({
                    url: '{{ route("ajax.search") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        query: query
                    },
                    success: function(response) {
                        $('#user-list').html('');
                        $.each(response, function(index, user) {
                            $('#user-list').append(`
                                <div class="col-md-6 user-card-container">
                                    <div class="user-card" data-name="${user.name}" data-department="${user.department.name}" data-designation="${user.designation.name}">
                                        <h5>${user.name}</h5>
                                        <p>${user.designation.name}</p>
                                        <p>${user.department.name}</p>
                                    </div>
                                </div>
                            `);
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
