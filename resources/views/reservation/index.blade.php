@extends('layouts.admin')
@inject('reservationModel', 'App\Models\Reservation')
@section('content')
    <div class="container">
        {{ Breadcrumbs::render('userReservation') }}
        <div id="alert_message"></div>
        <table class="table table-striped" id="user_reservation_list">
            <tbody>
            @if(count($reservations) > 0)
                @foreach($reservations as $reservation)
                    <tr data-tr_{{$reservation->reservation_id}}>
                        <td>
                            日時：{{$reservation->reservations_reserved_at}}<br>
                            トレーナー：{{$reservation->player_sei}}<br>
                            店舗：{{$reservation->stores_name}}<br>
                            ステータス：{{$reservationModel->getStatus($reservation->reservations_status)}}
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
            @else
                <div class="alert alert-warning" role="alert">
                    現在予約はございません。
                </div>
            @endif
            </tbody>
        </table>
    </div>
@endsection
