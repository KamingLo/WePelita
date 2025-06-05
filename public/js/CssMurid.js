document.addEventListener('livewire:init', () => {
    Livewire.on('showSuccessMessage', () => {
        const successMessage = document.getElementById('successMessage');
        successMessage.classList.add('show');
        
        setTimeout(() => {
            successMessage.classList.remove('show');
        }, 3000);
    });

    Livewire.on('exportGrades', () => {
        alert('Data berhasil di-export!');
    });
});