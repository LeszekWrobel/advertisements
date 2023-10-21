function confirmDelete() {
    const photoPath = 'ścieżka_do_zdjęcia'; // Zastąp tę zmienną ścieżką do zdjęcia

    // Użyj funkcji confirm() do wyświetlenia komunikatu potwierdzającego
    const userConfirmed = confirm(`Czy na pewno chcesz usunąć zdjęcie o ścieżce: ${photo}?`);

    // Sprawdź, czy użytkownik potwierdził (OK) czy anulował (Anuluj) i podejmij odpowiednie działania
    if (userConfirmed) {
        // Tutaj możesz dodać kod do usunięcia zdjęcia lub inne operacje
        // Możesz użyć AJAX (np. axios) do przesłania żądania usunięcia na serwer itp.
    } else {
        // Jeśli użytkownik anulował, możesz nie podejmować żadnych działań
    }
}


// resources/js/photo.js
import axios from 'axios';
document.addEventListener('DOMContentLoaded', function () {
    const photoActions = document.querySelectorAll('.photo-action');

    photoActions.forEach(action => {
        action.addEventListener('click', function (e) {
            e.preventDefault();
            const actionType = this.getAttribute('data-action');
            const photoPath = this.getAttribute('data-photo-path');
            const confirmMessage = `Czy na pewno chcesz usunąć to zdjęcie?\nŚcieżka zdjęcia: ${photoPath}`;
                
            if (actionType === 'deleteFile') {
        
                    if (confirm(confirmMessage)){
 
                    axios.delete(`photos.deleteFile`, { params: { path: photoPath } })
  
                        .then(response => {
                            console.log('Odpowiedź z serwera:', response.data); // Wyświetlenie odpowiedzi
 
                            alert(response.data.message);
                            // Przykładowo, odświeżenie strony
                            location.reload(`advertisements.destroy`);
                        })
                        .catch(error => {
                            console.error(error);
                        });
                }
            }


            if (actionType === 'delete') {
                //if (confirm('Czy na pewno chcesz usunąć to zdjęcie?\nŚcieżka zdjęcia: ${photoPath}`')) {
                    if (confirm(confirmMessage)){
                    // Wysyłanie żądania DELETE do usunięcia zdjęcia
                    //axios.delete(`/photos/delete/${encodeURIComponent(photoPath)}`)
                    //axios.delete(`/photos/delete`, { params: { path: photoPath } })
                    //axios.delete(`/public/storage/advertisements/1/1_1695934231_DSC00154.JPG`, { params: { path: photoPath } })
                    //axios.delete(`/../../storage/${photoPath}`, { params: { path: photoPath } })
                    axios.delete(`/advertisements/{id}/edit`, { params: { path: photoPath } })
                    //axios.delete(`http://127.0.0.1:8000/storage/advertisements/1/1_1695934231_DSC00154.JPG`)
                   // axios.delete(`/photos/delete/${photoPath}`)
                        .then(response => {
                            console.log('Odpowiedź z serwera:', response.data); // Wyświetlenie odpowiedzi
 
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
                axios.post(`/photos/rotate/${photoPath}`, { path: photoPath })
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