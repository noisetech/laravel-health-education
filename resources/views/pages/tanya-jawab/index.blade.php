@extends('layouts.be')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Dokter</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border">
                            @foreach($dokters as $dokter)
                            <li class="media dokter-item" data-id="{{ $dokter->id }}">
                                <img alt="image" class="mr-3 rounded-circle" width="50" src="{{ $dokter->foto ?? 'https://ui-avatars.com/api/?name='.$dokter->nama_lengkap }}">
                                <div class="media-body">
                                    <div class="mt-0 mb-1 font-weight-bold">{{ $dokter->nama_lengkap }}</div>
                                    <div class="text-small text-muted">{{ $dokter->spesialis }}</div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 id="selected-dokter">Pilih dokter untuk memulai chat</h4>
                    </div>
                    <div class="card-body chat-box" style="height: 400px; overflow-y: scroll;">
                        <div id="chat-messages"></div>
                    </div>
                    <div class="card-footer">
                        <form id="chat-form" class="d-none">
                            <div class="input-group">
                                <input type="text" class="form-control" id="message-input" placeholder="Tulis pesan...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Kirim</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    let selectedDokterId = null;

    $(document).ready(function() {
        $('.dokter-item').click(function() {
            selectedDokterId = $(this).data('id');
            $('#selected-dokter').text($(this).find('.font-weight-bold').text());
            $('#chat-form').removeClass('d-none');
            loadMessages();
        });

        $('#chat-form').submit(function(e) {
            e.preventDefault();
            const message = $('#message-input').val();
            if (!message) return;

            $.ajax({
                url: '/chat/send',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    dokter_id: selectedDokterId,
                    pesan: message
                },
                success: function(response) {
                    $('#message-input').val('');
                    appendMessage(response);
                }
            });
        });

        function loadMessages() {
            $.get(`/chat/messages/${selectedDokterId}`, function(messages) {
                $('#chat-messages').empty();
                messages.forEach(appendMessage);
            });
        }

        function appendMessage(message) {
            const align = message.sender_type === 'user' ? 'right' : 'left';
            const bubble = `
            <div class="chat-bubble text-${align} mb-3">
                <div class="badge badge-${message.sender_type === 'user' ? 'primary' : 'success'} p-2">
                    ${message.pesan}
                </div>
                <div class="text-small text-muted">${moment(message.created_at).format('HH:mm')}</div>
            </div>
        `;
            $('#chat-messages').append(bubble);
            $('.chat-box').scrollTop($('.chat-box')[0].scrollHeight);
        }
    });
</script>
@endpush
