$(document).ready(function() {
    $('#photos-container').sortable({
        update: function(_event, _ui) {
            // Pobierz nową kolejność zdjęć po przeciągnięciu i upuszczeniu
            var newOrder = [];

            $('.photo-item').each(function() {
                newOrder.push($(this).data('photo'));
            });

            // Zaktualizuj ukryte pole 'photos' jako JSON
            $.ajax({
                url: "{{ route('advertisements.updatePhotoOrder', ['advertisement' => $advertisement]) }}",
                method: 'POST',
                data: {
                    photos: JSON.stringify(newOrder),
                    _token: '{{ csrf_token() }}'
                },
                success: function(_response) {
                    // Aktualizacja zakończona sukcesem
                },
                error: function(_response) {
                    // Obsługa błędu
                }
            });
        }
    });
});

