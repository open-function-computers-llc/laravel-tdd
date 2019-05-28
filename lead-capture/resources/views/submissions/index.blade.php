@extends("layouts.app")

@section("content")

    <div class="title m-b-md">
        Submissions
    </div>

    <table>
        <tr>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Email Address</td>
            <td>Phone Number</td>
        </tr>
        @forelse ($submissions as $submission)
            <tr>
                <td>{{ $submission['first_name'] }}</td>
                <td>{{ $submission['last_name'] }}</td>
                <td>{{ $submission['email_address'] }}</td>
                <td>{{ $submission['phone_number'] }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No results</td>
            </tr>
        @endforelse
    </table>
</div>

@endsection
