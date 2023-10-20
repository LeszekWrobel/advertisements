document.addEventListener('DOMContentLoaded', function () {
    const photoActions = document.querySelectorAll('.photo-action');

    photoActions.forEach(action => {
        action.addEventListener('click', function (e) {
            e.preventDefault();
            const actionType = this.getAttribute('data-action');
            const photoId = this.getAttribute('data-photo-id');

            if (actionType === 'delete') {
                if (confirm('Czy na pewno chcesz usunąć to zdjęcie?{{$photo}}')) {
                    // Wysyłanie żądania DELETE do usunięcia zdjęcia
                    axios.delete(`/photos/delete/{{$photo}}`)
                   // axios.delete(`/photos/delete/${photoId}`)
                        .then(response => {
                            alert(response.data.message);
                            // Przykładowo, odświeżenie strony
                            location.reload();
                        })
                        .catch(error => {
                            console.error(error);
                        });
                }
            } else if (actionType === 'rotate') {
                // Wysyłanie żądania POST do obrócenia zdjęcia
                axios.post(`/photos/rotate/${photoId}`)
                    .then(response => {
                        alert(response.data.message);
                        // Przykładowo, odświeżenie zdjęcia bez odświeżania strony
                        const image = this.closest('.photo-container').querySelector('img');
                        image.src = response.data.rotated_path;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        });
    });
});
