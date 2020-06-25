@extends('layouts.admin')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('userReservation') }}
        <div id="alert_message"></div>
        <table class="table table-striped" id="user_reservation_list">
            <tbody>
            @foreach($reservations as $reservation)
                <tr data-tr_{{$reservation->reservation_id}}>
                    <td>
                        {{$reservation->reservations_reserved_at}}
                    </td>
                    <td align="right">
                        <button
                            type="button"
                            data-reservation_id="{{$reservation->reservation_id}}"
                            class="btn btn-danger reservation_cancel_button">
                            キャンセル
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
